app.controller('AddProjectCtrl', function ($scope,$http) {
    
    $scope.projectWithoutAgreement = 0;
    $scope.isDrag = false;
    // Drop handler.
    $scope.onDrop = function (category, customObjectData, event) {
       
        $scope.isDrag = false;
        angular.forEach($scope.files[customObjectData.project_file_category_id], function (fv, key) {
            if (fv.id == customObjectData.id) {
                $scope.files[customObjectData.project_file_category_id].splice(key, 1);
            }
        });
        customObjectData.project_file_category_id = category;

        var flag = true;
        angular.forEach($scope.files[customObjectData.project_file_category_id], function (fv, key) {
            if (fv.id == customObjectData.id) {
                flag = false;
            }
        });
        if (
                typeof $scope.files[customObjectData.project_file_category_id] == 'undefined' ||
                null == $scope.files[customObjectData.project_file_category_id]
                ) {
            $scope.files[customObjectData.project_file_category_id] = [];
        }
        if (flag) {
            $scope.files[customObjectData.project_file_category_id].push(customObjectData); // {foo: 'bar'}
        }
        
        if(typeof $scope.files[6][0] == 'undefined'){
            $scope.projectWithoutAgreement = 0;
        } else {
            $scope.projectWithoutAgreement = 1;
        }

    };

    // Drag over handler.
    $scope.onDragOver = function (event) {
        $scope.isDrag = true;
        // ...
    };
    // Delete.
    $scope.onDelete = function (index) {
        $scope.payments.splice(index, 1);
        // ...
    };

    $scope.$watch('files[6]', function(){
        if(typeof $scope.files[6] !== 'undefined' && typeof $scope.files[6][0] !== 'undefined'){
            //console.log($scope.files[6][0]);
            $scope.projectWithoutAgreement = 1;
        }
    });


    $scope.promtAlias = function (projectname) {
        var string = projectname.replace(/ /gi, '_');
        $scope.alias = string;
    }

    $scope.addClientDomain = function (client_id, new_seo_domain) {
        $scope.seoMessageError = false;
        var re = new RegExp(/^((?:(?:(?:\w[\.\-\+]?)*)\w)+)((?:(?:(?:\w[\.\-\+]?){0,62})\w)+)\.(\w{2,6})$/);

        if (!new_seo_domain || 0 === new_seo_domain.length) {
            $scope.seoMessageError = 'Proszę podać nazwę domeny.';
        } else {
            if (new_seo_domain.match(re)) {
                $http.post("/client_projects/add_domain.json", {client_id: client_id, domain: new_seo_domain})
                .success(function (data) {
                    if (typeof data.id !== 'undefined') {
                        $scope.seolists[data.id] = data;
                        $scope.new_seo_domain = null;
                        console.log('ddd');
                    }
                    if (typeof data.error !== 'undefined') {
                        $scope.seoMessageError = data.error;
                    }
                });

            } else {
                $scope.seoMessageError = ('Proszę podać poprawną nazwę domeny.');
            }


        }
    }

});