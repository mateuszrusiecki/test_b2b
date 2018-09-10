<div class="scroller" style="height: 200px">
    <?php if($clientContacts){ ?>
        <?php foreach($clientContacts as $contact){ ?>
        <?php if(isset($clientContactsList[$contact['ClientContact']['id']])){
            $checked = 'checked';
        } else{
            $checked = false;
        }?>
        <div class="border-bottom-silver">
            <?php  echo $this->Metronic->input('people.', array(
                'type' => 'checkbox',
                'label' =>$contact['ClientContact']['firstname']. '  ' . $contact['ClientContact']['surname'], 
                'checked' => $checked,
                'value'=>$contact['ClientContact']['id']));  ?>

                <?php if(!empty($contact['ClientContact']['phone'])) { ?>
            <p> T: <?php echo $contact['ClientContact']['phone'];?> </p>  
           <?php } ?> 

            <?php if(!empty($contact['ClientContact']['email'])){ ?>
            <p> M: <?php echo $contact['ClientContact']['email'];?> </p>  
            <?php } ?> 
        </div>
       <?php } ?>
   <?php } ?>
</div>