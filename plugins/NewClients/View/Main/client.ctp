<?php

$this->set('title_for_layout', 'Projekty');
$this->start('script');
    echo $this->Html->script('/new_clients/js/ccontrollers');
$this->end();
?>
<div class="view" ng-view>
</div>
<div id="#panel" class="gcPreview dynamic-panel" ng-include src="'partials/sidepanel.html'"></div>
