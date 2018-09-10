<?php echo $this->Metronic->portlet('Wypełnianie ankiety'); ?>

<div class="portlet-body">
    <div class="row">
        <?php echo $this->Form->create('poll'); ?>

        <!-- Questions -->
        <?php foreach ($poll['PollQuestion'] as $key => $pollQuestion) : ?>
            <?php if ($pollQuestion['type'] == 1) : ?>
                <div class="col-md-3 col-sm-6 margin-bottom-10">
                    <label><?php echo $pollQuestion['question']; ?></label>
                    <div class="clearfix">
                        <div class="starOpinion">
                            <i class="fa fa-star font-grey font-large-style star1 pointer"></i>
                            <i class="fa fa-star font-grey font-large-style star2 pointer"></i>
                            <i class="fa fa-star font-grey font-large-style star3 pointer"></i>
                            <i class="fa fa-star font-grey font-large-style star4 pointer"></i>
                            <i class="fa fa-star font-grey font-large-style star5 pointer"></i>
                        </div>
                        <?php
                        echo $this->Form->hidden($key . '.PollAnswer.answer', array('value' => 0));
                        echo $this->Form->hidden($key . '.PollAnswer.id', array('value' => $pollQuestion['PollAnswer']['id']));
                        ?>
                    </div>
                </div>
            <?php else : ?>
                <div class="col-md-12 col-xs-12">
                    <div class="input checkbox">
                        <label><?php echo $pollQuestion['question']; ?></label>
                    </div>
                    <?php
                    echo $this->Form->hidden($key . '.PollAnswer.id', array('value' => $pollQuestion['PollAnswer']['id']));
                    echo $this->Form->textarea($key . '.PollAnswer.answer', array(
                        'ng-model' => 'input.desc',
                        'maxlength' => 1000,
                        'class' => 'col-md-12 mb5 form-control margin-bottom-10',
                    ));
                    ?>
                    <span id="charNum">0/1000</span>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php
    echo $this->Form->submit('Zapisz', array('class' => 'btn blue-madison pull-right'));
    echo $this->Form->end();
    ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>
<script>
    $('textarea').keyup(function () {
        var max = parseInt($(this).attr('maxlength'));
        var len = $(this).val().length;
        $('#charNum').text(len + '/' + max);
    });

    $('.starOpinion').hover(function () {
        $('.starOpinion i').hover(function () {
            $(this).addClass('font-yellow');
            $(this).prevAll().addClass('font-yellow');
        }, function () {
            if ($(this).hasClass('active')) {

            } else {
                $(this).removeClass('font-yellow');
            }
        });
    }, function () {
        if ($(this).hasClass('active')) {
        } else {

        }
        $('.starOpinion i:not(.active)').removeClass('font-yellow');
    });
    $('.starOpinion i').click(function () {
        var stars = $(this).prevAll().length + 1;
        
        $(this).closest('.starOpinion').find('i').removeClass('active font-yellow');
        $(this).addClass('active font-yellow');
        $(this).prevAll().addClass('active font-yellow');
        $(this).parent().next('input[type=hidden]').val(stars);
        
        console.log('%c Rate :: stars count => ' + stars, 'color: white; background: green; padding: 2px;');
    });
</script>