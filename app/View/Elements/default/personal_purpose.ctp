<?php echo $this->Metronic->portlet(__d('public', 'Mój cel osobisty'), 0, 'fa  fa-lightbulb-o ', 'blue', 1, '/profiles/personal_aim'); ?>
<div class="my-target center-align">
    <?php
    if (!empty($aim['PersonalAim']['photo'])) {
        echo $this->Image->thumb('/files/personalaim/' . $aim['PersonalAim']['photo'], array('width' => 685, 'height' => 335, 'frame' => '#fff'), array('class' => 'white-border'));
    } elseif (!empty($aim['PersonalAim']['photo_url'])) {
        echo $this->Html->image($aim['PersonalAim']['photo_url'], array('width' => 'auto', 'height' => 335, 'frame' => '#fff'), array('class' => 'white-border'));
    }
    ?>
    <div class="clearfix">
        <div class="row">
            <div class="col-xs-12">
                <h4><strong><?php if (!empty($aim['PersonalAim']['name'])) echo $aim['PersonalAim']['name']; ?></strong></h4>
            </div>
            <?php
            if (!empty($aim['PersonalAim']['start_date'])) {
                ?>
                <div class="col-xs-6">
                    <p class="text-left"><?php echo __d('public', 'Początek realizacji') ?>:<br />
                        <strong><?php echo date('d.m.Y', strtotime($aim['PersonalAim']['start_date'])); ?></strong>
                    </p>
                </div>
            <?php } ?>
            <?php
            if (!empty($aim['PersonalAim']['end_date'])) {
                ?>
                <div class="col-xs-6">
                    <p class="text-right"><?php echo __d('public', 'Planowane zakończenie') ?>:<br />
                        <strong><?php echo date('d.m.Y', strtotime($aim['PersonalAim']['end_date'])); ?></strong>
                    </p>
                </div>
                <div class="col-xs-10 col-xs-offset-1">
                    <div class="time-line">
                        <span class="pull-left"></span>
                        <span class="pull-right"></span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="clearfix col-xs-10 col-xs-offset-1 margin-top-10">
            <?php echo __d('public', 'Stopień realizacji') ?>
            <div class="myAimBelt bg-grey <?php echo($aim['PersonalAim']['status']>51) ? 'half' : ''; ?>">
                <span class="bg-blue" style="width: <?php echo!empty($aim['PersonalAim']['status']) ? $aim['PersonalAim']['status'] : '0'; ?>%">
                </span>
                <p><?php echo!empty($aim['PersonalAim']['status']) ? $aim['PersonalAim']['status'] : '0'; ?>%</p>
            </div>
        </div>
    </div>
</div>

<?php echo $this->Metronic->portletEnd(); ?>