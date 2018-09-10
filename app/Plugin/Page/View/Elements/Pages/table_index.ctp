<div class="table-scrollable" id="issuesAssignedTo">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th><i class="fa fa-suitcase"></i> <?php echo __d('cms', 'Nazwa'); ?></th>
                <th><i class="fa fa-link"></i> <?php echo __d('cms', 'Link'); ?></th>
                <th class="actions"><i class="fa fa-cog"></i> <?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pages as $page): ?>
                <tr>
                    <td><?php echo $page['Page']['name']; ?> </td>
                    <td><?php echo $this->Html->link($page['Page']['slug'], array('admin' => false, 'controller' => 'pages', 'action' => 'view', $page['Page']['slug'])); ?> 
                    </td>
                    <td class="actions">
                        <?php //echo $this->Html->link(__('Edytuj'), array('action'=>'edit', $page['Page']['id']),array(),null,false); ?>
                        <?php //echo $this->Html->link(__('Klonuj'), array('action'=>'add',$page['Page']['id']),array(),null,false);  ?>
                        <?php //echo $this->Html->link(__d('cms','Usuń'), array('action'=>'delete', $page['Page']['id']), null, __('Czy napewno chcesz usunąć strone # %s?', $page['Page']['name']),false); ?>
                        <?php echo $this->element('Translate.flags/trash', array('data' => $page, 'model' => 'Page')); ?> 

                        <div class="actionButton">
                            <span>Edytuj</span>
                            <?php echo $this->Html->div('clearfix', $this->element('Translate.flags/flags', array('url' => array_merge(array('action' => 'edit', $page['Page']['id'])), 'active' => $page['translateDisplay'], 'title' => __d('cms', 'Edytuj')))); ?>
                        </div>
                        <?php // if ($page['Page']['gallery'] == 1): ?>
    <!--                            <div class="button"> <?php // echo __d('cms', 'Zdjęcia');  ?> <br />
                        <?php // echo $this->Html->image('layouts/admin/img.png', array('url' => array('plugin' => 'photo', 'controller' => 'photos', 'action' => 'index', 'Page.Page', $page['Page']['id']))); ?>
                            </div>-->
                        <?php // endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
