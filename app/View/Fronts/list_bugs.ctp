<?php echo $this->Metronic->portlet(__d('public', 'Lista uwag')); ?>
<div class="clearfix">
    <div class="col-md-3">
        <form>
            <?php
            echo $this->Metronic->input('search_box', array(
                //'label' => __d('public','Szukaj'),
                'placeholder' => __d('public', 'Szukaj'),
                'type' => 'text',
                'ng-model' => 'name',
                'class' => ' form-control form-control-inline',
            ));
            ?>
        </form>
    </div>	
</div>
<div class="table-scrollable" id="issuesAssignedTo">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>  
            <tr>
                <th><?php echo __d('public', '#'); ?> </th>
                <th><i class="fa fa-chain"></i> <?php echo __d('public', 'URL'); ?></th>
                <th><i class="fa fa-comment"></i> <?php echo __d('public', 'Opis uwagi'); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>
                    /buglist
                </td>
                <td>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consequat ante arcu, non scelerisque risus ullamcorper non. 
                </td>
            </tr>
        </tbody>
    </table>
</div>
</div>

<?php echo $this->Metronic->portletEnd(); ?>