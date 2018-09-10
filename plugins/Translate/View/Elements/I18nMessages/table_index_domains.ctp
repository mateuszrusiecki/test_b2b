<div class="table-scrollable" id="issuesAssignedTo">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th><i class="fa fa-suitase"></i> <?php echo __d('cms', 'Domain'); ?></th>
                <th class="actions"><i class="fa fa-cogs"></i> <?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($domains as $domain):
                ?>
                <tr>
                    <td><?php echo h($domain); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Permissions->link(__('View'), array('action' => 'domain', $domain), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>