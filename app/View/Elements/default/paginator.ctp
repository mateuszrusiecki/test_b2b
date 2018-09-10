<?php if ($this->Paginator->counter(array('format' => '%pages%')) > 1) { ?>
    <div class="center-me">
        <ul class="pagination">
            <?php
            echo $this->Paginator->prev('<i class="fa fa-chevron-left"></i>', array('escape'=>false,'tag' => 'li'), null, array('escape'=>false, 'tag' => 'li','class' => 'disabled-left disabled','disabledTag' => 'a'));
            echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
        echo $this->Paginator->next('<i class="fa fa-chevron-right"></i>', array('escape'=>false, 'tag' => 'li','currentClass' => 'disabled'), null, array('escape'=>false,'tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            ?>
        </ul>
    </div>
<?php } ?>