<?php
//echo $this->FebHtml->meta('description','',array('inline'=>false));
//echo $this->FebHtml->meta('keywords','',array('inline'=>false));
$this->set('title_for_layout', __d('public', 'Podsumowanie'));
?>
<?php 
$this->Html->addCrumb('CD', '/');
$this->Html->addCrumb('Konfiguracja CD', '/');
echo $this->element('default/crumb'); 
?>
<?php echo $this->Form->create('Order'); ?>
<?php echo $this->Form->hidden('Order.id', array('value' => $order['Order']['id'])); ?>
<div class="orders">
    <div class="orderTitleCollapse" id="title1"><span class="more"></span>1. Podsumowanie zakupów</div>
    <div id="1" class="steps">
        <?php echo $this->element('Orders/step1'); ?>
        <div class="orderRedLink"><?php echo $this->Html->link('Przejdź dalej ›', array(), array('onclick' => "show_step('2');", 'default' => false)); ?></div>
    </div>
    <div class="orderTitleCollapse" id="title2"><span></span>2. Zamówienie</div>
    <div id="2" class="steps">
        <?php echo $this->element('Orders/step2'); ?>    
    </div>
    <div class="orderTitleCollapse" id="title3"><span></span>3. Formularz zamówienia</div>
    <div id="3" class="steps">
        <?php echo $this->element('Orders/step3'); ?>
        <div class="orderGreyLink"><?php echo $this->Html->link('Kontyuuj', array(), array('onclick' => "show_step('4');", 'default' => false)); ?></div>
    </div>
    <div  class="orderTitleCollapse" id="title4"><span></span>4. System płatności</div>
    <div id="4" class="steps">
        <?php echo $this->element('Orders/step4'); ?>
        <div class="orderGreyLink"><?php echo $this->Html->link('Kontyuuj', array(), array('onclick' => "show_step('5');", 'default' => false)); ?></div>
    </div>
    <div  class="orderTitleCollapse" id="title5"><span></span>5. Komentarz</div>
    <div id="5" class="steps">
        <?php echo $this->element('Orders/step5'); ?>
        <div class="orderGreyLink"><?php echo $this->Html->link('Kontyuuj', array(), array('onclick' => "show_step('6');", 'default' => false)); ?></div>
    </div>
    <div  class="orderTitleCollapse" id="title6"><span></span>6. Podsumowanie zamówienia</div>
    <div id="6" class="steps">
        <?php echo $this->element('Orders/step6'); ?>
        <?php echo $this->Form->submit('Dalej', array('id' => 'form_submit')); ?>
        <?php echo $this->Form->end(); ?>
    </div>

    <script type="text/javascript">
    var step = <?php echo json_encode($step); ?>;
    var max_step = 1;
    isUser = '<?php echo!empty($user) ? 1 : 0; ?>';
    show_step('1');
    function show_step(fun_step){
        if(fun_step == 2 && isUser == 1) {
            fun_step = 3;
        }
        if(fun_step == 3) {
            fun_step = checkUser();
        }
        if(fun_step == 4) {
            fun_step = checkAddress();
        }
        if(fun_step == 6) {
            update();
        }
        if(fun_step > max_step) {
            max_step = fun_step;
        }
        step = fun_step;
        var prev_step = (fun_step - 1);
        var steps = $('.steps');
        steps.each(function(){
            if($(this).attr('id') != fun_step ) {
                $(this).hide();
            }
            var id = $(this).attr('id');
            if($(this).attr('id') <= fun_step) {
                var text = $('#title' + id).text();
                $('#title' + id).html("<span></span><a href='#' onclick='show_step("+ (id) +"); return false;'>" + text + "</a>");
            }
        });
        $('#' + fun_step).show().prev('div').find('span').addClass('more');
    }
    
    $('#form_submit').click(function(){        
        document.forms["OrderOrderCheckoutForm"].submit();
    });
    
    $('#OrderOrderCheckoutForm').submit(function(e){
        e.preventDefault();
    });
    
    function update() {
        if($('#OrderDaneDoWysylkiInneNizDoFaktury:checked').length) {
            $('#sendAddress').text('');   
            $('#sendAddress').append($('#AddressDefaultName').attr('value') + '<br />');
            $('#sendAddress').append($('#AddressDefaultCountryId').attr('value') + ', ' + $('#AddressDefaultCity').attr('value') + ', ' + $('#AddressDefaultAddress').attr('value'));          
        } else {          
            $('#sendAddress').text('');
            $('#sendAddress').append($('#InvoiceIdentityDefaultName').attr('value') + '<br />');
            $('#sendAddress').append($('#InvoiceIdentityDefaultCountryId').attr('value') + ', ' + $('#InvoiceIdentityDefaultCity').attr('value') + ', ' + $('#InvoiceIdentityDefaultAddress').attr('value'));
        }
        $('#paymentMethod').text($('input[type="radio"]:checked.updatePrices').next('label').text());
        $('#cost').text($('#razem-z-wysylka').text());
    }
    
    function checkAddress() {
        $('#addressError').text('');
        if($('#OrderDaneDoWysylkiInneNizDoFaktury:checked').length) {
            if($('#AddressDefaultName').attr('value') == '' || $('#AddressDefaultCity').attr('value') == '' || $('#AddressDefaultPostCode') == '') {
                $('#addressError').text('Popraw dane adresowe');
                return 3;
            } else {
                return 4;
            }            
        } else {
            if($('#InvoiceIdentityDefaultName').attr('value') == '' || $('#InvoiceIdentityDefaultCity').attr('value') == '' || $('#InvoiceIdentityDefaultPostCode') == '') {
                $('#addressError').text('Popraw dane adresowe');
                return 3;
            } else {
                return 4;
            } 
        }
    }
    
    function checkUser() {
        var guest = $('#guest_box').attr('checked');
        var acc = $('#accept_box').attr('checked');
        $('#userError').text('');
        if(isUser == 1 || (guest == 'checked' && acc == 'checked')) {
            return 3;
        } else {
            $('#userError').text('Zaloguj się lub zamów jako gość');
            return 2;
        }
    }
</script>
</div>