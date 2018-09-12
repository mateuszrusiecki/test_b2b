/* 
 * Kontroler dokumentów tekstowych
 */

app.controller('TextDocumentsCtrl', function($scope, $http, $location) {   
    
    last_url_element = $location.absUrl().split('/').pop();
    
    $scope.hostName = $location.host();
    
    if (isNaN(last_url_element)){
        $scope.lead_id = null;
    } else {
        $scope.lead_id = last_url_element;
        $http.post('new_clients/api/get_lead.json', {lead_id : $scope.lead_id}).success(function(data){
            $scope.clientLeadInfo = data;
        }).error(function(data, status, headers, config) {
            console.log("AJAX failed!");
            console.log(data);
        });
    }
    
    $scope.getLoggedUserData = function() {
        
        $http.post('/profiles/loggedUserData.json').success(function(data) {
            $scope.userdata = data;  
        });
    };
    
    $scope.getTextDocuments = function() {       
        
        $http.post('/text_documents/index.json', {lead_id : $scope.lead_id}).success(function(data) {
            $scope.textdocuments = data;   
        });
    };
    
    $scope.setClickedDocumentId = function(id, index) {
        
        $scope.clickedDocumentId = id;
        $scope.clickedDocumentIndex = index;
    };
    
    $scope.deleteDocument = function() {
        $http.post('/text_documents/delete', {id : $scope.clickedDocumentId});
        $scope.textdocuments.textdocuments.splice($scope.clickedDocumentIndex, 1);
    };
    
    /**
     * Generuje ID nowego pada dokumentu tekstowego
     */
    $scope.generateRandomPadId = function() {
        
        var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        var string_length = 10;
        var randomstring = '';
        for (var i = 0; i < string_length; i++) 
        {
          var rnum = Math.floor(Math.random() * chars.length);
          randomstring += chars.substring(rnum, rnum + 1);
        }
        
        return randomstring;
    }
    
    $scope.getTextDocuments();
    $scope.getLoggedUserData();
});