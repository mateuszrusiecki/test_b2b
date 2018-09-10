<div class="portlet-body">
    <div class="row">
        
        <div class="col-md-6 col-xs-12">
            <?php
            echo $this->Form->input('active', array('label' => __d('cms', 'Active'),'type'=>'checkbox', 'default' => 1));
            echo $this->Metronic->input('name', array('label' => __d('cms', 'Name')));
            echo $this->Metronic->input('N', array('label' => __d('cms', 'N')));
            echo $this->Metronic->input('m', array('label' => __d('cms', 'M')));
            echo $this->Metronic->input('d', array('label' => __d('cms', 'D')));
            echo $this->Metronic->input('H', array('label' => __d('cms', 'H')));
            echo $this->Metronic->input('i', array('label' => __d('cms', 'I')));
            echo $this->Metronic->input('url', array('label' => __d('cms', 'Url')));
            ?>
        </div>
        <div class="col-md-6 col-xs-12">
            <ul>
                <li><?php echo __d('public', 'Puste pole wykonuje się za każdym razem') ?></li>
                <li>* - <?php echo __d('public', 'wykonuje się za każdym razem') ?></li>
                <li>13,22 - <?php echo __d('public', 'wykonuje się') ?> 13 i 22</li>
                <li>url - <?php echo __d('public', 'podajemy w stringu np \'/test/test\'') ?></li>
                <li><?php echo __d('public', 'dzień dygodnia - 1 to poniedziałek a 7 to niedziela') ?></li>
            </ul>
        </div>
    </div>
</div>
