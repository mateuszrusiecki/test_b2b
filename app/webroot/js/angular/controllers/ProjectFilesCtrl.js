app.controller('ProjectFilesCtrl', function ($scope, $upload, $http, $window, $timeout) {
    $scope.input = {};
    $scope.fileSet = {};
    $scope.invoice = {};


    $scope.$watch('modalUploadFiles', function () {
        $scope.upload($scope.modalUploadFiles);
    });
    $scope.uploadedFiles = [];
    $scope.upload = function (files, callback) {

        if (files && files.length && $scope.input.project_file_category_id) {
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                ///console.log($scope.input);
                $upload.upload({
                    url: '/client_projects/add_project_file_ajax.json',
                    headers: {'Content-Type': file.type},
                    method: 'POST',
                    data: $scope.input,
                    //fields: {'username': $scope.username},
                    file: file
                }).progress(function (evt) {
                    var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                    console.log('progress: ' + progressPercentage + '% ' + evt.config.file.name);
                }).success(function (data, status, headers, config) {
                    $scope.reload();
                    console.log('data ok');
                    angular.forEach(files, function (fileSuccess) {
                        if (fileSuccess.name == config.file.name) {
                            fileSuccess.progress =
                                    (typeof data.return != 'undefined' && data.return.success) ? 'success' : 'error';
                        }
                    });
                }).error(function (data, status, headers, config) {
                    angular.forEach(files, function (fileSuccess) {
                        if (fileSuccess.name == config.file.name) {
                            fileSuccess.progress = 'error';
                        }
                    });
                });
            }
        }
    };
    $scope.reload = function () {
        
        if (typeof $scope.deleteFileType !== 'undefined' &&
                $scope.deleteFileType == 'lead') {
            //pliki leadu
            $scope.getLeadFiles();
            return true;
        }
        if (typeof $scope.deleteFileType !== 'undefined' &&
                $scope.deleteFileType == 'client') {
            //pliki leadu
            $scope.getClientProjectFiles();
            return true;
        }
        if (typeof $scope.files == 'object') {
            //pliki projektu
            $scope.getFiles();
            return true;
        }
        if (typeof $scope.projectFiles == 'object') {
            //pliki projektu
            $scope.getProjectFiles();
            return true;
        }
        return false;
    }

    $scope.getLeadFiles = function () {
       // console.log('Pobranie plików');
        $http.get('/project_files/get_lead_files/' + $scope.input.client_lead_id + '.json').success(function (data) {
            if (angular.isObject(data)) {
                $scope.files = data;
            }
        });
    }
    $scope.getFiles = function () {
//        console.log('Pobranie plików');
        $http.get('/project_files/get_files/' + $scope.project_id + '.json').success(function (data) {
            if (angular.isObject(data)) {
                $scope.files = data;
            }
        });
    }
    $scope.listFiles = function () {
        $http.get('/project_files/list_files/' + $scope.project_id + '.json').success(function (data) {
            if (angular.isObject(data)) {
                $scope.files = data;
            }
        });
    }
    $scope.save = function () {
        $http.post('/client_projects/add_project_file_ajax.json', $scope.input);
    };
    $scope.fileEdit = function (fileSet) {
        $scope.input = fileSet;
        if (angular.isString(fileSet.desc)) {
            $scope.input.desc_check = true;
        }
        $scope.addProjectFiles = true;
    };
    $scope.invoiceDescription = function (data) {
        //console.log(data);
        $scope.invoice = data;
    };
    $scope.desc_error = 0;
    $scope.updateDescription = function () {
        $http.post("/hrs/update_invoice_description.json", {invoice: $scope.invoice})
                .success(function (data) {
                    //console.log(data);
                    $('.modal1').modal('hide');
                    if (typeof data === 'undefined') { //błąd
                        $scope.desc_error = 1;
                    }
                });
    };
    $scope.loading = 0;
    $scope.linkInvoiceToProject = function (project_id) {
        $scope.loading = 1;
        $http.post("/hrs/link_invoice_to_project.json", {invoice: $scope.invoice, project_id: project_id})
                .success(function (data) {
                    console.log(data);
                    $('.modal2').modal('hide');
                    if (typeof data === 'undefined') {
                        //błąd
                    }
                });
    };
    $scope.print = function (file) {
        var w = $window.open(file);
        window.setTimeout(function (w) {
            console.log(w);
            this.print();
        }, 1000);
    }

    $scope.selectFile = '';
    $scope.onDownloadFiles = function ($event) {

        $i = false;
        console.log($scope.files);
        angular.forEach($scope.files, function (file) {
            if (typeof file.ProjectFile.selected !== 'undefined' && file.ProjectFile.selected == true) {
                $i = true; //jeśli został wybrany przynajmniej jeden plik to zostanie wywołana akcja pobierania
            }
        });
        if ($i == false) { //jeśli nie został zaznaczony żaden plik to zostanie wyświetlony komunikat
            $event.preventDefault();
            //console.log('wybierz conajmniej jeden plik');
            $scope.selectFile = 'Wybierz conajmniej jeden plik';
            $timeout(function () {
                $scope.selectFile = '';
            }, 2000);
        }

    };
    $scope.checkAll = function () {
        if (typeof $scope.checkAllButton == 'undefined') {
            $scope.checkAllButton = false;
        }
        angular.forEach($scope.files, function (file) {
            file.ProjectFile.selected = true;
            $scope.checkAllButton = true;
        });
    };
    $scope.uncheckAll = function () {
        if (typeof $scope.checkAllButton == 'undefined') {
            $scope.checkAllButton = false;
        }
        angular.forEach($scope.files, function (file) {
            file.ProjectFile.selected = false;
            $scope.checkAllButton = false;
        });
    };
    $scope.modal_toggle = false;
    $scope.modalToggle = function () {
        $scope.modal_toggle = !$scope.modal_toggle;
    };
    $scope.onDeleteFiles = function () {
        //console.log($scope.files);
        $http.post("/client_projects/project_files_delete.json", {files: $scope.files})
                .success(function (data) {
                    $scope.reload();
                });
    };
    $scope.onDeleteFile = function (id, type) {
        //console.log($scope.files);
        $http.post("/project_files/delete.json", {id: id, type: type})
                .success(function (data) {
                    $scope.reload();
                    $scope.deleteFile = false;
                });
    };
    $scope.updateFile = function () {

    };
    $scope.input = {};
    $scope.addNewUPDATE = function (id) {
        $scope.input.tmp_id = id;
        //console.log($scope.input.tmp_id);
    };
    $scope.copyLink = function (link) {
        //window.prompt('Link do pliku, który można skopiować i udostępnić', link);
        $scope.copylink = link;
    }

    function myCallBackFunc(success, mesg, thumbs, images) {
        $scope.input.files = images;
        $http.post('/client_projects/scan_project_file_ajax.json', $scope.input).success(function (data) {
            $scope.scanProjectFiles = false;
            $scope.scannLoader = false;
            $scope.getProjectFiles();
        });
    }
    $scope.skanuj = function () {
        $scope.scannLoader = true;
        com_asprise_scan_request(myCallBackFunc,
                com_asprise_scan_cmd_method_SIMPLE_SCAN, // simple scan without the applet UI
                com_asprise_scan_cmd_return_IMAGES_AND_THUMBNAILS,
                null);
    }
    $scope.getProjectFiles = function () {
        $http.get("/project_files/get_hr_files.json")
                .success(function (data) {
                    $scope.projectFiles = data;
                });
    }
    $scope.getClientProjectFiles = function () {
        $http.get("/project_files/get_client_files.json")
                .success(function (data) {
                    $scope.projectFiles = data;
                });
    }
    
     $scope.clientShare = function (id, client_available) {
        $http.post("/project_files/project_file_access_for_client/", {file_id: id, client_available: client_available}).
            success(function (data) {
                console.log(data);
            });
    }
});
