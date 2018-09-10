<?php
$setLang = Configure::read('Config.language');
$langName = array('pol' => 'Polski', 'eng' => 'Angielski');
?>
<li class="dropdown dropdown-language">
    <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
        <?php echo $this->Html->image('flags/' . $setLang . '.png'); ?>
        <span class="langname">
            <?php echo strtoupper($setLang); ?> </span>
        <i class="fa fa-angle-down"></i>
    </a>
    <ul class="dropdown-menu">
        <?php
        foreach (Configure::read('Config.languages') as $lang)
        {
            if ($lang == $setLang)
            {
                continue;
            }
            $langUrl = Router::url(array('admin' => false, 'prefix' => false, 'plugin' => 'translate', 'controller' => 'i18n_messages', 'action' => 'change', $lang, base64_encode($this->here)));
            ?>
            <li>
                <?php
                echo
                $this->Html->link(
                        $this->Html->image('flags/' . $lang . '.png') .
                        $langName[$lang], $langUrl, array('escape' => false)
                )
                ?>
            </li>
        <?php } ?>
    </ul>
</li>