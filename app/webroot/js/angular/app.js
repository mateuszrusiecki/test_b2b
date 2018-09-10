// at the end of each module file:
window.loadedDependencies.push('ui.calendar');
window.loadedDependencies.push('ngDraggable');
window.loadedDependencies.push('ngResource');
window.loadedDependencies.push('ui.bootstrap');
window.loadedDependencies.push('destegabry.timeline');
window.loadedDependencies.push('datatables');
window.loadedDependencies.push('angularFileUpload');
window.loadedDependencies.push('ui.checkbox');
window.loadedDependencies.push('ui.tree');
window.loadedDependencies.push('pascalprecht.translate');

// after all that, at the app definition:
var app = angular.module("b2bApp", window.loadedDependencies);


app.factory('$exceptionHandler', function () {
    return function errorCatcherHandler(exception, cause) {
        console.error(exception.stack);
        captureExceptionFeb(exception.stack, '$exceptionHandler', 0);
        //Raven.captureException(exception);
    };
});

app.factory('errorHttpInterceptor', ['$q', function ($q) {
        return {
            responseError: function responseError(rejection) {
                console.log(rejection);
                captureExceptionFeb(exception.stack, 'errorHttpInterceptor', 0);
//                Raven.captureException(new Error('HTTP response error'), {
//                    extra: {
//                        config: rejection.config,
//                        status: rejection.status
//                    }
//                });
                return $q.reject(rejection);
            }
        };
    }])
app.config(['$httpProvider', function ($httpProvider) {
        $httpProvider.interceptors.push('errorHttpInterceptor');
    }]);

app.config([
    '$compileProvider',
    function ($compileProvider)
    {
        $compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|skype):/);
        // Angular before v1.2 uses $compileProvider.urlSanitizationWhitelist(...)
    }
]);

app.config(function ($translateProvider) {
    $translateProvider.preferredLanguage('pol');
});

function empty(mixed_var) {
    //  discuss at: http://phpjs.org/functions/empty/
    // original by: Philippe Baumann
    //    input by: Onno Marsman
    //    input by: LH
    //    input by: Stoyan Kyosev (http://www.svest.org/)
    // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // improved by: Onno Marsman
    // improved by: Francesco
    // improved by: Marc Jansen
    // improved by: Rafal Kukawski
    //   example 1: empty(null);
    //   returns 1: true
    //   example 2: empty(undefined);
    //   returns 2: true
    //   example 3: empty([]);
    //   returns 3: true
    //   example 4: empty({});
    //   returns 4: true
    //   example 5: empty({'aFunc' : function () { alert('humpty'); } });
    //   returns 5: false

    var undef, key, i, len;
    var emptyValues = [undef, null, false, 0, '', '0'];

    for (i = 0, len = emptyValues.length; i < len; i++) {
        if (mixed_var === emptyValues[i]) {
            return true;
        }
    }

    if (typeof mixed_var === 'object') {
        for (key in mixed_var) {
            // TODO: should we check for own properties only?
            //if (mixed_var.hasOwnProperty(key)) {
            return false;
            //}
        }
        return true;
    }

    return false;
}
