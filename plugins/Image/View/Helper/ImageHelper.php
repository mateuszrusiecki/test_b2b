<?php

App::uses('FebImage', 'FebImage');
/**
 * Biblioteka Asido
  Dostępne są funkcje:

  resize – skalowanie proporcjonalne
  width – dopasowanie do szerokości
  height – dopasowanie do wysokości
  stretch – rozciąganie
  zoom – dopasowanie do podanych rozmiarów, przez obcięcie wystających boków
  fit – skalowanie, gdy obrazek „zmieści” się w podanych wymiarach
  frame – skalowanie z efektem ramki (wypełnienie kolorem, gdy obrazek się nie mieści)
  convert – zmiana formatu
  watermark – znak wodny
  grayscale – zmiana kolorów do odcieni szarości
  rotate – rotacja
  copy – kopiowanie podanego obrazu do załadowanego
  crop – kadrowanie
  flip – odbicie w pionie
  flop – odbicie w poziomie
  save – zapisanie obrazka
  image – załadowanie obrazu
  load – również załadowanie obrazu, opisane poniżej

  Dodatkowo mamy również dostęp do pól:

  width – szerokość załadowanego obrazka
  height – wysokość obrazka
 */

/** /app/View/Helper/image.php */
class ImageHelper extends AppHelper {

    var $helpers = array('Html');

    /**
     * Image class holder
     *
     * @var boolean
     * @access public
     * 
     */
    var $image = null;
    var $lastImageSize = null;

    function __construct(View $view, $settings = array()) {
        parent::__construct($view, $settings);
        App::import('Vendor', 'Image.image/Image');
        $this->image = new Image();
    }

    function thumb($file, $imageOptions = null, $options = array(), $forceRefresh = false) {
        
        $src = FebImage::thumb($file, $imageOptions, $options, $forceRefresh);
        $class = 'thumbnail';
        if (empty($options['class'])) {
            $options['class'] = 'thumbnail';
        }
        if (empty($options['alt'])) {
            $options['alt'] = $file;
        }

        if (!empty($options['valign'])) {
            $vMargin = $imageOptions['height'] - (($this->lastImageSize[1]) ? $this->lastImageSize[1] : $imageOptions['height']);
            if ($options['valign'] == 'middle' && $vMargin) {
                $options['style'] = empty($options['style']) ? '' : $options['style'] . '; ';
                $vMarginTop = floor($vMargin / 2);
                $options['style'] .= 'margin-top:' . $vMarginTop . 'px; ';
                $options['style'] .= 'margin-bottom:' . ($vMargin - $vMarginTop) . 'px; ';
            } elseif ($options['valign'] == 'bottom' && $vMargin) {
                $options['style'] = empty($options['style']) ? '' : $options['style'] . '; ';
                $vMargin = $imageOptions['height'] - $this->lastImageSize[1];
                $options['style'] .= 'margin-top:' . $vMargin . 'px; ';
            }
            unset($options['valign']);
        }
        $heightImage = isset($this->lastImageSize[3]) ? ' ' . $this->lastImageSize[3] . ' ' : '';
        $image = $this->Html->image($src, $options);

        return $image;
    }

    public function crop($file, $imageOptions = null) {
        $fileNameSrc = str_replace('/', DS, $file);

        $fileNameDst = $this->image->getCropPath($fileNameSrc, $imageOptions);
    }

}

?>