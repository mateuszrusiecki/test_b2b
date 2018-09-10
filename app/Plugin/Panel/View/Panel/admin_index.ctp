<?php $this->set('title_for_layout', __d('cms', 'DASHBOARD')); ?>
<div>
<h2><?php echo  __("DASHBOARD"); ?></h2>
<p><?php echo  __("Witaj w panelu administracyjnym."); ?></p>
<p><?php echo  __("Poniżej zostały zaprezentowane statystyki z ostatniego miesiąca."); ?></p>
<p><?php echo  __("Z menu na górze strony wybierz odpowiednią opcję."); ?></p>
</div>

<?php //$this->Javascript->link('swfobject', false); ?>

<?php $xychart = $this->element('analytics_xychart', array(), array('cache' => '+1 hour')); ?>

<?php if(!empty($xychart)): ?>
    <?php echo $xychart; ?>
<?php //* ?>
<div class="clearfix">
    <div style="float: left; width: 400px;">
        <?php echo $this->element('analytics_sources',array(),  array('cache' => '+1 hour')); ?>
    </div>
    <div style="float: left; width: 400px;">
        <?php echo $this->element('analytics_circlechart',array(),  array('cache' => '+1 hour')); ?>
    </div>
</div>
<?php /**/ ?>
<?php echo $this->element('analytics_page_path',array(),  array('cache' => '+1 hour')); ?>

<?php else: ?>
    <?php echo 'Statystyki nie zostały skonfigurowane'; ?>
<?php endif; ?>

