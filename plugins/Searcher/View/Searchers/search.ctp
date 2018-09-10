<?php if (isset($searchMode) && $searchMode == 'this_project' && isset($this->request->query['actual_project_id'])): ?>
    <?php echo $this->Metronic->portlet('Szukaj "' . $query . '" w "' . $searchModeName . '", znaleziono: ' . $resultCount); ?>
<?php elseif (isset($query) && isset($searchModeName) && isset($resultCount)): ?>
    <?php echo $this->Metronic->portlet('Szukaj "' . $query . '" w "' . $searchModeName . '", znaleziono: ' . $resultCount); ?>
<?php else: ?>
    <?php echo $this->Metronic->portlet('Szukaj'); ?>
<?php endif; ?>
    <div class="searchers index">
        <?php if ($isResult): ?>
            <?php if(isset($socialBooks)): ?>
                <?php echo $this->element('SocialBooks/searcher_info'); ?> 
            <?php endif; ?>
            <?php if(isset($clients)): ?>
                <?php echo $this->element('Clients/client_info'); ?> 
            <?php endif; ?>
            <?php if(isset($myProjects)): ?>
                <?php echo $this->element('ClientProjects/my_projects_info'); ?> 
            <?php endif; ?>
            <?php if(isset($actualProject)): ?>
                <?php echo $this->element('ClientProjects/actual_project_info'); ?> 
            <?php endif; ?>
        <?php else: ?>
            <span>
                <?php echo __d('cms', "Brak wyników wyszukiwania"); ?>
            </span>
        <?php endif; ?>
    </div>
<?php echo $this->Metronic->portletEnd(); ?>