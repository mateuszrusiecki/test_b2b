<?php $field = empty($field) ? 'field' . rand() : $field; ?>
<div ng-cloak ng-show="edit<?php echo $field; ?>">
    <textarea ng-model="saveBookModel<?php echo $field; ?>" class="textarea-max">

    </textarea>
    <div class="action">
        <div ng-click="edit<?php echo $field; ?> = false; saveBookModel<?php echo $field; ?> = null;" 
             class="pointer back">
            <i class="fa fa-arrow-left"></i>
            Powrót
        </div>
        <div 
            ng-click="saveSocialBook({
                    id: socialBook.SocialBook.id,
            <?php echo $field; ?>: saveBookModel<?php echo $field; ?>,
                });
                edit<?php echo $field; ?> = false;
            " 
            class="pointer save">
            <i class="fa fa-save"></i>
            Zapisz
        </div>
    </div>
</div>
<i  ng-hide="edit<?php echo $field; ?>" 
    class="fa-pencil fa pointer edit" 
    ng-click="edit<?php echo $field; ?> = true;
                saveBookModel<?php echo $field; ?> = socialBook.SocialBook.<?php echo $field; ?>;"
    ></i>