<?php $this->Html->css('smmash', null, array('inline' => false)); ?>
<?php echo $this->Form->create('Creator', array('id' => 'CreatorForm')); ?>
<div id="creator">

<!--    <div class="view"><?php echo $this->Html->image('/smash/variant.png'); ?></div>
<div class="view"><?php echo $this->Html->image('/smash/variant.png'); ?></div>
<div class="view"><?php echo $this->Html->image('/smash/variant.png'); ?></div>-->

    <div class="clearfix">
        <canvas id="creatorArea" style="width:100%;height:100%" class="creatorContent">
            <?php //echo $this->Html->image('/smmash/koszulka.jpg'); ?>
        </canvas>

        <div id="creatorMenu" class="creatorMenuContent">

            <?php echo $this->Form->input('Creator.text', array('type' => 'textarea', 'label' => 'Wpisz tekst...')) ?>

            <?php echo $this->Form->input('Creator.font', array('type' => 'select', 'options' => array('Arial'), 'label' => false)) ?>

            <?php echo $this->Form->button('B'); ?>

            <?php echo $this->Form->button('I'); ?>

            <?php echo $this->Form->input('Creator.fontSize', array('type' => 'select', 'options' => array('12 pt'), 'label' => false)) ?>

            <?php echo $this->Form->input('Creator.textIdent', array('type' => 'radio', 'options' => array('Left', 'Center', 'Right', 'Justifiti'))) ?>

            <?php echo $this->Form->input('Creator.textColor', array('type' => 'select', 'options' => array('12 pt'), 'label' => 'Kolor tekstu')) ?>

            <?php echo $this->Form->input('Creator.textFrame', array('type' => 'select', 'options' => array('12 pt'), 'label' => 'Obramowanie')) ?>

            <?php echo $this->Form->input('Creator.textSchape', array('type' => 'select', 'options' => array('12 pt'), 'label' => 'Wygięcie dolne')) ?>

            <?php echo $this->Form->input('Creator.rotate', array('type' => 'text', 'label' => 'Obróć o kąt')) ?>

        </div>

    </div>

    <div id="creatorFooter">

        <div class="creatorContent">
            Rozmiar:
            <?php echo $this->Form->input('Creator.sizes', array('type' => 'select', 'options' => array('S', 'M', 'L', 'XL', 'XXL'), 'label' => false)); ?>

            <?php echo $this->Form->button('Tabela rozmiarów'); ?>

        </div>

        <div class="creatorMenuContent">

            <?php echo $this->Form->button('D'); ?>

            <?php echo $this->Form->button('I'); ?>

            <?php echo $this->Form->button('E'); ?>

        </div>

    </div>


</div>
<?php echo $this->Form->end(); ?>

<script type="text/javascript">
    
    $(window).load(function() {
        // get the canvas element using the DOM
        var canvas = document.getElementById('creatorArea');

        // use getContext to use the canvas for drawing
        var ctx = canvas.getContext('2d');

        // Draw shapes
        var img = new Image();
        img.src = '/smmash/koszulka.jpg';

        img.onload = function(){
            ctx.drawImage(img,0,0);
            ctx.fillStyle    = '#00F';
            ctx.font         = 'Italic 30px Sans-Serif';
            ctx.textBaseline = 'Top';
            ctx.fillText  ('Hello world!', 30, 50);

            ctx.font         = 'Bold 30px Sans-Serif';
            ctx.strokeText('Hello world!', 50, 80);
            ctx.beginPath();
            ctx.moveTo(30,96);
            ctx.lineTo(70,66);
            ctx.lineTo(103,76);
            ctx.lineTo(170,15);
            ctx.stroke();
        }
        
        
    });
 
</script>