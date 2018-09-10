    <?php
    foreach ($fileCategory as $idcat => $cat)
    {
        $file = empty($files[$idcat]) ? array() : $files[$idcat];
        ?>
        <div ng-init="files['<?php echo $idcat ?>'] = <?php echo h(json_encode($file)); ?>"
             class="col-md-12 mt10"
             ng-drop-success="onDrop('<?php echo $idcat ?>',$data,$event)"
             ng-drop="true" 
             >
            <p>
                <b><?php echo $cat; ?></b>
            </p>
            <div ng-show="!files['<?php echo $idcat ?>'].length && isDrag" class="note note-success ng-hide"><?php echo __d('public', 'Upuść tutaj') ?></div>
            <div ng-show="!files['<?php echo $idcat ?>'].length && !isDrag" class="note note-warning ng-hide">(<?php echo __d('public', 'brak dokumentów w tej kategorii') ?>)</div>
            <a ng-cloak ng-repeat="tile in files['<?php echo $idcat ?>']"
               class="icon-btn"
               href="javascript:;"
               ng-drag="true"
               data-allow-transform="true"
               ng-drag-success="onDragOver($data,$event)" 
               ng-drag-data="tile"
               >
                <span 
                    class="badge badge-danger" 
                    ng-if="tile.delete" 
                    ng-click="tile.delete = !tile.delete">&nbsp;&nbsp;</span>
                <span 
                    class="badge badge-success" 
                    ng-if="!tile.delete" 
                    ng-click="tile.delete = !tile.delete">✔</span>
                <i class="fa fa-file"><i></i></i>
                <div>
                    {{tile.file}}
                </div>
            </a>

        </div>
        <?php
    }
    ?>

    <textarea class="ng-hide" name="data[ClientProject][files]">{{files}}</textarea>
<?php
echo $this->Html->script('angular/controllers/AddProjectCtrl', array('block' => 'angular'))?>