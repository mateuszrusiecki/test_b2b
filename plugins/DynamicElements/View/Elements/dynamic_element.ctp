<?php 

    //use example:
    /* 
    
    echo $this->element('dynamic_element', array(
        'plugin' => 'dynamic_elements',
//        'cache' => array('key' => 'element-id', 'time' => '+2 days'),
        'element_id' => 'element-id'
    ));
    
    */
?>
<?php 
    $element = $this->requestAction(array('plugin' => 'dynamic_elements', 'controller' => 'dynamic_elements', 'action' => 'view'), array('pass' => array($slug)));

    echo $element['DynamicElement']['content'];
?>


