<?php if ($baner['Baner']['html_code']) { ?>
    <?php echo $baner['Baner']['html_code'] ?>
<?php } elseif ($baner['Baner']['image']) { ?> 
    <?php echo $this->Html->link($this->Html->image('/files/baner/'.$baner['Baner']['image']), array('plugin' => 'baner', 'controller' => 'baners', 'action' => 'rd', $baner['Baner']['id']), array('escape' => false,'target' => '_blank','rel' => 'nofallow')); ?>
<?php } ?>    

