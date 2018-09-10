<?php if ($data): ?>
    <?php echo empty($FirstJsTrue) ? $this->Html->link('&ndash;', '#', array('class' => 'toggle', 'escape' => false)) : ''; ?>
    <ul>
        <?php foreach ($data as $key => $value): ?>
            <li id="category_<?php echo $value['PhotoCategory']['id']; ?>">
                <?php echo ($key == 0) ? $this->Html->div(null, '&nbsp;', array('escape' => false, 'class' => 'sortTop sort')) : ''; ?>            
                <?php echo $this->element('PhotoCategories/li_position', array('value' => $value, 'treeMode' => $treeMode)); ?>
                <?php
                echo $this->element('PhotoCategories/draw', array(
                    'data' => $value['children'],
                    'treeMode' => $treeMode
                ));
                ?>
                <div class="sortDown sort" > &nbsp;</div>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>



<?php
if (isset($FirstJsTrue)):

    echo $this->Js->writeBuffer();
    ?>
    <script type="text/javascript">
        initTree();
        urlPostUpdate = '<?php echo $this->Html->url(array('controller' => 'photo_categories', 'action' => 'update'), true); ?>';
        url = '<?php echo $this->Html->url(array('controller' => 'photo_categories', 'action' => 'index', $this->params['pass'][0]), true); ?>';

        jQuery("div#tree li.firstLiTree").dblclick(function(){
            jQuery(this).removeClass("firstLiTree");
        });
        
    </script>
<?php endif; ?>