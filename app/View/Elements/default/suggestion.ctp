<li class="dropdown dropdown-extended dropdown-dark dropdown-notification ng-scope" ng-controller="SuggestionCtrl"  data-intro="<?php echo __d('public', 'Tu można zgłaszać uwagi, błędy, zadawać pytania lub wysłac pochwałę') ?>" data-step="20">
    <a class="dropdown-toggle" href="javascript:;" ng-click="suggestionPopUp = true;" tooltip="<?php echo __d('public', 'Zgłaszanie uwag') ?>" tooltip-placement="bottom">
        <i class="fa fa-exclamation-triangle"></i>
    </a>
    <div ng-cloak class="modal-backdrop fade in" ng-show="suggestionPopUp"></div>

    <div ng-cloak  class="angular-modal"  ng-show="suggestionPopUp">
        <div class="modal-dialog">
            <div class="modal-content">
                <?php echo $this->Form->create('Suggestion', array('type'=>'file','url' => array('controller' => 'suggestions', 'action' => 'add', 'plugin' => false))); ?>
                <?php echo $this->Form->hidden('href', array('value' => Router::url($this->here, true))) ?>
                <div class="modal-header">
                    <button type="button" class="close" ng-click="suggestionPopUp = false;" aria-hidden="true"></button>
                    <h4 class="modal-title"><?php echo __d('public', 'Napisz do nas') ?></h4>
                </div>
                <div class="modal-body">
                    <div ng-if="suggestion.message" class="note note-success">
                        {{suggestion.message}}
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-xs-6">
                            <div class="form-group">
                                <div class="input-icon right">
                                    <?php echo $this->Form->input('name', array('div' => false, 'label' => false, 'placeholder' => __d('public', 'Podaj temat'), 'class' => 'text form-control', 'autocomplete' => 'off', 'required' => 'required')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-6">
                            <div class="form-group">
                                <div class="input-icon right">
                                    <select name="data[Suggestion][type]" class="form-control clear" ng-model="suggestion.type" id="post_kind">
                                        <option value="suggestion"><?php echo __d('public', 'sugestia') ?></option>    
                                        <option value="error"><?php echo __d('public', 'błąd') ?></option>    
                                        <option value="question"><?php echo __d('public', 'pytanie') ?></option>    
                                        <option value="praise"><?php echo __d('public', 'pochwała') ?></option>    
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <label><?php echo __d('public', 'Napisz, co zmienić lub co źle działa') ?>...</label>
                            <textarea name="data[Suggestion][content]" id="post_content" ng-model="suggestion.content" rows="5" title="<?php echo __d('public', 'Wpisz szczegóły') ?>" placeholder="<?php echo __d('public', 'Wpisz szczegóły') ?>" class="textarea form-control"></textarea>
                        </div>
                        <div class="col-xs-12 mt5">
                            <?php echo $this->Form->input('file', array('div' => false, 'label' => __d('public', 'Załącz plik'), 'type' => 'file')) ?>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" ng-click="suggestionPopUp = false;"><?php echo __d('public', 'Zamknij') ?></button>
                    <button type="submit" class="btn blue-madison"><?php echo __d('public', 'Wyślij') ?></button>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</li>