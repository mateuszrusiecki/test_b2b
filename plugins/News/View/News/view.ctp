<?php
echo $this->Html->meta('description', '', array('inline' => false));
echo $this->Html->meta('keywords', '', array('inline' => false));
$this->set('title_for_layout',  $news['News']['title']);
?>

<div id="page" class="news view">
    <div class="title">
        <h1><?php echo h($news['News']['title']); ?></h1>
    </div>
    <div id="tinymce">
        <?php echo $news['News']['content']; ?>
        <div class="galleries clearfix">
            <?php
            foreach($news['Photos'] as $gallery){
                echo $this->Html->div('gallery', 
                    $this->Image->thumb('/files/photo/'.$gallery['img'], array('width'=>150,'height'=>150), array('url'=>'/files/photo/'.$gallery['img'])), 
                    array('escape'=>false));
            }
            ?>
        </div>
    </div>
</div>
<?php 
$this->Fancybox->init('jQuery(".gallery a")');
?>