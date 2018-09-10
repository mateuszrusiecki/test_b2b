<!-- BEGIN HEADER SEARCH BOX -->
<!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
<?php
if (!empty($_SESSION['Auth']['User']['id']))
{
    ?>
    <div class="searchFront">
        <div class="fa fa-search searchHideButton">
        </div>
        <form id="system_searcher_form" class="search-form search-form-expanded search-form-no-resizable" 
              action="<?php echo Router::url(array('plugin' => 'searcher', 'controller' => 'searchers', 'action' => 'search')); ?>" 
              method="GET">
            <div class="input-group mode-select"> 
                <select name="search_mode">
                    <?php foreach ($searchModes as $key => $value): ?>
                        <option value="<?php echo $key; ?>" <?php echo (isset($_GET['search_mode']) && $_GET['search_mode'] == $key) ? ' selected="selected"' : ''; ?>>
                            <?php echo $value; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($actualProjectId)): ?>
                    <input type="hidden" value="<?php echo $actualProjectId; ?>" name="actual_project_id">
                <?php elseif (isset($_GET['actual_project_id']) && isset($_GET['search_mode']) && $_GET['search_mode'] == 'this_project'): ?>
                    <input type="hidden" value="<?php echo $_GET['actual_project_id']; ?>" name="actual_project_id">
                <?php endif; ?>
            </div>
            <div class="input-group query">                                
                <input type="text" value="<?php echo isset($_GET['query']) ? $_GET['query'] : ''; ?>" class="form-control input-sm" placeholder="Szukaj..." name="query">
                <span class="input-group-btn">
                    <a class="btn submit" href="javascript:{}" onclick="document.getElementById('system_searcher_form').submit();">
                        <i class="icon-magnifier"></i>
                    </a>
                </span>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        $('.searchHideButton').click(function () {
            if ($('.searchHideButton + form').hasClass('openThis')) {
                $('.searchHideButton + form').removeClass('openThis');
            } else {
                $('.searchHideButton + form').addClass('openThis');
            }
        })
        $('.searchFront').click(function (event) {
            event.stopPropagation();
        });
        $(document).click(function () {
            $('.searchHideButton + form').removeClass('openThis');
        });
    </script>
    <?php
}
?>
<!-- END HEADER SEARCH BOX -->