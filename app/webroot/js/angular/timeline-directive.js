app.directive('timelineMile', function ($http) {
    return {
        restrict: 'A',
        transclude: true,
        templateUrl: '/js/angular/template/timeline-mile.html',
        scope: {
            id: '=id',
            done: '=done',
            desc: '=desc',
            readonly: '=readonly',
        },
        link: function (scope, element, attrs) {
            scope.checked = function (att) {
                scope.done = !scope.done;
                
                var post = {
                    done: scope.done,
                    id: scope.id
                }
                
                $http.post('/client_project_shedules/done.json', post).
                    success(function (data, status, headers, config) {
                        if(data) console.log(data);
                    }).
                    error(function (data, status, headers, config) {
                         if(data) console.log(data);
                    });
                
                //generowanie częściowego protokołu odbioru
                $http.post('/acceptance_reports/add.json', scope.id).
                    success(function (data, status, headers, config) {
                        console.log(data);
                    }).
                    error(function (data, status, headers, config) {
                        console.log(data);
                    });
                    
            }

        }
    };
});
app.directive('timelineEvent', function ($http) {
    return {
        restrict: 'A',
        transclude: true,
        templateUrl: '/js/angular/template/timeline-event.html',
        scope: {
            id: '=id',
            done: '=done',
            desc: '=desc',
            readonly: '=readonly',
        },
        link: function (scope, element, attrs) {
            scope.checked = function (att) {
                scope.done = !scope.done;
                var post = {
                    done: scope.done,
                    id: scope.id
                }
               
                console.log(post);
                $http.post('/client_project_shedules/done.json', post).
                        success(function (data, status, headers, config) {
                        }).
                        error(function (data, status, headers, config) {

                        });
            }

        }
    };
});
app.directive('timelinePayment', function ($http) {
    return {
        restrict: 'A',
        transclude: true,
        templateUrl: '/js/angular/template/timeline-payment.html',
        scope: {
            id: '=id',
            done: '=done',
            payment_type: '=payment_type',
            desc: '=desc',
            invoice: '=invoice',
        },
        link: function (scope, element, attrs) {
            scope.checked = function (att) {
                scope.done = !scope.done;

                var post = {
                    done: scope.done,
                    id: scope.id
                }
               
                console.log(post);
                $http.post('/client_project_shedules/done_payment.json', post).
                    success(function (data, status, headers, config) {
                        //if(data) alert(data);
                        console.log('prawidłowe oznaczenie płatności')
                    }).
                    error(function (data, status, headers, config) {
                         console.log('błąd oznaczenia płatności');
                         //if(data) alert(data);
                    });
            }

        }
    };
});