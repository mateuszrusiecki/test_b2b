<?php echo $this->Html->script('jquery.min', array('inline' => false)); ?>
<?php echo $this->Html->script('jquery-ui.min', array('inline' => false)); ?>
<?php echo $this->Html->script('jquery.febslider', array('inline' => false)); ?>
<?php echo $this->Html->css(array('ui-lightness/jquery-ui'), null, array('inline' => false)); ?>
Test
<div id="slider-range" style="width:250px;"></div>
Ojejku

<?php debug($per);  ?>

</div>

<script type="text/javascript">
    $( "#slider-range" ).febslider({
        slider: {
            min: 0,
            max: 100,
            values: [5, 60],
            selfRange: [10, 60]
        }
    });
    
</script>