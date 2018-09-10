<?php

$this->set('title_for_layout', 'FEB Clients Projects');
$this->start('script');
    echo $this->Html->script('/new_clients/js/mcontrollers');
$this->end();
?>
<div class="view" ng-view>
</div>
<div id="#panel" class="gcPreview dynamic-panel" ng-include src="'partials/sidepanel.html'"></div>
