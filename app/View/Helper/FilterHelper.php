<?php

/**
 * Filter form helper class
 *
 * Provides function to display filters form in index view
 * @version 1.1
 * 
 * 
 * ChangeLog:
 * 1.1 - Filtrowanie zawsze przekierowuje na stronę główną
 * 
 */
class FilterHelper extends AppHelper {

    public $helpers = array('Html', 'Form', 'FebForm');

    function formCreate($fields) {
        $output = '';
        $url = Router::parse($this->params->url);
        $url = am($url, $url['named']);
        $url = am($url, $url['pass']);
        unSet($url['named']);
        unSet($url['pass']);
        $url['page'] = 1;

        $output .= $this->Form->create('Filter', array('url' => $url, 'class' => 'filter clearfix'));
        $output .='<fieldset class="clearfix">';

        foreach ($fields AS $key => $field) {
            $params = empty($field['form']) ? array() : $field['form'];
            $output .= $this->FebForm->input($key, $params);
            if (isset($params['class']) and strpos('onChange', $params['class']) >= 0) {
                $onChange = true;
            }
        }
        $output .='</fieldset>';
        $output .= $this->Form->submit(__('Filtruj'));
        $output .= $this->Form->end();
        if (!empty($onChange)) {
            $output .= $this->formCreateOnChange();
        }

        return $output;
    }

    function formCreateOnChange() {
        $output = '';
        $output .= $this->Html->scriptBlock('
			jQuery(".onChange").parents(".filter").find(".submit").css("display","none");
			jQuery(".onChange").change(function(){
				jQuery(this).parents(".filter").submit();
			});
		');
        return $output;
    }

}

?>