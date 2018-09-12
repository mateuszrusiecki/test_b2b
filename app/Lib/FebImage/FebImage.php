<?php

//define('ASIDO_GD_JPEG_QUALITY', 95);

App::build(array('Vendor' => array('plugins' . DS . 'Image' . DS . 'Vendor' . DS . 'image' . DS . 'SomePackage')));
App::uses('class.asido', 'Vendor');
Asido::driver('gd');
Asido::driver('gd_hack');

class FebImage {

    var $maintainAspectRatio = true;
    public static $imageOptions = array('width' => 96, 'height' => 96);
    var $lastDstSize = null;

    static function thumb($file, $imageOptions = null, $options = array(), $forceRefresh = false) {
        $fileNameSrc = str_replace('/', DS, $file); //($model)?$model.DS.$file:$file;

        $fileNameDst = self::getThumbPath($fileNameSrc, $imageOptions);

        $noimage = false;
        if (!empty($options['noimage'])) {
            $noimage = $options['noimage'];
            unset($options['noimage']);
        }
        if ($forceRefresh || !self::imageExists($fileNameDst)) {
            if ($noimage && !self::imageExists($fileNameSrc)) {
                //return $this->Html->image('stop.jpg', array('alt' => 'Dostęp zabroniony'));
            } elseif (!self::imageExists($fileNameSrc)) {                
                $fileNameSrc = DS . 'image' . DS . 'img' . DS . 'empty_image.gif';
            }

            $src = self::createThumb($fileNameSrc, $imageOptions);
        } else {
            $src = self::getImageUrl($fileNameDst);
        }

        return $src;
    }

    /**
     * Creates thumbnail from selected image and saves it in file returned by function {@link getThumbPath()}
     * 
     * @param string $fileNameSrc Source file name relative to WWW_ROOT."files"
     * @param mixed $imageOptions array containing min one value for one of keys named 'width' or 'height', or null in order to use default values 
     * @param mixed $params array containing options
     * @return mixed url relative to WEBROOT on success, or false on failure
     */
    static function createThumb($fileNameSrc, $imageOptions = null, $params = null) {
        if ($imageOptions === null) {
            $imageOptions = $this->size;
        }
        $fileNameDst = self::getThumbPath($fileNameSrc, $imageOptions);

        return self::resizeImage($fileNameSrc, $imageOptions, $params, $fileNameDst);
    }

    /**
     * Creates thumbnail from selected image and saves it in selected location, or overwrite source (default)
     * 
     * @param string $fileNameSrc Source file name relative to WWW_ROOT."files"
     * @param mixed $imageOptions array containing min one value for one of keys named 'width' or 'height', or null in order to use default values 
     * @param mixed $params array containing options
     * @param string $fileNameDst Destination file name relative to WWW_ROOT."files" - if not set, uses $fileNameSrc
     * @return mixed url relative to WEBROOT on success, or false on failure
     */
    static function resizeImage($fileNameSrc, $imageOptions = null, $params = null, $fileNameDst = null) {
        if ($imageOptions === null) {
            $imageOptions = $this->size;
        }

        //jesli nie podano pliku przeznaczenia - przeskaluj zrodlo
        $fileNameDst = ($fileNameDst) ? $fileNameDst : $fileNameSrc;

        $absolutePath = (!empty($params['absolutePath'])) ? true : false;

        $urlDst = self::getImageUrl($fileNameDst);

        if (!$absolutePath) {
            //create full path
            $fileNameSrc = WWW_ROOT . $fileNameSrc;
            $fileNameDst = WWW_ROOT . $fileNameDst;
        }
        //check if the src file exists
        if (!is_array($imageOptions)) {
            self::log("IMAGE VENDOR: Options is not array: " . $imageOptions . ".");
            return false;
        }


        //check if the src file exists
        if (!file_exists($fileNameSrc) || !is_file($fileNameSrc) || !is_readable($fileNameSrc)) {
            //debug('Source file not exist, or is not readable.');
            //debug($fileNameSrc);
            self::log("IMAGE VENDOR: Source file " . $fileNameSrc . " not exist, or is not readable.");
            return false;
        }
        //check if the dest dir is writable;
        $destDir = dirname($fileNameDst);
        if (!is_writeable($destDir)) {
            $result = @mkdir($destDir, 0777) | @chmod($destDir, 0777);
            if (!$result) {
//                debug('Destination dir is not writable.');
                self::log('IMAGE VENDOR: Destination dir ' . $destDir . ' is not writable.');
                return false;
            }
        }

        $srcData = list($srcWidth, $srcHeight, $srcImageType) = getimagesize($fileNameSrc);

        if ($srcImageType != IMAGETYPE_GIF && $srcImageType != IMAGETYPE_JPEG && $srcImageType != IMAGETYPE_PNG) {
            self::log('IMAGE VENDOR: Not supported image type: "' . $srcImageType . '".');
            return false;
        }

        $result = self::image($fileNameSrc, $fileNameDst);


        if (!empty($imageOptions['watermark'])) {
            if (self::imageExists($imageOptions['watermark'])) {
                $fileWatermark = WWW_ROOT . $imageOptions['watermark'];
                $fileWatermark = str_replace(array('/', '//', '\\', '\\\\'), DS, $fileWatermark);
                self::watermark($fileWatermark);
            }
        }
        if (!empty($imageOptions['grayscale'])) {
            self::grayscale();
        }

        if (!empty($imageOptions['frame'])) {
            $color = self::hex2RGB($imageOptions['frame']);

            self::frame($imageOptions['width'], $imageOptions['height'], $color);
        }

        if (!empty($imageOptions['crop'])) {
            list($imageOptions['x'], $imageOptions['y'], $imageOptions['w'], $imageOptions['h']) = self::cropCords($imageOptions, $srcData);
        }
        if ((isset($imageOptions['x']) && !is_null($imageOptions['x'])) && (isset($imageOptions['y']) && !is_null($imageOptions['y'])) && (isset($imageOptions['w']) && !is_null($imageOptions['w'])) && (isset($imageOptions['h']) && !is_null($imageOptions['h']))) {
            self::resize($imageOptions['width'], $imageOptions['height'], $imageOptions['x'], $imageOptions['y'], $imageOptions['w'], $imageOptions['h'], ASIDO_RESIZE_STRETCH);
        } else {
            self::resize($imageOptions['width'], $imageOptions['height']);
        }



        self::save();


        if (!$result) {
            self::log('IMAGE VENDOR: Saving file ' . $fileNameDst . ' failed.');
            return false;
        }

        @chmod($fileNameDst, 0777);


        return $urlDst;
    }

    function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
        $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
        $rgbArray = array();
        if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
            $colorVal = hexdec($hexStr);
            $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
            $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
            $rgbArray['blue'] = 0xFF & $colorVal;
        } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
            $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
            $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
            $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
        } else {
            return false; //Invalid hex color code
        }
        $color = $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
        return self::color($color['red'], $color['green'], $color['blue']);
    }

    /**
     * Builds default path to thumbnail
     * 
     * Thumbs are in default saved in subfolder of folder containing original file. 
     * This subfolder is named thumbsAAxBB where AA is width, and BB is height. 
     * If width or height is not specified, is ommited in folder name.
     * 
     * @param string $fileNameSrc Source file name relative to WWW_ROOT."files/"
     * @param array $imageOptions array containing min one value for one of keys named 'width' or 'height'
     * @return mixed String containing path relative to WWW_ROOT."files/" on success, or boolean false on failure
     */
    static function getThumbPath($fileNameSrc, $imageOptions) {
        if (empty($imageOptions['width']) && empty($imageOptions['height'])) {
            return false;
        }

        if (!empty($imageOptions['crop']) or isset($imageOptions['x']) or isset($imageOptions['y']) && isset($imageOptions['w']) && isset($imageOptions['h'])) {

            $cropName = !isset($imageOptions['x']) ? '' : 'x' . $imageOptions['x'];
            $cropName .=!isset($imageOptions['y']) ? '' : 'y' . $imageOptions['y'];
            $cropName .=!isset($imageOptions['w']) ? '' : 'ww' . $imageOptions['w'];
            $cropName .=!isset($imageOptions['h']) ? '' : 'hh' . $imageOptions['h'];

            if (!isset($imageOptions['x']) and !isset($imageOptions['y']) and !isset($imageOptions['w']) and !isset($imageOptions['h'])) {
                $cropName = empty($imageOptions['crop']) ? '' : 'c_' . $imageOptions['crop'];
            }
        }

        $srcFile = basename($fileNameSrc);
        $srcDir = dirname($fileNameSrc);

        $folder = 'thumbs_';
        $folder .= (empty($imageOptions['width'])) ? '' : 'w' . $imageOptions['width'];
        $folder .= (empty($imageOptions['height'])) ? '' : 'h' . $imageOptions['height'];
        $folder .= (empty($imageOptions['frame'])) ? '' : 'f' . substr($imageOptions['frame'], 1);
        $folder .= (empty($cropName)) ? '' : $cropName;
        $fileNameDest = $srcDir . DS . $folder . DS . $srcFile;
        return $fileNameDest;
    }

    /**
     * Return thumbnail URL
     * 
     * @param string $fileNameDst returned by {@link getThumbPath()}
     * @return boolean Return thumbnail URL
     */
    static function getImageUrl($fileNameDst) {
        return str_replace(DS, '/', $fileNameDst);
    }

    /**
     * Check if defined thumbnail is present in given location
     * 
     * @param string $fileNameDst returned by {@link getThumbPath()}
     * @return boolean Return true if file exists.
     */
    static function imageExists($fileNameDst) {
        $fileNameDst = WWW_ROOT . $fileNameDst;
        //check if the src file exists
        if (!file_exists($fileNameDst) || !is_file($fileNameDst) || !is_readable($fileNameDst)) {
            return false;
        }
        return true;
    }

    static function imageSize($fileName) {
        $fileName = WWW_ROOT . $fileName;
        return @getimagesize($fileName);
    }

    static function cropCords($imageOptions = array(), $srcData = array()) {

        $srcX = $srcY = 0;

        list($srcWidth, $srcHeight) = $srcData;

        $ratioX = $imageOptions['width'] / $srcWidth;
        $ratioY = $imageOptions['height'] / $srcHeight;



        $ratio = max($ratioX, $ratioY);
        (int) $newSrcHeight = ceil($imageOptions['height'] / $ratio);
        (int) $newSrcWidth = ceil($imageOptions['width'] / $ratio);

        if ($ratioX > $ratioY) {
            $srcY = ceil(($srcHeight - $newSrcHeight) / 2);
        } else {
            $srcX = ceil(($srcWidth - $newSrcWidth) / 2);
        }

        if (!empty($imageOptions['crop']) and $imageOptions['crop'] === 'top') {
            $srcY = 0;
        }
        if (!empty($imageOptions['crop']) and $imageOptions['crop'] === 'bottom') {
            $srcY = abs(ceil($srcHeight - $newSrcHeight));
        }

        if (!empty($imageOptions['crop']) and $imageOptions['crop'] === 'left') {
            $srcX = 0;
        }

        if (!empty($imageOptions['crop']) and $imageOptions['crop'] === 'right') {
            $srcX = abs(ceil($srcWidth - $newSrcWidth));
        }
        if (isset($imageOptions['x'])) {
            $srcX = $imageOptions['x'];
        }

        if (isset($imageOptions['y'])) {
            $srcY = $imageOptions['y'];
        }

        //zabezpieczenie przed przekroczeniem zakresu
        $srcX = ($newSrcWidth + $srcX > $srcWidth) ? $srcWidth - $newSrcWidth : $srcX;
        $srcY = ($newSrcHeight + $srcY > $srcHeight) ? $srcHeight - $newSrcHeight : $srcY;

        return array($srcX, $srcY, $newSrcWidth, $newSrcHeight);
    }

    static function log($message) {
        CakeLog::write('pluginImage', $message . "\n");
    }

    /** nowy helper */
    public static $res = false;
    public static $width = 0;
    public static $height = 0;

    function load($source = null, $target = null) {
        if (!file_exists($source))
            return false;
        else {
            $a = getimagesize($source);
            self::$width = $a['0'];
            self::$height = $a['1'];
            return self::image($source, $target);
        }
    }

    static function image($source = null, $target = null) {
        self::$res = Asido::image($source, $target);
        return self::$res;
    }

    static function save($overwrite_mode = ASIDO_OVERWRITE_ENABLED) {
        return self::$res->save($overwrite_mode);
    }

    static function resize($width, $height, $x = null, $y = null, $w = null, $h = null, $mode = ASIDO_RESIZE_PROPORTIONAL) {
        return Asido::resize(self::$res, $width, $height, $x, $y, $w, $h, $mode);
    }

    static function width($width) {
        return Asido::width(self::$res, $width);
    }

    static function height($height) {
        return Asido::height(self::$res, $height);
    }

    static function stretch($width, $height) {
        return Asido::stretch(self::$res, $width, $height);
    }

    static function fit($width, $height) {
        return Asido::fit(self::$res, $width, $height);
    }

    static function frame($width, $height, $color = null) {
        return Asido::frame(self::$res, $width, $height, $color);
    }

    static function convert($mime_type) {
        return Asido::convert(self::$res, $mime_type);
    }

    function watermark($watermark_image, $position = ASIDO_WATERMARK_BOTTOM_RIGHT, $scalable = ASIDO_WATERMARK_SCALABLE_ENABLED, $scalable_factor = ASIDO_WATERMARK_SCALABLE_FACTOR
    ) {
        return Asido::watermark(self::$res, $watermark_image, $position, $scalable, $scalable_factor);
    }

    function grayscale() {
        return Asido::grayscale(self::$res);
    }

    static function rotate($angle, $color = null) {
        return Asido::rotate(self::$res, $angle, $color);
    }

    function color($red, $green, $blue) {
        return Asido::color($red, $green, $blue);
    }

    function copy($applied_image, $x, $y) {
        return Asido::copy(self::$res, $applied_image, $x, $y);
    }

    function crop($x, $y, $width, $height) {
        return Asido::crop(self::$res, $x, $y, $width, $height);
    }

    function flip() {
        return Asido::flip(self::$res);
    }

    function flop() {
        return Asido::flop(self::$res);
    }

    function zoom($new_width, $new_height) {
        $width = $this->width;
        $height = $this->height;
        $cmp_x = $width / $new_width;
        $cmp_y = $height / $new_height;
        if ($cmp_x > $cmp_y) {
            $this->height($new_height);
            $t_new_width = round($width * $new_height / $height);
            $src_x = round(($t_new_width - $new_width) / 2);
            $this->crop($src_x, 0, $new_width, $new_height);
        } elseif ($cmp_y > $cmp_x) {
            $this->width($new_width);
            $t_new_height = round($height * $new_width / $width);
            $src_y = round(($t_new_height - $new_height) / 2);
            $this->crop(0, $src_y, $new_width, $new_height);
        }
        else
            self::$resize($new_width, $new_height);
    }

    function min($width, $height) {
        if (self::$width < $width)
            return false;
        if (self::$height < $height)
            return false;
        return true;
    }

}

?>
