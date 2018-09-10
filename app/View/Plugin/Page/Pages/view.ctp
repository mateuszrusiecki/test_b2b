<?php $this->set('title_for_layout', $strona['Page']['name']); ?>
<?php $this->FebHtml->meta('description', $strona['Page']['description'], array('inline'=>false)); ?>
<?php $this->FebHtml->meta('keywords', $strona['Page']['keywords'], array('inline'=>false)); ?>

<div id="page">
    <div class="clearfix title">
        <h1><?php echo $strona['Page']['name']; ?></h1>
    </div>
    <div id="tinymce">
        <?php echo $strona['Page']['desc']; ?>
        <?php echo !empty($strona['Page']['static'])?$this->element('StaticPage/'.$strona['Page']['static']):''; ?>
        <div class="galleries clearfix">
            <?php 
            $strona['Comment'] = isset($strona['Comment'])?$strona['Comment']:array();
            echo $this->element('Page.Pages/galleries', array('photos' => $photos));
            //echo $this->element('PhotoCategories.PhotoCategories/pagePhotosTree', array('data' => $photoCategoryTree));
            ?>
        </div>
    
    <?php echo ($strona['Page']['comments'] == 1)?$this->element('Pages.Comments/comments'):''; ?>
    </div>
</div>

<?php 
//$this->Html->addCrumb($strona['Page']['name'], $this->request->here ); 
//$this->Fancybox->init('jQuery(".gallery a")');
?>