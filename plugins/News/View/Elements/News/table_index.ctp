<h2><?php echo __d('cms', 'News'); ?></h2>
<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('photo_id', __d('cms', 'Photo Id')); ?></th>
            <th><?php echo $this->Paginator->sort('main', __d('cms', 'Main')); ?></th>
            <th><?php echo $this->Paginator->sort('title', __d('cms', 'Title')); ?></th>
            <th><?php echo $this->Paginator->sort('user_id', __d('cms', 'User Id')); ?></th>
            <th><?php echo $this->Paginator->sort('created', __d('cms', 'Created')); ?>&nbsp;&middot;&nbsp;<?php echo $this->Paginator->sort('modified', __d('cms', 'Modified')); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
        
        <?php
        $i = 0;
        foreach ($news as $news):
            ?>
            <tr data-id="<?php echo $news['News']['id']; ?>">
                <td>
                    <?php echo $this->Image->thumb('/files/photo/' . $news['Photo']['img'], array('width' => 100, 'height' => 100)); ?>
                </td>
                <td><?php echo h($news['News']['main'] ? __d('cms', 'TAK') : __d('cms', 'NIE')); ?>&nbsp;</td>
                <td><?php echo h($news['News']['title']); ?>&nbsp;</td>
                <td>
                    <?php echo $this->Permissions->link($news['User']['name'], array('plugin' => 'user','controller' => 'users', 'action' => 'edit', $news['User']['id'])); ?>
                </td>
                <td><?php echo $this->FebTime->niceShort($news['News']['created']); ?>&nbsp;&middot;&nbsp;<?php echo $this->FebTime->niceShort($news['News']['modified']); ?></td>
                <td class="actions">
                    <?php //echo $this->Permissions->link(__('View'), array('action' => 'view', $news['News']['id'])); ?>
                    <?php echo $this->Permissions->link(__('Zdjęcia'), array('plugin' => 'photo', 'controller' => 'photos', 'action' => 'index', 'News.News', $news['News']['id'])); ?>
                    

                    <div class="button"> Edytuj<br />
                        <?php echo $this->Html->div('clearfix', $this->element('Translate.flags/flags', array('url' => array_merge(array('action' => 'edit', $news['News']['id'])), 'active' => $news['translateDisplay'], 'title' => __d('cms', 'Edytuj')))); ?>
                    </div>
                    <?php echo $this->element('Translate.flags/trash', array('data' => $news, 'model' => 'News')); ?> 
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>