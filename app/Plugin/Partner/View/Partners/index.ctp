<div id="page">
    <?php
    foreach ($partners as $partner) {
        $linkView = array('action' => 'view',$partner['Partner']['slug']);
        ?>
        <div class="partnerBox">
            <?php echo empty($partner['Partner']['img'])?'':$this->Image->thumb('/files/partner/' . $partner['Partner']['img'], array('height' => 120, 'width'=> 120), array('url' => $linkView, 'valign'=>'middle'), null); ?>
            <?php // echo empty($partner['Partner']['img'])?'':$this->Html->image('/files/partner/' . $partner['Partner']['img'], array('url' => $linkView)); ?>
            <div class="titlePartnerBox">
                <?php echo $this->Html->link($partner['Partner']['name'], $linkView); ?>
            </div>
        </div> 
    <?php } ?>
</div>