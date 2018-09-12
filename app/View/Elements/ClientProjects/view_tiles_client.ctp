<div class="tiles projectView">

    <div class=" default double double-down tile">

        <div class="default tile  double double  bg-blue-madison">
            <div class="tile-body">
                
                <p> <b><?php echo $clientProject['Profile']['firstname'] . ' ' . $clientProject['Profile']['surname']; ?></b></p>
            </div>
            <div class="tile-object">
                <div class="name">
                    <b><?php echo __d('public', 'Kierownik projektu'); ?></b>
                </div>
                <div  class="number">

                </div>
            </div>
        </div> 

        <div class="default tile  double double bg-blue-madison">
            <div class="tile-body">
                <b><?php echo $clientProject['Client']['name']; ?></b><br>
                <span class="fa fa-phone"></span> <?php echo $clientProject['Client']['phone']; ?><br>
                <span class="fa fa-envelope-o"></span> <a class="color-white" href="mailto::<?php echo $clientProject['Client']['email']; ?>"><?php echo $clientProject['Client']['email']; ?></a><br>
            </div>
            <div class="tile-object">
                <div class="name">
                    <b><?php echo __d('public', 'Dane Klienta'); ?></b>
                </div>
                <div  class="number">

                </div>
            </div>
        </div>
    </div>
    <div class="default tile double double-down  bg-blue-madison">
        <div class="tile-body">
            <?php $budgetSum = 0; ?>
            <?php if ($sections) { ?>
                <?php foreach ($sections as $section) {
                    $budgetSum += $section['ClientProjectBudget']['position_value']
                    ?>
                    <b><?php echo $section['Section']['name']; ?></b>: 
                    <?php
                    echo $section['ClientProjectBudget']['activity_name'];
                    if (!empty($section['ClientProjectBudget']['pm'])) { ?> 
                        (<a class="color-white"  href="<?php echo Configure::read('App.PMUrl') ?>/issues/<?php echo $section['ClientProjectBudget']['pm'] ?>"><?php echo $section['ClientProjectBudget']['pm'] ?></a>)
                    <?php } ?>
                    <br>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="tile-object">
            <div class="name">
                <b><?php echo __d('public', 'Działania w projekcie'); ?></b>
            </div>
            <div  class="number">

            </div>
        </div>
    </div>
    <div class="default tile double  double-down">
        <div class="default tile double   bg-blue-madison">
            <div class="tile-body">
                <b><?php echo __d('public', 'Nazwa projektu') ?>: </b> 
                <?php echo $clientProject['ClientProject']['name']; ?><br>
                <b><?php echo __d('public', 'Alias projektu') ?>: </b> 
                <?php echo $clientProject['ClientProject']['alias']; ?><br>

            </div>
            <div class="tile-object">
                <div class="name">
                    <b><?php echo __d('public', 'Infrmacje') ?></b>
                </div>
                <div  class="number">
                </div>
            </div>
        </div>

    </div>

	<a class="tile bg-green-haze"  tooltip="Moduł jest w trakcie realizacji">
        <div class="tile-body">
            <i class="fa fa-list-alt"></i>
        </div>
        <div class="tile-object">
            <div class="name">
                <b><?php echo __d('public', 'CSMS') ?></b>
            </div>
            <div class="number">
            </div>
        </div>
    </a>
	   
	<a class="tile bg-yellow-gold" tooltip="Moduł jest w trakcie realizacji">
        <div class="tile-body">
            <i class="fa fa-file-text"></i>
        </div>
        <div class="tile-object">
            <div class="name">
                <b><?php echo __d('public', 'TC') ?></b>
            </div>
            <div class="number">
            </div>
        </div>
    </a>
<!--    <a class="tile bg-green-seagreen" tooltip="Moduł jest w trakcie realizacji">
        <div class="tile-body">
            <i class="fa fa-sitemap"></i>
        </div>
        <div class="tile-object">
            <div class="name">
                <b>Makietowanie</b>
            </div>
            <div class="number">
            </div>
        </div>
    </a>-->
	
   <a href="/new_clients/main#/projects/lead_id/<?php echo $clientProject['ClientProject']['client_lead_id']; ?>" class="tile bg-purple-plum">
        <div class="tile-body">
            <i class="fa fa-file-picture-o"></i>
        </div>
        <div class="tile-object">
            <div class="name">
                <b><?php echo __d('public', 'GC') ?></b>
            </div>
            <div class="number">
            </div>
        </div>
    </a>

	<?php if($brief): ?>
    <a href="/briefs/view/<?php echo $brief['Brief']['hid']; ?>/1" class="tile bg-purple-medium">
        <div class="tile-body">
            <i class="fa fa-lightbulb-o"></i>
        </div>
        <div class="tile-object">
            <div class="name">
                <b><?php echo __d('public', 'Briefing') ?></b>
            </div>
            <div class="number">
            </div>
        </div>
    </a>
	<?php endif ?>

   
  

</div>