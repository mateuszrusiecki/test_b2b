<?php echo $this->Metronic->portlet(__d('public', 'Zarządzanie kopiami bezpieczeństwa')); ?>	


    <table class="table table-striped table-bordered table-advance table-hover">
                <thead>
                    <tr>
                        <th>
                            <i class="fa fa-briefcase"></i> <?php echo __d('public', 'Rodzaj backupu') ?>
                        </th>
                        <th>
                            <i class="fa fa-arrow-right"></i> <?php echo __d('public', 'Lokalizacja') ?>
                        </th>
                        <th>
                            <i class="fa fa-calendar "></i> <?php echo __d('public', 'Data utworzenia') ?>
                        </th>
                        <th>
                            <i class="fa fa-link"></i> <?php echo __d('public', 'Akcje') ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($sql_to_download)): ?>
                        <tr>
                            <td><?php echo __d('public', 'Backup bazy danych'); ?></td>
                            <td>http://<?php echo $_SERVER['SERVER_NAME'].'/backup/'.$sql_to_download ?></td>
                            <td><?php echo $sql_created_date ?></td>
                            <td><a href='/fronts/download_backup/<?php echo $sql_to_download ?>' tooltip="Pobierz kopie" target="_blank">Pobierz</a></td>
                        </tr>
                    <?php endif; ?>
                    <?php if(!empty($files_to_download)): ?>
                        <tr>
                            <td><?php echo __d('public', 'Backup plików'); ?></td>
                            <td>http://<?php echo $_SERVER['SERVER_NAME'].'/backup/'.$files_to_download ?></td>
                            <td><?php echo $files_created_date ?></td>
                            <td><a href='/fronts/download_backup/<?php echo $files_to_download ?>' tooltip="Pobierz kopie" target="_blank">Pobierz</a></td>
                        </tr>
                    <?php endif; ?>

                </tbody>
    </table>
    <?php echo $this->Form->create('download'); ?>
        <?php echo $this->Form->input('download.get_file', array(
            //'value' => $this->Session->read('Auth.User.id'),
            'type' => 'hidden',
            'label' => false 
        )); ?>
<br/>
        <?php echo $this->Form->submit(__d('public', 'Stwórz kopie bezpieczeństwa bazy danych'), array('class' => 'btn green-haze clear', 'div' => false)); ?>

    <?php echo $this->Form->end(); ?>
<?php echo $this->Metronic->portletEnd(); ?>