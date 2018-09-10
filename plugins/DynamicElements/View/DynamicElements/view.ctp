<?php $this->set('title_for_layout', $dynamicElement['DynamicElement']['name']); ?>

<div id="page">
    <div class="clearfix title">
        <h1><?php echo $dynamicElement['DynamicElement']['name']; ?></h1>
    </div>
    <div class="page">
        <?php echo $dynamicElement['DynamicElement']['content']; ?>
    </div>
</div>

<?php 
$this->Html->addCrumb($dynamicElement['DynamicElement']['name'], $this->request->here ); 
$this->Fancybox->init('jQuery(".gallery a")');
?>