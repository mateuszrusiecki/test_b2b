app.controller('MainCtrl', function ($scope, $window, $sce, $http, $rootScope,language,$translate) {
   $translate.use(language);
    $scope.$watch('bodyHidden', function (newValue, oldValue) {
        $rootScope.bodyHidden = newValue || false;
    });
    $rootScope.addFilleModal = false;
    $scope.date = new Date();
    $scope.choices = [{id: 'choice1'}];

    $scope.addNewChoice = function () {
        var newItemNo = $scope.choices.length + 1;
        $scope.choices.push({'id': 'choice' + newItemNo});
    };


    $scope.showAddChoice = function (choice) {
        return choice.id === $scope.choices[$scope.choices.length - 1].id;
    };
    $scope.removeChoice = function () {
        var newItemNo = $scope.choices.length - 1;
        $scope.choices.pop();
    };
    $scope.removeChoiceId = function (value) {
        //alert(value);
        var replacement = angular.element(document.getElementsByClassName("replacement_" + value));
        replacement.remove();
    };


   

    $scope.collapsed = false;
    //console.log($window.innerWidth);
    if ($window.innerWidth <= 640) {
        $scope.collapsed = true;
    }

    $scope.class = "";

    $scope.changeClass = function () {
        if ($scope.class === "")
            $scope.class = "yellow";
        else
            $scope.class = "";
    };

    $scope.accessForClient = function (id, access) {
        $http.post("/client_projects/project_note_access_for_client/", {note_id: id, access: access}).
                success(function (data) {
console.log(data);
                });
    }


    $scope.doTheBack = function () {
        window.history.back();
    };

    $scope.modal_toggle = 0;
    $scope.vacationSubmit = function (ev) {
        if (angular.element('.row_row').length > 0) {
            //formularz ok, można wysłać
        } else {
            $scope.modal_toggle = 1;
            //$scope.dismiss();
            ev.preventDefault();
            return false;
        }
    }

    $scope.removeReplacementId = function (value) {
        //alert(value);
        //var replacement = angular.element(document.getElementsByClassName("row_row row_"+value));
        //replacement.remove();

    };



});











