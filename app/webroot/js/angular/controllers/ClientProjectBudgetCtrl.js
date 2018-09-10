app.controller('ClientProjectBudgetCtrl', function ($scope, $window) {
    $scope.teams = {};
    $scope.hr_settings = {};
    $scope.hr_settings.HrSetting = {
        margin: 15,
        buffer: 15,
        it_rate: 40
    };
    function readSetting() {
        return $scope.hr_settings.HrSetting;
    }
    $scope.addBudget = function () {
        $scope.addBudgetMessage = false;
        if (typeof $scope.teams[$scope.section] == 'undefined'
                || (typeof $scope.teams[$scope.section].delete !== 'undefined' && $scope.teams[$scope.section].delete == true)
                ) {
            $scope.teams[$scope.section] = {};
        } else {
            $scope.addBudgetMessage = true;
            return false;
        }
        var section =
                {
                    'activity_name': $scope.sections[$scope.section],
                    //'id': $scope.section,
                    'section_id': $scope.section,
                    'margin_percentage': readSetting().margin,
                    'buffer_percentage': readSetting().buffer

                };
        $scope.teams[$scope.section].section = section;


        if (typeof $scope.uneditableSectionsList[$scope.section] != 'undefined') {
            //if ($scope.section == 3 || $scope.section == 4 || $scope.section == 5 || $scope.section == 6) {
            //Dla działów IT zdefiniowane są podstawowe grupy kosztów wraz ze stawką za roboczogodzinę. Wartości te są nieedytowalne
            if (typeof $scope.teams[$scope.section].payments == 'undefined') {
                $scope.teams[$scope.section].payments = [];
            }
            var payment = {};
            console.log($scope.hr_settings.HrSettings);
            payment = {
                'name': 'Programowanie',
                'time': 0,
                'price': readSetting().it_rate,
                'disabled': true,
            };
            $scope.teams[$scope.section].payments.push(payment);
            payment = {
                'name': 'Grafika',
                'time': 0,
                'price': readSetting().it_rate,
                'disabled': true,
            };
            $scope.teams[$scope.section].payments.push(payment);
            payment = {
                'name': 'Inne',
                'time': 0,
                'price': readSetting().it_rate,
                'disabled': true,
            };
            $scope.teams[$scope.section].payments.push(payment);
        }
    }

    $scope.onDeleteTeam = function (index) {
        //$scope.teams.splice(index, 1);
        //delete $scope.teams[index];
        $scope.teams[index].delete = true;
        delete $scope.teams[index].payments;
        // ...
    };
    $scope.onDeletePayment = function (id, index) {
        $scope.teams[id].payments[index].time = 0;
        $scope.teams[id].payments[index].price = 0;
        $scope.teams[id].payments[index].delete = true;
        //$scope.teams[id].payments.splice(index, 1);
        // ...
    };
    $scope.addPayment = function (index) {
        if (typeof $scope.teams[index] === 'undefined') {
            $scope.teams[index] = {};
        }
        if (typeof $scope.teams[index].payments === 'undefined') {
            $scope.teams[index].payments = [];
        }
        var payment = {
            'name': '',
            'time': 0,
            'price': 0,
        }
        console.log($scope.teams[index]);
        $scope.teams[index].payments.unshift(payment);
        // ...
    };

});













