<?php

/**
 * Helper dla TinyMCE v 4.0+
 * 
 * Należy pamiętać o ustawieniu praw dostępu do katalogu /app/webroot/js/tiny_mce4/js/tinymce/plugins/filemanager/thumbs
 * 
 */
class FebTinyMce4Helper extends AppHelper {

    var $helpers = array('Form', 'Html', 'Js');
    var $_script = false;
    var $_readmoreMark = '<!-- readmore -->';

    /**
     * 
     * @param type $fieldName - nazwa pola
     * @param type $options - opcje HTML
     * @param type $preset - ustawienia wstępne dla TinyMCE
     * @param type $tinyoptions - tablica atrybutów TinyMCE dla pola tekstowego
     */
    public function input($fieldName, $options = array(), $preset = 'basic', $tinyoptions = array()) {
        $model = explode('.', $fieldName);
        $fieldName = isset($model[1]) ? $model['1'] : $fieldName;
        $model = isset($model[1]) ? $model['0'] : $this->Form->model();
        
        //dodanie klas do pola TinyMce
        $tinyoptions['body_class'] = !empty($tinyoptions['body_class']) ? $model.' '.$fieldName.' '.$tinyoptions['body_class'] : $model;
        
//        debug($fieldName);
//        debug($model);
        if(!empty($preset)) {
            $preset_options = $this->preset($preset);
            
            if(is_array($preset_options) && is_array($tinyoptions)) {
                $tinyoptions = array_merge($tinyoptions, $preset_options);
            } else {
                $tinyoptions = $preset_options;
            }
        }
        $options['type'] = 'textarea';
        $idTinyMce = isset($options['id']) ? $options['id'] : Inflector::camelize($model . "_" . $fieldName);
//        debug($idTinyMce);
//        debug($tinyoptions);
//        debug($options);
//        debug($this->_build($idTinyMce, $tinyoptions));
        
        //exit;
        return $this->Form->textarea($fieldName, $options) . $this->_build($idTinyMce, $tinyoptions);
        //debug($idTinyMce);
    }
    /**
     * Funkcja generuje zestaw ustawień dla poszczególnych sytuacji
     * @param type $name - nazwa ustawienia
     * @return tablica parametrów, dla danego zestawu ustawień
     */
    private function preset($name) {
        if($name == 'full') {
            return array(
                "language" => "pl",
                'plugins' => "image pagebreak link insertdatetime filemanager media code hr nonbreaking preview print table visualblocks " . 
                             "advlist anchor charmap contextmenu emoticons fullscreen  paste searchreplace table textcolor visualchars ",
                "toolbar1" => "undo redo | styleselect | bold italic hr nonbreaking | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
                "toolbar2" => "link image preview | forecolor backcolor emoticons",
                'image_advtab' => true,
		'fullpage_default_encoding' => "UTF-8",
		'pagebreak_separator' => "<!-- pagebreak -->",
		'insertdatetime_element' => true,
                
                "autosave_ask_before_unload" => false, 
		"nonbreaking_force_tab" => true,
		//"max_height" => 300,
		"min_height" => 200,
		"height" => 250,
                "font_formats" => "Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n",
                "fontsize_formats" => "8pt 10pt 12pt 14pt 18pt 24pt 36pt"
            );
        }
        if($name == 'basic') {
            return array(
                "language" => "pl",
                'plugins' => "image fullpage pagebreak link insertdatetime filemanager media code hr nonbreaking preview print table visualblocks",
                "toolbar1" => "undo redo | styleselect | bold italic hr nonbreaking | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
                "toolbar2" => "link image preview | forecolor backcolor emoticons",
                
                'image_advtab' => true,
		'fullpage_default_encoding' => "UTF-8",
		'pagebreak_separator' => "<!-- pagebreak -->",
		'insertdatetime_element' => true,
                
                "autosave_ask_before_unload" => false, 
		"nonbreaking_force_tab" => true,
		//"max_height" => 300,
		"min_height" => 200,
		"height" => 250,
            );
        }
        if($name == 'bbcode') {
            return array(
                "language" => "pl",
                'plugins' => "image fullpage pagebreak link insertdatetime filemanager media code hr nonbreaking preview print table visualblocks bbcode",
                "toolbar1" => "undo redo | styleselect | bold italic hr nonbreaking | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
                "toolbar2" => "link image preview | forecolor backcolor emoticons",
                
                'image_advtab' => true,
		'fullpage_default_encoding' => "UTF-8",
		'pagebreak_separator' => "<!-- pagebreak -->",
		'insertdatetime_element' => true,
                
                "autosave_ask_before_unload" => false, 
		"nonbreaking_force_tab" => true,
		//"max_height" => 300,
		"min_height" => 200,
		"height" => 250,
            );
        }
        if($name == 'email') {
            return array(
                "language" => "pl",
                'plugins' => "image fullpage pagebreak link insertdatetime filemanager media code hr nonbreaking preview print table visualblocks bbcode",
                "toolbar1" => "undo redo | styleselect | bold italic hr nonbreaking | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
                "toolbar2" => "link image preview | forecolor backcolor emoticons",
                
                'image_advtab' => true,
		'fullpage_default_encoding' => "UTF-8",
		'pagebreak_separator' => "<!-- pagebreak -->",
		'insertdatetime_element' => true,
                
                "autosave_ask_before_unload" => false, 
		"nonbreaking_force_tab" => true,
		//"max_height" => 300,
		"min_height" => 200,
		"height" => 250,
            );
        }
        return null;
    }
    /**
     * Funkcja generuje kod funkcji definiującej element TinyMCE
     * @param type $fieldName
     * @param type $tinyoptions
     * @return type
     */
    function _build($fieldName, $tinyoptions = array()) {
        if(!$this->_script) {
            $this->_script = true;
            $this->Html->script('tiny_mce4/js/tinymce/tinymce.min', array('inline' => false));
        }
        $thisTiny = $this->domId($fieldName);
        $baseOption['skin'] = 'lightgray';
        $baseOption['selector'] = '#' . $fieldName;
        
        $tinyoptions = array_merge($baseOption, $tinyoptions);
        $init = 'tinymce.init(' . $this->Js->object($tinyoptions) . ')';
        
        
        
        /*$tinyoptions['file_browser_callback'] = 'function() {
            }';
        debug($tinyoptions);*/
        
       /* if (isset($tinyoptions['3_file_browser_callback'])) {
            $urlThumb = $this->Html->url('/',true).'js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php?language=pl&view=thumbnail';
            $init .= "
            function ajaxfilemanager(field_name, url, type, win) {
                tinyMCE.activeEditor.windowManager.open({
                    url: '{$urlThumb}',
                    inline : 'yes',
                    close_previous : 'no',
                    width: 782,
                    height: 440,
                },{
                    window : win,
                    input : field_name
                });
                tinyMCE.triggerSave();
            }";
        }*/
        return $this->Html->scriptBlock($init);
    }
}

?>
