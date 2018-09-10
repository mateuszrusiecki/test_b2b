<?php echo $this->Metronic->portlet('Panel'); ?>
<div class="col-md-7">
    <?php echo $this->Metronic->portlet('Raporty[w trakcie realizacji]', 0, 'fa  fa-pie-chart', 'green', 0); ?>
    <div class="tiles">
        <div class="tile bg-blue">
            <div class="tile-body">
                <i class="fa fa-bar-chart"></i>
            </div>
            <div class="tile-object">
                <div class="name">CSMS</div>
                <div class="number">
                </div>
            </div>
        </div>
        <div class="tile bg-yellow">
            <div class="tile-body">
                <i class="fa fa-money"></i>
            </div>
            <div class="tile-object">
                <div class="name">Kadry i płace</div>

            </div>
        </div>
        <div class="tile bg-red-sunglo">
            <div class="tile-body">
                <i class="fa fa-random"></i>
            </div>
            <div class="tile-object">
                <div class="name">Zrealizowane projekty</div>

            </div>
        </div><div class="tile bg-blue">
            <div class="tile-body">
                <i class="fa fa-suitcase"></i>
            </div>
            <div class="tile-object">
                <div class="name">CSMS</div>
                <div class="number">
                </div>
            </div>
        </div><div class="tile bg-grey-silver">
            <div class="tile-body">
                <i class="fa fa-tasks"></i>
            </div>
            <div class="tile-object">
                <div class="name">Zadowolenie klientów</div>

            </div>
        </div><div class="tile bg-purple">
            <div class="tile-body">
                <i class="fa fa-road"></i>
            </div>
            <div class="tile-object">
                <div class="name">CSMS</div>

            </div>
        </div><div class="tile bg-yellow-gold">
            <div class="tile-body">
                <i class="fa fa-signal"></i>
            </div>
            <div class="tile-object">
                <div class="name">Przepływ fin. w perspektywie 3-mc.</div>

            </div>
        </div><div class="tile bg-blue-madison">
            <div class="tile-body">
                <i class="fa fa-star"></i>
            </div>
            <div class="tile-object">
                <div class="name">Ślubowisko</div>

            </div>
        </div><div class="tile bg-grey-gallery">
            <div class="tile-body">
                <i class="fa fa-users"></i>
            </div>
            <div class="tile-object">
                <div class="name">Pracownicy</div>

            </div>
        </div>
        <div class="tile bg-green-turquoise">
            <div class="tile-body">
                <i class="fa fa-shield"></i>
            </div>
            <div class="tile-object">
                <div class="name">Przepływ fin. w perspektywie 3-mc.</div>
            </div>
        </div>
    </div>
    <?php echo $this->Metronic->portletEnd(); ?>
</div>
<div class="col-md-5">  
    <?php echo $this->Element('default/personal_purpose'); ?> 
</div>
<?php echo $this->Metronic->portletEnd(); ?>

<?php echo $this->Metronic->portlet('Lista dokumentów'); ?>
<div class="portlet-body">
    <div class="tabbable-custom nav-justified">
        <ul class="nav nav-tabs nav-justified">
            <li class="active">
                <a href="#change_document" data-toggle="tab">
                    <?php echo __d('public', 'Dokumenty'); ?> </a>
            </li>
            <li>
                <a href="#change_sale" data-toggle="tab">
                    <?php echo __d('public', 'Faktury sprzedażowe'); ?> </a>
            </li>
            <li>
                <a href="#change_shopping" data-toggle="tab">
                    <?php echo __d('public', 'Faktury zakupowe'); ?> </a>
            </li>
        </ul>
        <!--BEGIN TABS-->
        <div class="tab-content">
            <div class="tab-pane active" id="change_document">
                <?php // echo $this->element('Hrs/hrs_documents'); ?>Odkomentować element
            </div>
            <div class="tab-pane" id="change_sale">
                <div class="table-scrollable table-scrollable-borderless">
                    <?php // echo $this->element('Hrs/hrs_invocies', array('type' => 1)); ?>Odkomentować element
                </div>
            </div>
            <div class="tab-pane" id="change_shopping">
                <div class="table-scrollable table-scrollable-borderless">
                    <?php // echo $this->element('Hrs/hrs_invocies', array('type' => 2)); ?>Odkomentować element
                </div>
            </div>

            <div class="modal modal1 fade" id="basic" tabindex="-1" role="basic" aria-hidden="true" style="display: none;" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Zmień opis faktury</h4>
                        </div>
                        <div class="modal-body">
                            <div class="note note-warning" ng-if="desc_error">
                                <p> Wystąpił błąd. </p>
                            </div>

                            <textarea name="description" ng-model="invoice.description" class="col-md-12 mb5 form-control margin-bottom-10 ng-pristine ng-valid ng-scope ng-touched float-none">
								{{ invoice.description}} </textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn default" data-dismiss="modal">Close</button>
                            <button type="button" ng-click="updateDescription()" class="btn blue">Save changes</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal modal2 fade" id="link_invoice_to_project" tabindex="-1" role="link_invoice_to_project" aria-hidden="true" style="display: none;" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Przypisz fakturę do projektu</h4>
                        </div>
                        <div class="modal-body">
                            <?php
                            echo $this->Metronic->input('project_id', array(
                                'label' => false,
                                'ng-model' => 'project_id',
                                'class' => 'form-control clear',
                                'type' => 'select',
                                'options' => $projectList,
                                'required' => 'required',
                                'empty' => __d('public', 'wybierz projekt')
                            ));
                            ?>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn default" data-dismiss="modal">Close</button>
                            <button type="button" ng-click="linkInvoiceToProject(project_id)" class="btn blue"><img ng-if="loading" src="/img/loader_orange_blue.gif" alt="loading" /> Save changes</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
    </div>
</div>
<?php echo $this->Metronic->portletEnd(); ?>


<?php echo $this->Metronic->portlet('Lista projektów'); ?>

<?php echo $this->element('ClientProjects/table_index_no_ajax'); ?> 

<?php echo $this->Html->css('/fonts/chouette_alorsregular.css', null, array('inline' => 'false')); ?>
<?php echo $this->Metronic->portletEnd(); ?>


<?php echo $this->Metronic->portlet('Podsumowanie zadań w systemie PM'); ?>
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
    <?php echo $this->Metronic->portlet('Zadania przypisane do mnie', 1); ?>
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
    <?php echo $this->Metronic->portletHiden('Zadania utworzone przeze mnie', 1); ?>
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