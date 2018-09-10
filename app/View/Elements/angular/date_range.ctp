<?php //https://github.com/monterail/angular-date-range-picker ?>
<?php echo $this->Html->css('angular-date-range-picker', null, array('inline' => false)) ?>
<?php echo $this->Html->script('angular/bindonce.min', array('block' => 'angular-lib')) ?>
<?php echo $this->Html->script('angular/moment-range.min', array('block' => 'angular-lib')) ?>
<?php echo $this->Html->script('angular/angular-date-range-picker.min', array('block' => 'angular-lib')) ?>
<?php echo $this->Html->scriptBlock("window.loadedDependencies.push('dateRangePicker')", array('block' => 'angular-lib')) ?>
