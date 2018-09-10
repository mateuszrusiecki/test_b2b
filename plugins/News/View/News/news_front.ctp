<?php foreach ($news as $new){
    $linkView = array('controller'=>'news','plugin'=>'news','action'=>'view',$new['News']['slug']);
?>

    <?php // echo $this->Html->image('/files/photo/'.$new['Photo']['img']); ?>
    <h2> <?php echo $new['News']['title']; ?></h2>
    <?php echo $this->Image->thumb('/files/photo/'.$new['Photo']['img'],array('width'=>'100','height'=>'100')); ?>
    <p>
    <?php echo $this->Text->truncate(strip_tags($new['News']['content']), 200 ) ?> 
    </p>
    <p>
        <?php echo $this->Html->link('Dowiedz się więcej »', $linkView, array('class'=>'btn')); ?>
    </p>
    
<?php } ?>