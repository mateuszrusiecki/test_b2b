<?php echo $this->Metronic->portlet(__d('public','Mój zespół' ), 0, 'fa  fa-users', 'yellow', 1); ?>
<div class="tiles">
    <?php
    $myTeam = empty($myTeam) ? array() : $myTeam;
    foreach ($myTeam as $profile) {
        echo $this->element('ClientProjects/profile_feb_cart', array('profile' => $profile, 'project_id' => null));
    }
    ?>
</div>
<script type="text/javascript">
    $('.userTile > div > .tile-right').hover(function () {
        $(this).closest('.userTile').addClass('hover');
    }, function () {
        $(this).closest('.userTile').removeClass('hover');
    });
    $('.userTile > div > .tile-left a.btn').hover(function () {
        $(this).closest('.userTile').addClass('hoverLink');
    }, function () {
        $(this).closest('.userTile').removeClass('hoverLink');
    });
</script>
<?php echo $this->Metronic->portletEnd(); ?>