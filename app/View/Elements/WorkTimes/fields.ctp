<div class="col-md-6 col-xs-12">
    <?php
    echo $this->Metronic->input('year', array('label' => __d('cms', 'Year')));
    echo $this->Metronic->input('month', array('label' => __d('cms', 'Month')));
    echo $this->Metronic->input('work_hours', array('label' => __d('cms', 'Work Hours')));
    ?>
</div>
<div class="col-md-6 col-xs-12">
    <?php
    echo $this->Metronic->input('work_days', array('label' => __d('cms', 'Work Days')));
    echo $this->Metronic->input('days_off', array('label' => __d('cms', 'Days Off')));
    ?>
</div>
