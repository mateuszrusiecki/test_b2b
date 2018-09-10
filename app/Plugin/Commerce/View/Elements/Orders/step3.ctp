<p id="addressError"></p>
<div class="orderAddres clearfix">
    <div>
        <h2><b><?php echo __('Dane do faktury'); ?></b></h2>
        <?php echo $this->Form->input('InvoiceIdentityDefault.iscompany', array('legend' => false, 'type' => 'radio', 'options' => array('zakupy prywatne', 'zakupy firmowe'), 'separator' => '</div><div class="radioType">', 'div' => array('class' => 'radioType'))); ?>
        <div class="clearfix">
            <div class="treeBox">
                <?php
                echo $this->Form->input('InvoiceIdentityDefault.name', array('label' => __d('commerce', 'imię i nazwisko')));
                echo $this->Form->input('InvoiceIdentityDefault.nip', array('label' => __d('commerce', 'NIP')));
                echo $this->Form->input('InvoiceIdentityDefault.address', array('label' => __d('commerce', 'adres')));
                ?>
            </div>
            <div class="treeBox">
                <div class="postcode clearfix">
                    <?php
                    echo $this->Form->input('InvoiceIdentityDefault.post_code', array('label' => __d('commerce', 'kod pocztowy'), 'div' => array('class' => 'input text code')));
                    echo $this->Form->input('InvoiceIdentityDefault.city', array('label' => __d('commerce', 'miejscowość'), 'div' => array('class' => 'input text city')));
                    ?>
                </div>
                <?php
                echo $this->Form->input('InvoiceIdentityDefault.country_id', array('label' => __d('commerce', 'kraj')));
                echo $this->Form->input('InvoiceIdentityDefault.region_id', array('label' => __d('commerce', 'województwo'), 'empty' => 'województwo'));
                ?>
            </div>
        </div>
    </div>
    <div>
        <?php echo $this->Form->input('dane_do_wysylki_inne_niz_do_faktury', array('type' => 'checkbox', 'label' => __d('commerce', 'Inne dane do wysyłki'))); ?>
        <div id="OrderDataForm">
            <h2><b><?php echo __('Dane do wysyłki (jeśli inne niż do faktury)'); ?></b></h2>
            <div class="clearfix">
                <div class="treeBox"> 		
                    <?php
                    echo $this->Form->input('AddressDefault.name', array('label' => __d('commerce', 'imię i nazwisko lub nazwa')));
                    echo $this->Form->input('AddressDefault.address', array('label' => __d('commerce', 'adres')));
                    ?>
                </div>
                <div class="treeBox">
                    <div class="postcode clearfix">
                        <?php
                        echo $this->Form->input('AddressDefault.post_code', array('label' => __d('commerce', 'kod pocztowy'), 'div' => array('class' => 'input text code')));
                        echo $this->Form->input('AddressDefault.city', array('label' => __d('commerce', 'miejscowość'), 'div' => array('class' => 'input text city')));
                        ?>
                    </div>
                    <?php
                    echo $this->Form->input('AddressDefault.country_id', array('label' => __d('commerce', 'kraj')));
                    echo $this->Form->input('AddressDefault.region_id', array('label' => __d('commerce', 'województwo'), 'empty' => 'województwo'));
                    ?>
                </div>
            </div>
        </div>
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
    	
    jQuery('#OrderDaneDoWysylkiInneNizDoFaktury').change(function(){
        CustomerDaneDoWysylkiInneNizDoFaktury();
    })
    	
    function CustomerDaneDoWysylkiInneNizDoFaktury(){
        if(jQuery('#OrderDaneDoWysylkiInneNizDoFaktury').attr('checked')){
            jQuery('#OrderDataForm').show('fast');
        }else{
            jQuery('#OrderDataForm').hide();
        }
    }
    	
    CustomerDaneDoWysylkiInneNizDoFaktury();
    //Prowadzę działalność gospodarczą
    InvoiceIdentityDefaultIscompany();
    	
    jQuery('input[name="data[InvoiceIdentityDefault][iscompany]"]').click(function(){
        InvoiceIdentityDefaultIscompany();
    })
    	
    function InvoiceIdentityDefaultIscompany(){
        if(parseFloat(jQuery('input[name="data[InvoiceIdentityDefault][iscompany]"]:checked').attr('value'))){
            jQuery('#InvoiceIdentityDefaultNip').parent('div').css('display','block');
            jQuery('#InvoiceIdentityDefaultName, #AddressDefaultName').prev('label').text('nazwa');
        }else{
            jQuery('#InvoiceIdentityDefaultNip').parent('div').css('display','none');
            jQuery('#InvoiceIdentityDefaultName, #AddressDefaultName').prev('label').text('imię i nazwisko');
        }
     	 
    }        
</script>