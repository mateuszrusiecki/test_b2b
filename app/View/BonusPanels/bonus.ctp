<div ng-controller="BonusCtrl" class="clearfix">
    <div class="col-xs-12">
        <div style="border-left: 7px solid <?php echo $project['ClientProject']['color']; ?>;" class="modifiedProjectTopTitle">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <h2>
                        <?php echo $project['ClientProject']['name']; ?>
                        (<?php echo $project['ClientProject']['alias']; ?>)
                    </h2>
                    <br>
                    <p>
                        Kierownik projektu: 
                        <b>
                            <?php echo $project['Profile']['firstname'] ?>                         
                            <?php echo $project['Profile']['surname'] ?>                         
                        </b>
                    </p>
                    <p>
                        Klient:
                        <b>
                            <?php echo $project['ClientLead']['name']; ?>
                        </b>
                    </p>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 text-right projectTopTitleOptions">
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="easy-pie-chart">
            <?php
            if (abs($chart['timeProject']['overrange']) < 1)
            {
                ?>
                <div class="timeProject" data-percent="<?php echo $chart['timeProject']['percent']; ?>">
                    <span><?php echo $chart['timeProject']['percent']; ?> %</span>
                </div>
                <?php
            } else
            {
                ?>
                <span> <?php echo $chart['timeProject']['percent']; ?> %</span>
                <i class="fa-frown-o fa" style="font-size: 200px; line-height: 200px; color:red"></i>
            <?php } ?>
            <h3>
                <?php echo __d('public', 'Czas projektu') ?> 
            </h3>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="easy-pie-chart">
            <?php
            if (abs($chart['profitCost']['overrange']) < 1 || $chart['profitCost']['percent'] == 100)
            {
                ?>
                <div class="profitCost" data-percent="<?php echo $chart['profitCost']['percent']; ?>">
                    <span> <?php echo $chart['profitCost']['percent']; ?> %</span>

                </div>
                <?php
            } else
            {
                ?>
                <span> <?php echo $chart['profitCost']['percent']; ?> %</span>
                <i class="fa-frown-o fa" style="font-size: 200px; line-height: 200px; color:red"></i>
            <?php } ?>
            <h3>
                <?php echo __d('public', 'Zysk z kosztów') ?> 
            </h3>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="easy-pie-chart">
            <?php
            if (abs($chart['profitButget']['overrange']) < 1 || $chart['profitButget']['percent'] == 100)
            {
                ?>
                <div class="profitButget" data-percent="<?php echo $chart['profitButget']['percent']; ?>">
                    <span><?php echo $chart['profitButget']['percent']; ?> %</span>

                </div>
                <?php
            } else
            {
                ?>
                <span> <?php echo $chart['profitButget']['percent']; ?> %</span>
                <i class="fa-frown-o fa" style="font-size: 200px; line-height: 200px; color:red"></i>
            <?php } ?>
            <h3>
                <?php echo __d('public', 'Zysk z budżetu') ?>
            </h3>
        </div>
    </div>


    <div class="col-xs-12">
        <div class="bg-blue mb5 col-xs-12">
            <h2>Zespół</h2>
        </div>

        <div class="clearfix tiles">
            <?php
            $project['Profile']['name'] = $project['Profile']['firstname'] . ' ' . $project['Profile']['surname'];
            $project['Profile']['position'] = __d('public', 'Kierownik projektu');
            echo $this->element('ClientProjects/profile_feb_cart', array('profile' => $project, 'project_id' => null));
            ?>
            <?php if (!empty($sections)): ?>
                <?php foreach ($sections as $section): ?>
                    <?php
                    foreach ($section['Profile'] as $profile):
                        if (!$profile['active'])
                        {
                            continue;
                        }
                        ?>
                        <?php echo $this->element('ClientProjects/profile_feb_cart', array('profile' => $profile, 'project_id' => null)); ?>

                    <?php endforeach ?>
                <?php endforeach ?>
            </div>
        <?php endif; ?>


    </div>
</div>

<?php echo $this->Html->script('angular/controllers/BonusCtrl', array('inline' => false)); ?>
<?php $this->Html->script('angular/controllers/ProfileCartCtrl', array('inline' => false)); ?>
<?php echo $this->Html->script('/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js', array('inline' => false)); ?>
<?php echo $this->Html->css('style', null, array('inline' => false)); ?>
<?php echo $this->Metronic->portletEnd(); ?>
<script type="text/javascript">
    $('.easy-pie-chart .timeProject').easyPieChart({
        animate: 1000,
        size: 200,
        lineWidth: 16,
        barColor: '#4B8DF8',
    });

    $('.easy-pie-chart .profitCost').easyPieChart({
        animate: 1000,
        size: 200,
        lineWidth: 16,
        barColor: '#35AA47',
    });

    $('.easy-pie-chart .profitButget').easyPieChart({
        animate: 1000,
        size: 200,
        lineWidth: 16,
        barColor: '#E87E04',
    });

</script>