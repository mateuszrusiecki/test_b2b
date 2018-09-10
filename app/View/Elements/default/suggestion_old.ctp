<li class="dropdown dropdown-extended dropdown-dark dropdown-notification ng-scope" ng-controller="SuggestionCtrl">
    <a class="dropdown-toggle" href="javascript:;" ng-click="suggestionPopUp = true;" tooltip="Zgłaszanie uwag" tooltip-placement="bottom">
        <i class="fa fa-exclamation-triangle"></i>
    </a>
    <div ng-cloak class="modal-backdrop fade in" ng-show="suggestionPopUp"></div>

    <div ng-cloak  class="angular-modal"  ng-show="suggestionPopUp">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" ng-click="suggestionPopUp = false;" aria-hidden="true"></button>
                    <h4 class="modal-title">Napisz do nas</h4>
                </div>
                <div class="modal-body">
                    <div ng-if="suggestion.message" class="note note-success">
                        {{suggestion.message}}
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-xs-6">
                            <div class="form-group"><div class="input-icon right">
                                    <input type="text" id="post_title" ng-model="suggestion.name" value="" title="Podaj temat" placeholder="Podaj temat" class="text form-control" autocomplete="off" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-6">
                            <div class="form-group">
                                <div class="input-icon right">
                                    <select class="form-control clear" ng-model="suggestion.type" id="post_kind">
                                        <option value="suggestion">sugestia</option>    
                                        <option value="error">błąd</option>    
                                        <option value="question">pytanie</option>    
                                        <option value="praise">pochwała</option>    
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <label>Napisz, co zmienić lub co źle działa..</label>
                            <textarea id="post_content" ng-model="suggestion.content" rows="5" title="Wpisz szczegóły" placeholder="Wpisz szczegóły" class="textarea form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" ng-click="suggestionPopUp = false;">Zamknij</button>
                    <button type="submit" class="btn blue-madison" ng-click="suggestion.message = save();">Wyślij</button>
                </div>
            </div>
        </div>
    </div>
</li>