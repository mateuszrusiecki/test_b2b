<?php echo $this->Html->css('/modification/css/modification', null, array('inline' => 'false')); ?>

<?php echo $this->Metronic->portlet('Log systemowy'); ?>
<div class="clearfix">
    <?php echo $this->Permissions->link(__d('cms', 'Dodaj %s', 'użytkownika'), array('action' => 'admin_add'), array('class' => 'btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier')); ?>
</div>
<div class="filterPhp">
    <?php echo $this->Filter->formCreate($filtersSettings, array('legend' => 'Filtruj', 'submit' => 'filtruj')); ?>
    <?php $this->Paginator->options(array('url' => $filtersParams)); ?>
</div>
<div class="table-scrollable" id="issuesAssignedTo">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th><i class="fa fa-calendar"></i> <?php echo $this->Paginator->sort('created', __d('cms', '')); ?></th>
                <th><i class="fa fa-user"></i> <?php echo __d('cms', 'Użytkownik'); ?></th>
                <th><i class="fa fa-comment"></i> <?php echo __d('cms', 'Komunikat'); ?></th>
                <th><i class="fa fa-cogs"></i> </th>
            </tr>
        </thead>
        <?php foreach ($modifications as $modification): ?>
            <tr data-id="<?php echo $modification['Modification']['id']; ?>">
                <td><?php echo $this->FebTime->niceShort($modification['Modification']['created']); ?></td>
                <td><?php echo $modification['Modification']['User']['name']; ?>&nbsp;(<?php echo $modification['Modification']['User']['email']; ?>)</td>
                <td><?php echo $this->FebModification->detalis($modification); ?></td>
                <td class="actions"><?php echo $this->Html->link('<i class="fa fa-cubes font-large pull-right"></i>', '#', array('class' => 'button', 'escape'=>false)); ?></td>
            </tr>
            <tr style="display: none" data-id2="<?php echo $modification['Modification']['id']; ?>">
                <td>&nbsp;</td>
                <td><b>Przed: </b><br/>
                    <pre><?php echo!empty($modification['Modification']['Before']) ? str_replace(array('Array', ' =>'), array('', ':'), print_r($modification['Modification']['Before'], true)) : 'Brak'; ?></pre>
                </td>
                <td><b>Po: </b><br/>
                    <pre><?php echo!empty($modification['Modification']['After']) ? str_replace(array('Array', ' =>'), array('', ':'), print_r($modification['Modification']['After'], true)) : 'Brak'; ?></pre>
                </td>
                <td>&nbsp;</td>
            </tr>
        <?php endforeach; ?>
    </table>

    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>	</p>

    <div class="paging">
        <?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>
<?php echo $this->Metronic->portletEnd(); ?>

<script type="text/javascript">
    $(function () {

        $('.date').datepicker({
            showOn: "button",
            buttonImage: "/img/calendar.gif",
            dateFormat: 'yy-mm-dd'
        });

        $('.actions .button').click(function (e) {
            $(this).parents('tr').next().slideToggle();
            e.preventDefault();
        });
    });
</script>