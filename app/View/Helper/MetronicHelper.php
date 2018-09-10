<?php
App::uses('AppHelper', 'View/Helper');

class MetronicHelper extends AppHelper {

    var $helpers = array('Form');

    /**
     * Generowanie portletów
     * 
     * @param type $light   Parametr określający styl: 0 - stary, 1 - nowy
     * @param type $title   Tytuł
     * @param type $icon    Ikona 
     * @param type $color   Kolor
     * @return string       Portlet html       
     */
    public function portlet($title = null, $light = 1, $icon = null, $color = 'blue-madison', $edit = 0, $url = '', $unactive = null) {
        $collapsed = 'collapsed'.rand();
        if ($light) {
            return '<div class="portlet light col-xs-12">
                        <div class="portlet-title">
                            <div class="tools caption">
                                <i class="' . $icon . ' font-grey-gallery"></i>
                                <a class=" expand_link"  ng-class="{\'expand\':'.$collapsed.',\'collapse\':!'.$collapsed.'}" href="" data-original-title="" title="">
                                        <span class="caption-subject font-blue-madison bold uppercase ">' . $title . '</span>
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body" ng-class="{\'display-hide\':'.$collapsed.'}">';
        } else {
            if ($edit) {
                return '<div class="portlet box ' . $color . '">
                        <div class="portlet-title">
                            
                            <div class="caption">
                                <i class="' . $icon . '"></i>' . $title . '
                            </div>
                            <div class="tools caption">
                                <a class=" expand_link"   href="' . $url . '" data-original-title="" title="">
                                   <i class="fa fa-external-link large-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">';
            } if ($unactive) {
                return '<div class="portlet box ' . $color . '">
                        <div class="portlet-title">
                            
                            <div class="caption">
                                <i class="' . $icon . '"></i>' . $title . '
                            </div>
                            <div class="tools caption">
                                <a class="unactive_link" href="" data-original-title="" title="">
                                    <i class="fa fa-close middle-icon-white"></i>
                                </a>
                                <a class=" expand_link"  ng-class="{\'expand\':'.$collapsed.',\'collapse\':!'.$collapsed.'}" href="" data-original-title="" title="">
                                    <span class="caption-subject font-blue-madison bold uppercase ">&nbsp;</span>
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body no-padding">';
            } else {
                return '<div class="portlet box ' . $color . '">
                        <div class="portlet-title">
                            
                            <div class="caption">
                                <i class="' . $icon . '"></i>' . $title . '
                            </div>
                            <div class="tools caption">
                                <a class=" expand_link"  ng-class="{\'expand\':'.$collapsed.',\'collapse\':!'.$collapsed.'}" href="" data-original-title="" title="">
                                    <span class="caption-subject font-blue-madison bold uppercase ">&nbsp;</span>
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">';
            }
        }
    }

    /**
     * Generowanie portletów z domyślnie ukrytą treścią
     * 
     * @param type $light   Parametr określający styl: 0 - stary, 1 - nowy
     * @param type $title   Tytuł
     * @param type $icon    Ikona 
     * @param type $color   Kolor
     * @return string       Portlet html       
     */
    public function portletHiden($title = null, $light = 1, $icon = null, $color = 'blue-madison') {
        if ($light) {
            return '<div class="portlet light">
                        <div class="portlet-title">
                            <div class="tools caption">
								<a href="javascript:;" class="expand expand_link">
									<i class="' . $icon . ' font-grey-gallery"></i>
									<span class="caption-subject font-blue-madison bold uppercase">' . $title . '</span>
								</a>
							</div>
                        </div>
                        <div class="portlet-body display-hide">';
        } else {
            return '<div class="portlet box ' . $color . '">
                        <div class="portlet-title">
                            <div class="tools caption">
								<a href="javascript:;" class="expand expand_link">
									<i class="' . $icon . ' font-grey-gallery"></i>
									<span class="caption-subject font-blue-madison bold uppercase">' . $title . '</span>
								</a>
							</div>
                        </div>
                        <div class="portlet-body  display-hide">';
        }
    }

    /**
     * Generowanie zakończenia portletu
     * 
     * @return string Zakończenie portletu
     */
    public function portletEnd() {
        return '</div></div>';
    }

    /**
     * Generowanie inputa textowego
     * 
     * @param type $name            Nazwa inputa
     * @param type $input_options   Opcje helpera Cakeowego
     * @param array $options        Opcje metronica
     * @return string               Input
     */
    public function input($name, $input_options = array(), $options = array()) {
        $return = '<div class="form-group">';

        if (!empty($options['label'])) {
            $return .= '<label>' . $options['label'] . '</label>';
        }

        empty($options['side']) ? $options['side'] = 'right' : '';

        $return .= '<div class="input-icon ' . $options['side'] . '">';

        if (!empty($options['icon'])) {
            $return .= '<i class="' . $options['icon'] . '"></i>';
        }

        $value = $this->Form->value($name);
        $input = array(
            'label' => false,
            'class' => 'form-control',
            'div' => false,
        );
        $input = array_merge($input, $options);

        $return .= $this->Form->input($name, array_merge($input, $input_options));
        $return .= '</div>';
        $return .= '</div>';
        return $return;
    }

}
?>

<!--<div class="form-group">
    <label>Left Icon</label>
    <div class="input-icon">
        <i class="fa fa-bell-o"></i>
        <input type="text" placeholder="Left icon" class="form-control">
    </div>
</div>-->