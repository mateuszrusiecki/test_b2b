<div id="partners">
    <div class="halfWhiteBorder"></div>
    <div class="content">
        <div id="partnerSlider">
            <div id="partnerOverflow">
                <ul id="partner" class="clearfix unstyled">
                    <?php
                    foreach ($partners as $partner) {
                        $partnerLink = $partner['Partner']['link'];
                        ?>
                        <li class="partner">
                            <div class="partnerImg">
                                <?php if(!empty($partnerLink)): ?>
                                <?php echo $this->Html->link($this->Html->image('/files/partner/' . $partner['Partner']['img']), $partnerLink, array('target'=>'_blank', 'escape'=>false)); ?>
                                <?php else: ?>
                                <?php echo $this->Html->image('/files/partner/' . $partner['Partner']['img']); ?>
                                <?php endif; ?>
                            </div>
                       
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div> 
    </div>
</div>

<?php echo $this->Html->css('Partner.partners');
echo $this->Html->script('Partner.easySlider1.7.1.js'); ?>
<script type="text/javascript">
    jQuery('#partnerSlider').easySlider({
        size:4,
        continuous: true,
        auto: true,
        controlsShow: false,
        speed: 			800,
        pause:			2000,
        hoverpause: true
    });
</script>