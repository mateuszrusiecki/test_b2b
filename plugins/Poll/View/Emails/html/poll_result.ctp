<!--<p>Lorem ipsum</p>-->

<?php foreach ($poll['PollQuestion'] as $key => $pollQuestion) : ?>
    <?php if ($pollQuestion['type'] == 1) : ?>
        <div>
            <label><?php echo $pollQuestion['question']; ?></label>
            <div>
                <div class="starOpinion">
                    <?php
                    $rate = intval($pollQuestion['PollAnswer']['answer']);
                    $i = 1;
                    while ($i <= 5) : ?>
                        <i class="star <?php echo ($i <= $rate ? 'yellow' : ''); ?>"></i>
                        <?php
                        $i++;
                    endwhile;
                    ?>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div>
            <div>
                <label><?php echo $pollQuestion['question']; ?></label>
            </div>
            <span><?php echo $pollQuestion['PollAnswer']['answer']; ?></span>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<!-- CSS -->
<style type="text/css">
    i.star {
        display: inline-block;
        margin: 4px;
        width: 14px;
        height: 14px;
        background-image: url('<?php echo $this->Html->url('/poll/img/star_333333_14.png', true); ?>');
    }
    i.star.yellow {
        background-image: url('<?php echo $this->Html->url('/poll/img/star_ffb848_14.png', true); ?>');
    }
</style>
