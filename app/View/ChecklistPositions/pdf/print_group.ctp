<style type="text/css">
    .bordered{
        border: #000 solid .5mm;
        height: 30mm;
        margin-bottom: 3mm;
        page-break-after: auto;
        display: block;
		
    }
    .pagebreak{
        page-break-after: always;
        width: 10%;
    }
</style>
<h2><?php echo __d('public', 'Karta obiegowa'); ?></h2>

<?php
$i = -1;
foreach ($checklistPositions as $checklistPosition)
{
    echo (++$i % 6 == 0 and $i != 0)?'<div class="pagebreak"></div>':'';
    echo $checklistPosition['ChecklistPosition']['name'];
    ?>
    <div class="bordered">
    </div>
    <?php
}
?>
