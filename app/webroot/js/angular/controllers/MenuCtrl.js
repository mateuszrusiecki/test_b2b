app.controller('MenuCtrl', function ($scope, $http, $filter, $q, language) {
    $scope.group = {};
    var language_url = language == 'pol' ? '/' : '/' + language + '/';
    $scope.change_groups = function (group) {
        if (typeof group.id == 'undefined') {
            return false;
        }
        $http.get(language_url + 'menu/menus/get_menu/' + group.id + '.json').success(function (data) {
            $scope.data = $scope.rootMenus = data;
        });
    };
    $scope.get_groups = function () {
        $http.get(language_url + 'menu/menus/get_groups.json').success(function (data) {
            $scope.groups = $filter('obj2arr')(data);
        });
    }
    $scope.selectedItem = {};

    $scope.options = {
        dropped: function (event) {
            $http.post(language_url + 'menu/menus/move_menu/' + $scope.group.id + '.json', $scope.data).success(function (data) {
                console.log(data);
            });
            return true;
        },
    };

    $scope.editItem = function (scope) {
        var deferred = $q.defer();
        var nodeData = scope.$modelValue.Menu;

        $http.post(language_url + 'menu/menus/edit_menu/' + $scope.group.id + '.json', nodeData).success(function (data) {
            deferred.resolve(data.Menu);
        });
        return deferred.promise;
    };
    $scope.delete = function (scope) {
        var conf = confirm('Czy napewno chcesz usunąć pozycje w menu: ' + scope.$modelValue.Menu.name + '?');
        if (conf) {
            $http.post(language_url + 'menu/menus/delete_menu/' + $scope.group.id + '.json', scope.$modelValue).success(function (data) {
            });
            scope.remove();
        }
    };

    $scope.toggle = function (scope) {
        scope.toggle();
    };

    $scope.newItem = function () {
        $http.post(language_url + 'menu/menus/add_menu/' + $scope.group.id + '.json', {}).success(function (data) {
            $scope.data.push(data);
        });
    }
    $scope.resetMenu = function () {
        $http.post(language_url + 'menu/menus/reset_menu/' + $scope.group.id + '.json', {}).success(function (data) {
//            $scope.data.push(data);
        });
    }

    $scope.newSubItem = function (scope) {
        var nodeData = scope.$modelValue;
        $http.post(language_url + 'menu/menus/add_menu/' + $scope.group.id + '.json', nodeData).success(function (data) {
            if (typeof nodeData.children == 'undefined') {
                nodeData.children = [];
            }
            nodeData.children.push(data);
        });

    };
});