<?php echo $this->Metronic->portlet(__d('public', 'Lista projektów')); ?>

<?php echo $this->element('ClientProjects/table_index_no_ajax'); ?> 

<?php echo $this->Metronic->portletEnd(); ?>
<?php echo $this->Metronic->portlet(__d('public', 'Podsumowanie zadań w systemie PM')); ?>
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

    <div class="col-md-3" >
        <?php
        echo $this->Metronic->input('project_quick_jump_box', array(
            'class' => 'form-control col-md-3',
            'options' => '',
            'type' => 'select',
            'ng-change' => 'jump()',
            'ng-model' => 'projects',
            'ng-init' => 'projects = 0',
        ));
        ?> 
    </div>
</div>
<div class="row" id="assigned_to_me">
    <?php echo $this->Metronic->portlet(__d('public', 'Zadania przypisane do mnie'), 1); ?>
    <div class="table-scrollable" id="issuesAssignedTo">
        <table class="table table-striped table-bordered table-advance table-hover">
            <thead>  
                <tr>
                    <th><?php echo __d('public', '#'); ?> </th>
                    <th><i class="fa fa-briefcase"></i> <?php echo __d('public', 'Projekt'); ?></th>
                    <th><i class="fa fa-signal"></i> <?php echo __d('public', 'Priorytet'); ?></th>
                    <th><i class="fa fa-calendar"></i> <?php echo __d('public', 'Termin'); ?></th>
                    <th><i class="fa fa-suitcase"></i> <?php echo __d('public', 'Temat'); ?></th>
                    <th><i class="fa fa-user"></i> <?php echo __d('public', 'Osoba przypisująca'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>16718</td>
                    <td>
                        feb.b2b
                    </td>
                    <td>
                        Normal
                    </td>
                    <td>
                        2015-04-30
                    </td>
                    <td>
                        <a target="blank" href="http://pm.feb.net.pl/issues/16718"> feb_b2b :: widok sekretariatu (Lista urlopów i wnioski urlopowe oczekujące na rozpatrzenie. )</a>
                    </td>
                    <td>
                        Mateusz Rusiecki
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <?php echo $this->Metronic->portletEnd(); ?>
</div>


<div class="row" id="added_by_me">
    <?php echo $this->Metronic->portletHiden(__d('public', 'Zadania utworzone przeze mnie'), 1); ?>
    <div class="table-scrollable">
        <table class="table table-striped table-bordered table-advance table-hover">
            <thead>
                <tr>
                    <th><?php echo __d('public', '#'); ?> </th>
                    <th><i class="fa fa-briefcase"></i> <?php echo __d('public', 'Projekt'); ?></th>
                    <th><i class="fa fa-signal"></i> <?php echo __d('public', 'Priorytet'); ?></th>
                    <th><i class="fa fa-calendar"></i> <?php echo __d('public', 'Termin'); ?></th>
                    <th><i class="fa fa-suitcase"></i> <?php echo __d('public', 'Temat'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>16718</td>
                    <td>
                        feb.b2b
                    </td>
                    <td>
                        Normal
                    </td>
                    <td>
                        2015-04-30
                    </td>
                    <td>
                        <a target="blank" href="http://pm.feb.net.pl/issues/16718"> feb_b2b :: widok sekretariatu (Lista urlopów i wnioski urlopowe oczekujące na rozpatrzenie. )</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php echo $this->Metronic->portletEnd(); ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>
<?php echo $this->Metronic->portlet(__d('public','Inne')); ?>
<div class="col-md-7">
    <?php echo $this->Element('default/my_team'); ?> 
</div>
<div class="col-md-5">
    <?php echo $this->Element('default/personal_purpose'); ?> 
</div>
<?php echo $this->Metronic->portletEnd(); ?>