<?php echo $this->Metronic->portlet(__d('public','Obiegówka')); ?>
<div class="portlet-body circullation_card">
    <div class="clearfix">
        <div class="col-lg-2 col-md-3 col-xs-12 col-sm-6 margin-bottom-10">
            <div class="input-icon right">
                <i class="icon-magnifier"></i>
                <input  type="text" side="right" class="pull-left form-control form-control-inline" name="" placeholder="<?php echo __d('public', 'Szukaj') ?>">
            </div>
        </div>
    </div>
    <div  class="portlet-body">            
        <div class="table-scrollable">
            <table class="table table-bordered table-advance table-hover tbody-striped">
                <thead>
                <th class='vertical-middle center-lg'><i class="fa fa-briefcase"></i> <?php echo __d('public', 'Dział'); ?></th>
                <th class='vertical-middle center-lg hidden-xs'><i class="fa fa-calendar"></i> <?php echo __d('public', 'Data'); ?></th>
                <th><i class="fa fa-cog"></i>  <?php echo __d('public', 'Obiegówka'); ?></th>
                </thead>
                <tbody>
                    <tr >
                        <td>
                            <i class="fa fa-plus pointnier"></i>
                            <span class="ml" > IT</span>
                        </td>
                        <td class="hidden-xs">2015-05-04</td>
                        <td class="action"   >

                            <a href="" download target="_blank" class="">
                                <i class="fa fa-download large-icon pull-left" tooltip="Pobierz"></i> 
                            </a>  
                            obiegowka_it_actaully.zip
                            <a title="Dodaj nowszą wersję pliku" class="pointer pull-right">
                                <span class="glyphicon glyphicon-file"> <i class="fa fa-plus"></i> </span>
                            </a>
                        </td>
                    </tr>  
                    <tr>
                        <td>
                        </td>
                        <td class="hidden-xs">2015-04-04</td>
                        <td class="action"   >
                            <a href="" download target="_blank" class="">
                                <i class="fa fa-download pull-left margin-top-5 margin-left-8 text-black" tooltip="Pobierz"> </i> 
                            </a>  
                            &nbsp;stara_obiegowka_it_actaully.zip
                        </td>
                    </tr>  
                </tbody>
                <tbody>
                    <tr >
                        <td>
                            <i class="fa fa-plus pointnier"></i>
                            <span class="ml" > SEO</span>
                        </td>
                        <td class="hidden-xs">2015-05-04</td>
                        <td class="action"   >
                            <a href="" download target="_blank" class="">
                                <i class="fa fa-download large-icon pull-left" tooltip="Pobierz"></i> 
                            </a>  
                            obiegowka_o1.zip
                            <a title="Dodaj nowszą wersję pliku" class="pointer pull-right">
                                <span class="glyphicon glyphicon-file"> <i class="fa fa-plus"></i> </span>
                            </a>
                        </td>
                    </tr>  
                </tbody>
            </table>
        </div>
        <pagination last-text="»" first-text="«" next-text="›" previous-text="‹" ng-model="currentPageFiles" items-per-page="10" total-items="projectFiles| filterHrFiles: projectFilesFilter  | length" boundary-links="true"></pagination>

    </div>
</div>

<?php echo $this->Metronic->portletEnd(); ?>