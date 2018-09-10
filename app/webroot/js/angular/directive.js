app.directive('datePicker', function () {
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function (scope, element, attrs, ngModelCtrl) {
            element.datepicker({
                orientation: "left",
                autoclose: true,
                format: 'yyyy-mm-dd',
                onSelect: function (date) {
                    scope.date = date;
                    scope.$apply();
                }
            });

        }
    };
});
app.directive('showSalary', function ($http) {
    return {
        restrict: 'A',
        transclude: true,
        templateUrl: '/js/angular/template/show-salary.html',
        scope: {
            id: '=id',
            netto: '=netto',
        },
        link: function (scope, element, attrs) {
            scope.showSalary = function () {
                var post = {};
                post.id = scope.id;
                post.netto = scope.netto;
                $http.post('/profiles/show_salary.json', post).
                        success(function (data, status, headers, config) {
                            scope.salary_visible = true;
                            if (typeof data.salary !== 'undefined') {
                                scope.salary = data.salary;
                            }
                        }).
                        error(function (data, status, headers, config) {

                        });
            };
            scope.hideSalary = function () {
                scope.salary_visible = false;
            };

        }
    };
});
app.directive('barProject', function ($http, DTInstances) {
    return {
        restrict: 'A',
        transclude: true,
        templateUrl: '/js/angular/template/bar-project.html',
        scope: {
            id: '=',
            data: '=',
        },
        link: function ($scope, element, attrs) {
            DTInstances.getLast().then(function (dtInstance) {
                $scope.dtInstance = dtInstance;
            });

            $scope.deleteRow = function (id) {
                $scope.message = 'You are trying to remove the row with ID: ' + id;
                // Delete some data and call server to make changes...
                // Then reload the data so that DT is refreshed
                $scope.dtInstance.reloadData();
            }

        }
    };
});
app.directive('statusProject', function ($http, DTInstances) {
    return {
        restrict: 'A',
        transclude: true,
        templateUrl: '/js/angular/template/status-project.html',
        scope: {
            id: '=',
        },
        link: function ($scope, element, attrs) {
            DTInstances.getLast().then(function (dtInstance) {
                $scope.dtInstance = dtInstance;
            });

            $scope.deleteRow = function (id) {
                $scope.message = 'You are trying to remove the row with ID: ' + id;
                // Delete some data and call server to make changes...
                // Then reload the data so that DT is refreshed
                $scope.dtInstance.reloadData();
            }

        }
    };
});
app.directive("sort", function () {
    return {
        restrict: 'A',
        transclude: true,
        templateUrl:'/js/angular/template/sort.html',
        scope: {
            order: '=',
            by: '=',
            reverse: '='
        },
        link: function (scope, element, attrs) {
            scope.onClick = function () {
                if (scope.order === scope.by) {
                    scope.reverse = !scope.reverse
                } else {
                    scope.by = scope.order;
                    scope.reverse = false;
                }
            }
        }
    }
});


app.directive('myModal', function() {
   return {
     restrict: 'A',
     link: function(scope, element, attr) {
       scope.dismiss = function() {
           element.modal('hide');
       };
     }
   } 
});
