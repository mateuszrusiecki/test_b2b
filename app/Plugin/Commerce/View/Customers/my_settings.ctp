<?php $title = __d('public', 'USTAWIENIA KONTA'); ?>
<?php $this->set('title_for_layout', $title); ?>
<div id="my-account">
    <h1><?php echo $title ?></h1>
    <div class="blueNav">
        <?php echo $this->element('customer/menu'); ?>
    </div>

    <div id="my-account-content" class="orders">
        <div class="">
            <?php //debug($this->Html->); ?> 
            <?php echo $this->Form->create('Customer', array('url' => array('controller' => 'customers', 'action' => 'my_settings', $this->params['pass'][0]))); ?>
            <?php echo $this->Form->input('id'); ?>
            <?php if ($this->params['pass'][0] == 'login') { ?>
            <fieldset>
                <h2><b><?php echo __('Nazwa konta'); ?></b></h2>
                <?php echo $this->Form->input('User.id') ?>
                <div class="treeBox relatywny">
                    <?php
                    echo $this->Form->input('User.email', array('label' => 'adres e-mail','value'=>$customer['User']['email'],  'readonly' => true, 'style' => 'border: 0px none; '));
                    ?>
                <span></span>
                </div>
                <div class="treeBox">
                    <?php
                    echo $this->Form->input('User.name', array('label' => 'nazwa'));
                    ?>
                </div>
            </fieldset>
            <fieldset>
                <h2><b>Zmiana hasła</b></h2>
                <div class="treeBox">
                    <?php echo $this->Form->input('User.oldpass', array('label' => 'aktualne hasło', 'value' => '', 'type' => 'password')); ?>
                </div>
                <div class="treeBox">
                    <?php echo $this->Form->input('User.newpass', array('label' => 'nowe hasło', 'value' => '', 'type' => 'password')); ?>

                    <?php echo $this->Form->input('User.confirmpass', array('label' => 'potwierdź hasło', 'value' => '', 'type' => 'password')); ?>
                </div>
            </fieldset>
            <?php } if ($this->params['pass'][0] == 'contact') { ?>
            <fieldset>
                <h2><b><?php echo __('Dane kontaktowe'); ?></b></h2>
                <div class="treeBox">
                    <?php
                    echo $this->Form->input('Customer.contact_person', array('label' => 'imię i nazwisko'));
                    ?>
                    <?php echo $this->Form->input('Customer.email', array('label' => 'e-mail kontaktowy')); ?>
                </div>
                <div class="treeBox">
                    <?php echo $this->Form->input('Customer.phone', array('label' => 'telefon')); ?>
                </div>
            </fieldset>
            <fieldset class="" id="">
                <h2><b><?php echo __('Dane do wysyłki'); ?></b></h2>
                <?php //echo  $this->Form->input('AddressDefault.id') ?>
                <div class="">
                    <div class="treeBox"> 		
                        <?php
                        echo $this->Form->input('AddressDefault.name', array('label' => 'imię i nazwisko lub nazwa'));
                        echo $this->Form->input('AddressDefault.address', array('label' => 'ulica'));
                        echo $this->Form->input('AddressDefault.phone', array('label' => 'telefon'));
                        ?>
                    </div>
                    <div class="treeBox">
                        <div class="postcode">
                            <?php
                            echo $this->Form->input('AddressDefault.post_code', array('label' => 'kod pocztowy', 'div' => array('class' => 'input text code')));
                            echo $this->Form->input('AddressDefault.city', array('label' => false, 'div' => array('class' => 'input text city')));
                            ?>
                        </div>
                        <?php
                        echo $this->Form->input('AddressDefault.country_id', array('label' => 'kraj'));
                        echo $this->Form->input('AddressDefault.region_id', array('label' => 'województwo', 'empty' => 'województwo'));
                        ?>
                    </div>
                </div>
            </fieldset>
            <?php } if ($this->params['pass'][0] == 'invoice') { ?>
            <fieldset>
                <h2><b><?php echo __('Dane do faktury'); ?></b></h2>
                <?php //echo  $this->Form->input('InvoiceIdentityDefault.id') ?>
                <?php echo $this->Form->input('InvoiceIdentityDefault.iscompany', array('legend' => false, 'type' => 'radio', 'options' => array('zakupy prywatne', 'zakupy firmowe'), 'separator' => '<br />')); ?>
                <div class="clearfix">
                    <div class="treeBox">
                        <?php
                        echo $this->Form->input('InvoiceIdentityDefault.name', array('label' => 'imię i nazwisko lub nazwa'));
                        echo $this->Form->input('InvoiceIdentityDefault.nip', array('label' => 'NIP'));
                        echo $this->Form->input('InvoiceIdentityDefault.address', array('label' => 'ulica'));
                        ?>
                    </div>
                    <div class="treeBox">
                        <div class="postcode">
                            <?php
                            echo $this->Form->input('InvoiceIdentityDefault.post_code', array('label' => 'kod pocztowy', 'div' => array('class' => 'input text code')));
                            echo $this->Form->input('InvoiceIdentityDefault.city', array('label' => false, 'div' => array('class' => 'input text city')));
                            ?>
                        </div>
                        <?php
                        echo $this->Form->input('InvoiceIdentityDefault.country_id', array('label' => 'kraj'));
                        echo $this->Form->input('InvoiceIdentityDefault.region_id', array('label' => 'województwo', 'empty' => 'województwo'));
                        ?>
                    </div>
                </div>
            </fieldset>
            <?php } ?>
            <fieldset>
                <?php echo $this->Form->submit('Zapisz', array('class' => 'orangeButton fr')); ?>
            </fieldset>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
    <script type="text/javascript">
        //wojewodztwo w zależności od kraju
        jQuery('#InvoiceIdentityDefaultCountryId, #AddressDefaultCountryId').change(function(){woj()});
        jQuery('#InvoiceIdentityDefaultCountryId, #AddressDefaultCountryId').blur(function(){ woj()});
        woj();
        
        function woj(){
            if(jQuery('#InvoiceIdentityDefaultCountryId').val() == 'PL'){
                jQuery('#InvoiceIdentityDefaultRegionId').parents('.input').css('display','block');
            }else{
                jQuery('#InvoiceIdentityDefaultRegionId').parents('.input').css('display','none');
            }
            if(jQuery('#AddressDefaultCountryId').val() == 'PL'){
                jQuery('#AddressDefaultRegionId').parents('.input').css('display','block');
            }else{
                jQuery('#AddressDefaultRegionId').parents('.input').css('display','none');
            }
        }
    	
        //dane do wysylki inne niz do faktury
        CustomerDaneDoWysylkiInneNizDoFaktury();
    	
        jQuery('#CustomerDaneDoWysylkiInneNizDoFaktury').parent('div').click(function(){
            CustomerDaneDoWysylkiInneNizDoFaktury();
        })
    	
        function CustomerDaneDoWysylkiInneNizDoFaktury(){
            if(jQuery('#CustomerDaneDoWysylkiInneNizDoFaktury:checked').length){
                jQuery('#CustomerDataForm').css('display','block');
            }else{
                jQuery('#CustomerDataForm').css('display','none');
            }
        }
    	
        //Prowadzę działalność gospodarczą
        InvoiceIdentityDefaultIscompany();
    	
        jQuery('input[name="data[InvoiceIdentityDefault][iscompany]"]').click(function(){
            InvoiceIdentityDefaultIscompany();
        })
    	
        function InvoiceIdentityDefaultIscompany(){
    	   
            if(parseFloat(jQuery('input[name="data[InvoiceIdentityDefault][iscompany]"]:checked').attr('value'))){
                jQuery('#InvoiceIdentityDefaultNip').parent('div').css('display','block');
            }else{
                jQuery('#InvoiceIdentityDefaultNip').parent('div').css('display','none');
            }
     	 
        }
    </script>
</div>