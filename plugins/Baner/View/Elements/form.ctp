<?php if (!empty($this->data['Baner']['image'])) { ?>
    <fieldset>
        <legend><?php echo __('Baner'); ?></legend>

        <?php echo $this->Html->image('/files/baner/' . $this->data['Baner']['image']); ?>

    </fieldset>
<?php } ?>
<fieldset>
    <legend><?php echo $desc ?></legend>


    <?php
    echo $this->Form->input('name', array('label' => __('Nazwa banera')));
    echo $this->Form->input('url', array('label' => __('URL strony')));
    echo $this->Form->input('title', array('label' => __('Tytuł')));
    ?>

    <?php
    $typeOption = array('HTML', 'Obrazek');
    echo $this->Form->input('banerType', array('legend' => 'Typ Baneru', 'separator' => '<br /><br />', 'options' => $typeOption, 'type' => 'radio', 'style' => 'float: left;', 'id' => 'baner-toggle-type'));
    ?>
</fieldset>
<div id="baner-html">
    <fieldset>
        <legend><?php echo __('Baner HTML'); ?></legend>
        <?php echo $this->Form->input('html_code', array('label' => __('Kod HTML'))); ?>
        <div id="baner-html-desc">Aby system poprawnie zliczał kliknięcia należy umieścić click taga: poradnik tutaj >> <?php echo $this->Html->link('TU', array('#')); ?> <<</div>
    </fieldset>
</div>
<div id="baner-image">
    <fieldset>
        <legend><?php echo __('Baner Obrazek'); ?></legend>
        <?php echo $this->FebForm->input('Baner.image', array('label' => __('Wybierz grafikę'), 'type' => 'file')); ?>



    </fieldset>
</div> 
<div id="baner-publish">
    <fieldset>
        <legend><?php echo __('Publikacja'); ?></legend>
        <?php echo $this->Form->input('group', array('label' => __('Położenie'), 'options' => $groupTypes)); ?>
        <?php echo $this->Form->input('publish_date', array('label' => __('Data publikacji'), 'type' => 'text', 'id' => 'publish_date')); ?>
    </fieldset>
</div>
<div id="baner-limits">
    <fieldset>
        <legend><?php echo __('Limity wyświetleń'); ?></legend>
        <div id="BanerClicksLimitDiv">
            <?php echo $this->Form->input('clicks_limit', array('label' => __('Limit kliknięć'))); ?>
        </div>
        <?php echo $this->Form->input('clicks_limit_off', array('label' => __('Bez limitu'), 'type' => 'checkbox', 'checked' => true)); ?>
        <div id="BanerShowsLimitDiv">
            <?php echo $this->Form->input('shows_limit', array('label' => __('Limit wyświetleń'))); ?>
        </div>
        <?php
        echo $this->Form->input('shows_limit_off', array('label' => __('Bez limitu'), 'type' => 'checkbox', 'checked' => true));

        echo $this->Form->input('date_limit', array('label' => __('Data wygaśnięcia'), 'type' => 'text', 'id' => 'date_limit'));

        echo $this->Form->input('date_limit_off', array('label' => __('Bez limitu'), 'type' => 'checkbox', 'checked' => true, 'id' => 'dateLimit'));
        ?>
    </fieldset>
</div>

<script type="text/javascript">
    $(function(){
        //Kod HTML
        $('#Baner-toggle-type0').click(function(){
            $('#baner-image').hide();
            $('#baner-html').show();
        });
        //Obrazek
        $('#Baner-toggle-type1').click(function(){
            $('#baner-image').show();
            $('#baner-html').hide();
        });

        //toggle limitu kliknięć
        $('#BanerClicksLimitOff').click(function(){
            if ($(this).attr('checked')) {
                $('#BanerClicksLimit').attr('disabled', 'disabled');
            } else {
                $('#BanerClicksLimit').removeAttr('disabled');
            }
            return true;
        });

        //toggle limitu wyświetleń
        $('#BanerShowsLimitOff').click(function(){
            if ($(this).attr('checked')) {
                $('#BanerShowsLimit').attr('disabled', 'disabled');
            } else {
                $('#BanerShowsLimit').removeAttr('disabled');
            }
            return true;
        });

        //toggle limitu daty
        $('#BanerDateLimitOff').click(function(){
            if ($(this).attr('checked')) {
                $('.MyDateLimit select').attr('disabled', 'disabled');
            } else {
                $('.MyDateLimit select').removeAttr('disabled');
            }
            return true;
        });
        
        //Odkliknięcia - odblokowania limitów
        
        $('#BanerClicksLimitDiv').click(function(){
            if ($('#BanerClicksLimit').attr('disabled')) {
                $('#BanerClicksLimitOff').removeAttr('checked');
                $('#BanerClicksLimit').removeAttr('disabled');
            } 
            return true;
        });
        $('#BanerShowsLimitDiv').click(function(){
            if ($('#BanerShowsLimit').attr('disabled')) {
                $('#BanerShowsLimitOff').removeAttr('checked');
                $('#BanerShowsLimit').removeAttr('disabled');
            }
            return true;
        });        
        
        //Init

        $('#BanerClicksLimit').attr('disabled', 'disabled');
        $('#BanerShowsLimit').attr('disabled', 'disabled');
        $('.MyDateLimit select').attr('disabled', 'disabled');
                
<?php if (!empty($this->data['Baner']['html_code'])) { ?>
            $('#Baner-toggle-type0').click();
<?php } ?>

<?php if (!empty($this->data['Baner']['image'])) { ?>
            $('#Baner-toggle-type1').click();
<?php } ?>
    });

</script>
<script type="text/javascript">
    $(function(){
        $('#publish_date').datepicker({
            showOn: "button",
            buttonImage: "/img/calendar.ico",
            dateFormat: 'yy-mm-dd'//'dd.mm.yy',
        });
    });
    
    $(function(){
        $('#publish_date, #date_limit').datepicker({
            showOn: "button",
            buttonImage: "/img/calendar.ico",
            dateFormat: 'yy-mm-dd',//'dd.mm.yy',
            onSelect: function() {
                $('#dateLimit').removeAttr('checked');
            }
        });
    });
</script>
