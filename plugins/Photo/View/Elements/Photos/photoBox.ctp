<?php
$imageOptions = array('width' => 190, 'height' => 190, 'frame' => 'ffffff');
$photoImage = $this->Image->thumb('/files/photo/' . $photo['Photo']['img'], $imageOptions, array('class' => 'uploadedImage'));
$this->Html->div('photoBox', $photoImage);

$isParentPhotoOption = false;
if (isSet($photo[$model]['photo_id']) || $photo[$model]['photo_id'] == null) {
    //Jest zdjęcie główne
    $isParentPhotoOption = true;    
}
?>
<div data-id="<?php echo $photo['Photo']['id']; ?>" class="photoBox <?php echo ($isParentPhotoOption && $photo[$model]['photo_id'] == $photo['Photo']['id']) ? 'isParentPhoto' : '' ?>" id="PhotoBox-<?php echo $photo['Photo']['id']; ?>">
    <?php echo $photoImage; ?>
    <ul class="imageTollbar">
        <?php echo (isSet($isParentPhotoOption)) ? $this->Permissions->link($this->Html->image('/photo/img/parent.png', array('title' => __d('cms', 'Ustaw jako główne'))), array('action' => 'set_parent'), array('class' => 'setParent', 'outter' => '<li>%s</li>', 'escape' => false)) : ''; ?>
        <?php echo $this->Permissions->link($this->Html->image('/photo/img/txt.png', array('title' => __d('cms', 'Ustaw opis zdjęcia'))), array('action' => 'get_title', $photo['Photo']['id']), array('class' => 'get_title', 'outter' => '<li>%s</li>', 'escape' => false)); ?>
        <li><?php echo $this->Html->link($this->Html->image('/photo/img/cut.png', array('title' => __d('cms', 'Przytnij zdjęcie'))), '', array('class' => 'cropPhoto', 'escape' => false, 'onclick' => "editCrop('Photo.Photo', 'img', " . $photo['Photo']['id'] . ", '".$model."');", 'default' => false)); ?></li> 

        <?php echo $this->Permissions->link($this->Html->image('/photo/img/del.png', array('title' => __d('cms', 'Usuń zdjęcie'))), array('action' => 'delete', $photo['Photo']['id']), array('class' => 'deletePhoto', 'outter' => '<li>%s</li>', 'escape' => false)); ?>
    </ul>
    <span class="imageTitle"><?php
        $title = !empty($photo['Photo']['title']) ? $this->Text->truncate($photo['Photo']['title'], '50') : '<i>Brak opisu</i>';
        echo $this->Permissions->link($title, array('action' => 'get_title', $photo['Photo']['id']), array('class' => 'get_title', 'escape' => false, 'alt' => __d('cms', 'Ustaw opis zdjęcia')));
        ?></span>
</div>

<script type="text/javascript">
    $(function(){
        $('#PhotoBox-<?php echo $photo['Photo']['id']; ?>').find('.deletePhoto').click(function(event){
            if (confirm('<?php echo __d('cms', 'Jesteś pewny usunięcia zdjęcia?'); ?>')) {
                deletePhoto({id: '<?php echo $photo['Photo']['id'] ?>'});
            }
            event.preventDefault(); 
        });
        $('#PhotoBox-<?php echo $photo['Photo']['id']; ?>').find('.setParent').click(function(event) {
            setParent({id: '<?php echo $photo['Photo']['id'] ?>'});
            event.preventDefault(); 
        });
        
        initQtip($('#PhotoBox-<?php echo $photo['Photo']['id']; ?>').find('.get_title'));
        
        $('#PhotoBox-<?php echo $photo['Photo']['id']; ?>').find('.get_title').click(function(event) { 
            event.preventDefault(); 
        });
        
    });
</script>

