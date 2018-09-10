<?php echo $this->Metronic->portlet(__d('public', 'Lista makiet')); ?>

<div class="alert alert-info" role="alert">
	<strong><?php echo __d('publUwagaic', 'Uwaga') ?>!</strong> <?php echo __d('public', 'Aby dodać makietę należy w widoku projektu w oknienku wysyłania pliku wybrać typ') ?> 
    <strong><?php echo __d('public', 'makieta') ?></strong> <?php echo __d('public', 'i przesłać plik .zip z odpowiednią strukturą') ?>.
</div>

<div class="table-scrollable">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th class='vertical-middle text-center hidden-md hidden-sm hidden-xs'>
                
                </th>
                <th class='vertical-middle'>
                    <i class="fa fa-user"></i> <?php echo __d('public', 'Projekt') ?>
                </th>
                <th class='vertical-middle'>
                    <i class="fa fa-location-arrow"></i> <?php echo __d('public', 'Wersja') ?>
                </th>
                <th class='vertical-middle'>
                    <i class="fa fa-calendar"></i> <?php echo __d('public', 'Utworzona') ?>
                </th>
                <th class='vertical-middle'>
                    <i class="fa fa-cog"></i> <?php echo __d('public', 'Opcje') ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($mockups)) : ?>
                <?php foreach ($mockups as $mockup) : ?>
                    <tr>
                        <td class='vertical-middle text-center hidden-md hidden-sm hidden-xs'>
                            <?php echo $mockup['ProjectMockup']['id']; ?>
                        </td>
                        <td>
                            <?php echo $this->Html->link($mockup['ClientProject']['name'], array(
                                'plugin' => false,
                                'controller' => 'client_projects',
                                'action' => 'view',
                                $mockup['ClientProject']['id'],
                            )); ?>
                        </td>
                        <td><?php echo $mockup['ProjectMockup']['version']; ?></td>
                        <td><?php echo $mockup['ProjectMockup']['created']; ?></td>
                        <td>
                            <!-- Displayed only if it's a proper mockup with index.html file inside -->
                            <?php if (file_exists($mockup['ProjectMockup']['path'] . DS . 'index.html')) : ?>
                                <a class="" target="_blank" href="<?php echo $this->Html->url(array(
                                    'plugin' => 'project_mockups',
                                    'controller' => 'files',
                                    'action' => 'mockups',
                                    $mockup['ProjectMockup']['client_project_id'],
                                    $mockup['ProjectMockup']['version'],
                                    'index.html',
                                )); ?>">
                                    <i tooltip="Podgląd" class="fa fa-link large-icon pull-right"></i> 
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6">
                        <?php echo __d('public', 'Brak makiet do wyświetlenia') ?>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php echo $this->Metronic->portletEnd(); ?>
