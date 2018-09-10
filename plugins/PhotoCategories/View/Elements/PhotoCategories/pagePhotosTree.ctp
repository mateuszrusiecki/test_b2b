<?php //debug($data); ?>
<?php if (!empty($data)): ?>
    <?php
        //debug($depth);
        //Poziom zagłebienia
        $hIndex = $depth + 1;
    ?>
    <?php foreach ($data as $tree): ?>
        <h<?php echo $hIndex; ?>><?php echo $tree['PhotoCategory']['name']; ?></h<?php echo $hIndex; ?>>
        <?php echo !empty($tree['PhotoCategory']['desc'])?$tree['PhotoCategory']['desc']:''; ?>
        <div class="clearfix">
            <?php foreach ($tree['Photo'] as $photo): ?>
                <?php
                    $image = $this->Image->thumb('/files/photo/'.$photo['img'], array('width' => 200, 'height' => 200));
                    $imageLink = $this->Html->link($image, '/files/photo/'.$photo['img'], array('escape' => false, 'title' => $photo['title'], 'rel' => $tree['PhotoCategory']['id']));
                    echo $this->Html->div('gallery', $imageLink);
                ?>
            <?php endforeach; ?>
        </div>
        <?php echo $this->element('PhotoCategories/pagePhotosTree', array('data' => $tree['children'], 'depth' => $depth+1), array('plugin' => 'PhotoCategories')); ?>                     
    <?php endforeach; ?>
<?php endif; ?>

