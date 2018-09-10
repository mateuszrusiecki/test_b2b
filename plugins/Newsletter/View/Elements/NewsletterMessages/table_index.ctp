<h2><?php echo __d('cms', 'Lista wiadomości newslettera'); ?></h2>
<table cellpadding="0" cellspacing="0">
    <tr>
        <th><?php echo $this->Paginator->sort('title', __d('cms', 'Title')); ?></th>
        <th><?php echo $this->Paginator->sort('content', __d('cms', 'Content')); ?></th>
        <th><?php echo $this->Paginator->sort('sender_name', __d('cms', 'Sender Name')); ?> (<?php echo $this->Paginator->sort('sender_email',  __d('cms', 'Sender Email')); ?>)</th>
        <th><?php echo $this->Paginator->sort('recipients', __d('cms', 'Recipients')); ?> / <?php echo $this->Paginator->sort('recipients', __d('cms', 'Progress')); ?></th>
        <th><?php echo $this->Paginator->sort('modified', __d('cms', 'Modified').' '.__d('cms', '(send)')); ?></th>
        <th class="actions"><?php echo __d('cms', 'Actions'); ?></th>
    </tr>
    <?php
    $i = 0;
    foreach ($newsletterMessages as $newsletterMessage):
        $class = null;
        if ($i++ % 2 == 0) {
            $class = ' class="altrow"';
        }
        ?>
        <tr<?php echo $class; ?>>
            <td><?php echo $newsletterMessage['NewsletterMessage']['title']; ?>&nbsp;</td>
            <td><?php echo $newsletterMessage['NewsletterMessage']['content']; ?>&nbsp;</td>
            <td><?php echo $newsletterMessage['NewsletterMessage']['sender_name']; ?>&nbsp;(<?php echo $newsletterMessage['NewsletterMessage']['sender_email']; ?>)&nbsp;</td>
            <td><?php echo $newsletterMessage['NewsletterMessage']['recipients'].' / '.$newsletterMessage['NewsletterMessage']['progress']; ?>&nbsp;</td>
            <td><?php echo $newsletterMessage['NewsletterMessage']['modified']; ?>&nbsp;</td>
            <td class="actions">
                <?php echo $this->Html->link(__('Podgląd'), array('action' => 'view', $newsletterMessage['NewsletterMessage']['id'])); ?>
                <?php echo ($newsletterMessage['NewsletterMessage']['status']) ? '' : $this->Html->link(__('Edytuj'), array('controller' => 'newsletter_messages', 'action' => 'edit', $newsletterMessage['NewsletterMessage']['id'])); ?>
                <?php echo ($newsletterMessage['NewsletterMessage']['status']) ? '' : $this->Html->link(__('Usuń'), array('controller' => 'newsletter_messages', 'action' => 'delete', $newsletterMessage['NewsletterMessage']['id']), null, __('Na pewno usunąć "%s"? Usunięcie wiadomości podczas wysyłania tego mailingu spowoduje krytyczny błąd!', $newsletterMessage['NewsletterMessage']['title'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>