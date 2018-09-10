<?php echo $this->Metronic->portlet($poll['ClientProject']['name']); ?>

<?php if (!empty($poll['Poll']['filled'])) : ?>
	<div class="alert alert-info" role="alert">
		Ankieta została wypełniona <?php echo $poll['Poll']['fill_date']; ?>
	</div>
<?php endif; ?>

<?php foreach ($poll['PollQuestion'] as $key => $pollQuestion) : ?>
    <?php if ($pollQuestion['type'] == 1) : ?>
        <div class="col-md-3 col-sm-6 margin-bottom-10">
            <label><?php echo $pollQuestion['question']; ?></label>
            <div class="clearfix">
                <div class="starOpinion">
                    <?php
                    $rate = intval($pollQuestion['PollAnswer']['answer']);
                    $i = 1;
                    while ($i <= 5) :
                        ?>
                        <i class="fa fa-star font-large <?php echo ($i <= $rate ? 'font-yellow' : ''); ?>"></i>
                        <?php
                        $i++;
                    endwhile;
                    ?>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="col-md-12 col-xs-12 margin-top-20">
            <div>
                <label><?php echo $pollQuestion['question']; ?></label>
            </div>
            <span><?php echo $pollQuestion['PollAnswer']['answer']; ?></span>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
<?php echo $this->Metronic->portletEnd(); ?>