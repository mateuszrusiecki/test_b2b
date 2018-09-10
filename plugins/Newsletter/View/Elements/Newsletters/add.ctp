<?php

$uniq = uniqid();

echo $this->Form->create('Newsletter', array('id' => 'newsletterForm-'.$uniq, 'url' => array('plugin' => 'newsletter',  'controller' =>'newsletters', 'action' => 'add', $update)));

$value = __d('public', 'wpisz adres e-mail');

echo $this->Form->input('email', array(
    'label' => false,
    'value' => $value,
    'onblur' => 'if(!jQuery(this).val()){this.value="' . $value . '"};',
    'onfocus' => 'if(jQuery(this).val() == "' . $value . '"){this.value=""};'
));

echo $this->Js->submit(__d('public', 'Wyślij'), array(
    'update' => $update,
    'url' => array('plugin' => 'newsletter', 'controller' => 'newsletters', 'action' => 'add', $update),
    //'before' => 'newsletterBlock()',
));

echo $this->Form->end();

echo $this->Js->writeBuffer();

?>
<script type="text/javascript">
//    function newsletterBlock(){
//        
//        jQuery('#newsletter-<?php echo $uniq; ?>').block({message: "<?php echo __d('public', 'Proszę czekać'); ?>",
//    
//            css: {
//                padding:        0, 
//                margin:         0, 
//                width:          '30%', 
//                top:            '40%', 
//                left:           '35%', 
//                textAlign:      'center', 
//                color:          '#fff', 
//                border:         'none 0px', 
//                backgroundColor:'transparent', 
//                cursor:         'wait' 
//            }, 
// 
//            // styles for the overlay 
//            overlayCSS:  { 
//                backgroundColor: '#000', 
//                opacity:         0.6 
//            }
//    
//        });
//    }
//    function newsletterUnBlock(){
//        jQuery('#newsletter').unblock();
//    }	
</script>

<b>CHCESZ BYĆ NA BIEŻĄCO? <span>DOŁĄCZ DO NEWSLETTERA</span> »</b>