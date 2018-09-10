app.controller('ClientProjectViewDocumentCtrl', function ($scope, $window, $modal, $http) {
    
    $scope.modal_toggle = false;
   
    $scope.modalToggle = function(){
      $scope.modal_toggle =! $scope.modal_toggle;
    };
   
    $scope.onDeleteFiles = function () {
        console.log($scope.files);
       
        $http.post("/client_projects/project_files_delete.json", { files: $scope.files})
            .success(function( data ) {
                console.log(data);
                //window.location.hash = '#project_documents';
               // window.location.reload(false);  //jak zapniesz tabele na angularze to mona to będzi ewyrzucić
            }); 

    };
  
    
    $scope.updateFile = function () {
        
    };
    
   $scope.input = {};
    $scope.addNewUPDATE = function(id) {
         $scope.input.tmp_id = id;
         console.log($scope.input.tmp_id);
    };
    
    
    $scope.copyLink = function (link) {
        //window.prompt('Link do pliku, który można skopiować i udostępnić', link);
        $scope.copylink = link;
        
    }

   
    
});

