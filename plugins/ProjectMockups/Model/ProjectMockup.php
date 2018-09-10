<?php

App::uses('ProjectMockupsAppModel', 'ProjectMockups.Model');
App::uses('FebEmail', 'Lib');

/**
 * Description of ProjectMockup
 *
 * @author Marcin Kozłowski <contact@mkozlowski.info>
 */
class ProjectMockup extends ProjectMockupsAppModel {

    /**
     * Behaviors
     *
     * @access public
     * @var array
     */
    public $actsAs = array(
        'Containable'
    );

    /**
     * belongsTo associations
     *
     * @access public
     * @var array
     */
    public $belongsTo = array(
        'ClientProject' => array(
            'className' => 'ClientProject',
            'foreignKey' => 'client_project_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

    /**
     * hasMany associations
     *
     * @access public
     * @var array
     */
    public $hasMany = array(
        'ProjectMockupNode' => array(
            'className' => 'ProjectMockups.ProjectMockupNode',
            'foreignKey' => 'project_mockup_id',
            'dependent' => true
        ),
    );

    /**
     * Validation rules
     *
     * @access public
     * @var array
     */
    public $validate = array();

    /**
     * Display field
     *
     * @access public
     * @var string
     */
    public $displayField = 'client_project_id';

    /**
     * List of insecure file extensions
     *
     * @access public
     * @var array
     */
    public $insecureExt = array(
        'exe',
        'so',
        'bat',
        'db',
        'dll',
        'bin',
        'php',
    );

    /**
     * Class constructor
     *
     * @access public
     * @param boolean|integer|string|array $id
     * @param string $table
     * @param string $ds
     * @return void
     */
    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
    }
    
    /**
     * @access public
     * @param int $project_id
     * @return int
     */
    public function getLastVersion($project_id) {
        //
        $mockup = $this->find('first', array(
            'contain' => array(),
            'conditions' => array(
                'ProjectMockup.client_project_id' => $project_id,
            ),
            'order' => array(
                'ProjectMockup.id' => 'DESC'
            )
        ));
        $version = 0;

        if (!empty($mockup['ProjectMockup']['version'])) {
            $version = intval($mockup['ProjectMockup']['version']);
        }
        return $version;
    }

    private function _flatten($elements, $depth = 0) {
        $result = array();

        foreach ($elements as $element) {
            $element['depth'] = $depth;

            if (isset($element['children'])) {
                $children = $element['children'];
                unset($element['children']);
            } else {
                $children = null;
            }
            $result[] = $element;

            if (isset($children)) {
                $result = array_merge($result, $this->_flatten($children, $depth + 1));
            }
        }
        return $result;
    }
    
    /**
     * Get list of files inside directory
     *
     * @access private
     * @param type $dir
     * @param type $results
     * @return array
     */
    private function _getDirContents($dir, &$results = array()){
        $files = scandir($dir);

        foreach($files as $key => $value){
            $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
            if(!is_dir($path)) {
                $results[] = $path;
            } else if(is_dir($path) && $value != "." && $value != "..") {
                $this->_getDirContents($path, $results);
                $results[] = $path;
            }
        }

        return $results;
    }

    /**
     * Norrmalize javascript code so we can convert it to json object.
     * We need this in order to create mockup node structure.
     * 
     * @access public
     * @param string $string
     * @return json object
     */
    private function _normalizeJs($string) {
        $parts = explode('"globalVariables"', preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $string));

        $firstPart = rtrim(trim($parts[0]), ',') . '}';
        $json = str_replace(array('$axure.loadDocument(', ');', '\''), array('', '', ''), $firstPart);

        return json_decode($json, true);
    }

    /**
     * Unpack and validate mockup
     * 
     * @access public
     * @param array $data
     * @return boolean|array
     */
    public function unpackMockup($data = array()) {
        // No data
        if (empty($data)) {
            return false;
        }
        
        // Decclare variables that we need.
        // I know this is meessy but I can easly edit thos later on without searching
        // in code too much.
        $mockupNodes = array();
        $files = array();
        $path = WWW_ROOT . 'files' . DS . 'projectfile' . DS . $data['ProjectFile']['file'];
        $mockupsPath = ROOT . DS . 'plugins' . DS . 'ProjectMockups' . DS .  WEBROOT_DIR . DS . 'files' . DS;
        $mockupTmp = $mockupsPath . 'tmp' . DS . pathinfo($data['ProjectFile']['file'], PATHINFO_FILENAME);
        $mockupPath = $mockupsPath . 'mockups' . DS . $data['ProjectFile']['client_project_id'];
        $version = $this->getLastVersion($data['ProjectFile']['client_project_id']) + 1;
        $finalPath = $mockupPath . DS . $version;
        $root = $mockupTmp;
        $visible = false;

        // Already unzipped
        if ($this->hasAny(array('ProjectMockup.project_file_id' => $data['ProjectFile']['id']))) {
            return false;
        }
        
        // Unzipp it
        $zip = new ZipArchive;
        $res = $zip->open($path);
        if ($res === TRUE) {
            $zip->extractTo($mockupTmp);
            $zip->close();

            // Get all files
            $files = $this->_getDirContents($mockupTmp);

            // Loop
            foreach ($files as $key => $filename) {
                if (in_array(pathinfo($filename, PATHINFO_EXTENSION), $this->insecureExt)) {
                    // Remove file
                    unlink($filename);
                    unset($files[$key]);
                }
                // Find root path
                if (pathinfo($filename, PATHINFO_BASENAME) === 'index.html') {

                    // Add javascript
                    $b2b = '';
                    $b2b .= '<!-- B2B -->' . "\n";
                    $b2b .= '<script type="text/javascript" src="../../../public/b2b/can.jquery.js"></script>' . "\n";
                    $b2b .= '<script type="text/javascript" src="../../../public/b2b/core.js"></script>' . "\n";
                    $b2b .= '<script type="text/javascript" src="../../../public/b2b/drawing.js"></script>' . "\n";
                    $b2b .= '<script type="text/javascript" src="../../../public/b2b/scripts.js"></script>' . "\n";
                    $b2b .= '<link type="text/css" href="../../../public/b2b/styles.css" rel="Stylesheet" />' . "\n";
                    $b2b .= '</head>' . "\n";

                    // Edit file
                    $file_contents = file_get_contents($filename);
                    $fh = fopen($filename, 'w');
                    fwrite($fh, str_replace('</head>', $b2b, $file_contents));
                    fclose($fh);

                    $root = pathinfo($filename,  PATHINFO_DIRNAME);
                    $visible = true;
                }
                // Find main js file
                if (strpos($filename, 'data' . DS. 'document.js') !== false) {
                    $nodes = $this->_normalizeJs(file_get_contents($filename));
                    $mockupNodes = $this->_flatten($nodes['sitemap']['rootNodes']);
                }
            }
        }
        // Move files
        if (!file_exists($mockupPath)) {
            mkdir($mockupPath, 0777);
        }
        // Relocate files and remove old directory
        
        rename($root, $finalPath);
        $this->_xcopy($mockupsPath . 'public' . DS . 'b2b', $finalPath . DS . 'b2b');

        if (file_exists($mockupTmp)) {
            $this->_deleteFiles($mockupTmp);
        }

        // Add to database
        $this->create();
        $result = $this->saveAssociated(array(
            'ProjectMockup' => array(
                'version' => $version,
                'client_project_id' => $data['ProjectFile']['client_project_id'],
                'project_file_id' => $data['ProjectFile']['id'],
                'path' => $finalPath,
                'visible' => $visible,
            ),
            'ProjectMockupNode' => $mockupNodes
        ));
        
        return $result;
    }

    /**
     * Remove directory along with it's contents
     *
     * @access private
     * @param string $dir
     * @return void
     */
    private function _deleteFiles($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != '.' && $object != '..') {
                    if (filetype($dir . '/' . $object) == 'dir') {
                        $this->_deleteFiles($dir . '/' . $object);
                    }
                    else {
                        unlink($dir . '/' . $object);
                    }
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    /**
     * 
     * @param type $source
     * @param type $dest
     * @param type $permissions
     * @return boolean
     */
    private function _xcopy($source, $dest, $permissions = 0755) {
        // Check for symlinks
        if (is_link($source)) {
            return symlink(readlink($source), $dest);
        }
        // Simple copy for a file
        if (is_file($source)) {
            return copy($source, $dest);
        }
        // Make destination directory
        if (!is_dir($dest)) {
            mkdir($dest, $permissions);
        }
        // Loop through the folder
        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            // Skip pointers
            if ($entry == '.' || $entry == '..') {
                continue;
            }
            // Deep copy directories
            $this->_xcopy("$source/$entry", "$dest/$entry", $permissions);
        }
        // Clean up
        $dir->close();
        return true;
    }

}
