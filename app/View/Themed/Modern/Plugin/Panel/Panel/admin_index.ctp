<?php $this->set('title_for_layout', __d('cms', 'DASHBOARD')); ?>

<script>
    $(document).ready(function() {
        $("button").click(function() {
            $.notification ( 
            {
                title:      'A Notification',
                content:    'Pretty cool, huh?',
                showTime:   true,
                click:      function() {
                    alert('Created on callback!')
                },
                icon:       '&amp;',
                color:      '#333'
            }
        )
        });
    });
</script>

<div class="section current" title="Our First Section" id="first_section">
    <h2><?php echo __("DASHBOARD"); ?></h2>
    <p><?php echo __("Witaj w panelu administracyjnym."); ?></p>
    <p><?php echo __("Poniżej zostały zaprezentowane statystyki z ostatniego miesiąca."); ?></p>
    <p><?php echo __("Z menu na górze strony wybierz odpowiednią opcję."); ?></p>

    <div class="section current" title="Notification" id="notification">
        <button>Click here to create a notification</button>
    </div>

    <?php $xychart = $this->element('analytics_xychart', array(), array('cache' => '+1 hour')); ?>

    <?php if (!empty($xychart)): ?>
        <?php echo $xychart; ?>
        <?php //* ?>
        <div class="clearfix">
            <div style="float: left; width: 400px;">
                <?php echo $this->element('analytics_sources', array(), array('cache' => '+1 hour')); ?>
            </div>
            <div style="float: left; width: 400px;">
                <?php echo $this->element('analytics_circlechart', array(), array('cache' => '+1 hour')); ?>
            </div>
        </div>
        <?php /**/ ?>
        <?php echo $this->element('analytics_page_path', array(), array('cache' => '+1 hour')); ?>

    <?php else: ?>
        <?php echo 'Statystyki nie zostały skonfigurowane'; ?>
    <?php endif; ?>

</div>