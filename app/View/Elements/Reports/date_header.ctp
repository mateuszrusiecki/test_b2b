<?php $named = $this->params->params['named']; ?>
<p>

    <?php echo !empty($named['from']) ||  !empty($named['to']) ? 'W zakresie' : ''; ?> 
    <?php echo empty($named['from']) ? '' : 'od ' . $named['from']; ?> 
    <?php echo empty($named['to']) ? '' : 'do ' . $named['to']; ?>
</p>