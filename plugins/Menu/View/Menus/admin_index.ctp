<?php echo $this->Metronic->portlet('Menu'); ?>
<?php if (empty($is_ajax)) { ?>
    <div>
        <?php if ($treeMode == '') { ?>
            <?php echo $this->element('title'); ?>
        <?php } ?>
        <?php echo $this->element('indexsort', array('tree' => $tree)); ?>
    </div>
<?php } else { ?>
    <?php echo $this->element('indexsort', array('tree' => $tree)); ?>
<?php } ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>


