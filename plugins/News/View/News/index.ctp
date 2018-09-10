<?php
echo $this->Html->meta('description', '', array('inline' => false));
echo $this->Html->meta('keywords', '', array('inline' => false));
$this->set('title_for_layout', __d('public', 'Aktualności'));
?>

<div class="title">
    <h1><?php echo __d('public', 'Aktualności'); ?></h1>
</div>
<div class="clearfix NewsList">
    <?php
    foreach ($news as $new) {
        $viewLink = array('action' => 'view', $new['News']['slug']);
        ?>
        <div class="news row-fluid" id="news-<?php echo $new['News']['id']; ?>">
            <div class="row-fluid">
                <div class="span12 title">
                    <h3><?php echo $this->Html->link($new['News']['title'], $viewLink); ?></h3> 
                </div>
            </div>
            <div class="row-fluid">
                <?php if(!empty($new['Photo']['img'])): ?>
                <div class="span4 photo">
                    <?php echo $this->Image->thumb('/files/photo/' . $new['Photo']['img'], array('height' => '200', 'width' => '300'), array('url' => $viewLink)); ?>
                </div>
                <?php endif; ?>
                <div class="<?php if(!empty($new['Photo']['img'])): ?>span8 <?php else: ?> span12 <?php endif; ?> content">
                    <?php echo $this->Text->truncate(strip_tags($new['News']['content']), 500); ?>
                    <?php echo $this->Html->link(__d('public', 'więcej') . '&nbsp;»', $viewLink, array('escape' => false)) ?>
                </div>
            </div>
        </div>

    <?php } ?>
</div>
<?php
//$this->Paginator->options(array(
//    'update' => '#indexNews',
//    'evalScripts' => true
//));

//echo $this->element('default/paginator');
//echo $this->Js->writeBuffer();
?>

