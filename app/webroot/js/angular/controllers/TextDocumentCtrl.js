/* 
 * Kontroler dokumentów tekstowych
 */

app.controller('TextDocumentCtrl', function($scope, $http, $location, $window) {   
    
    full_url = $location.absUrl();
    url_parts = $location.absUrl().split('/');
    last_url_element = url_parts.pop();
    previous_url_element = url_parts.pop();
    
    var userAgent = navigator.userAgent.toLowerCase(); 
    
    if (userAgent.indexOf('safari') != -1 && navigator.cookieEnabled != 1) {
        $scope.safariUser = 'Korzystasz z przeglądarki Safari. Bo umożliwić poprawne działanie modułu TC odblokuj w przeglądarce cookies.';
        $scope.cookiesEnabled = navigator.cookieEnabled;
    }
    
    /**
     * W url może być jeden lub dwa parametry, interpretacja ile ich jest i który jest którym
     */
    if(!isNaN(last_url_element) && isNaN(previous_url_element)){
        
        $scope.lead_id = null;
        $scope.text_document_id = last_url_element;
        text_document_id = last_url_element;
    } else if(!isNaN(last_url_element) && !isNaN(previous_url_element)){
        
        $scope.lead_id = last_url_element;
        $scope.text_document_id = previous_url_element;
        text_document_id = previous_url_element;
    }
    
    $scope.actionLink = $location.absUrl();
    
    /**
     * Funkcja tworząca w bazie danych nowy pad tekstowy
     * Ładuje go do iframe na stronie
     */
    $scope.createNewPad = function() {
        
        $scope.pad_id = $scope.generateRandomPadId();
        
        $http.post('/text_documents/createNewPad', {pad_id : $scope.pad_id}).success(function() {
 
            angular.element('#etherpad').attr('src', 'http://144.76.249.142:9001/p/' + $scope.pad_id + '?showControls=true&showChat=true&showLineNumbers=true&useMonospaceFont=false');
            $scope.full_share_link = 'http://144.76.249.142:9001/p/' + $scope.pad_id;
        });      
    };        
    
    /**
     * Funkcja wczytująca z bazy danych pad
     * Ładuje go do iframe na stronie
     */
    $scope.loadExistingPad = function() {
          
        $http.post('/text_documents/getTextDocument.json', {text_document_id : text_document_id}).success(function(data) {
            $scope.TextDocument = data.TextDocument;
            $scope.TextDocumentData = data;
            $scope.pad_id = $scope.TextDocument.share_link.split('/').pop();
            angular.element('#etherpad').attr('src', 'http://144.76.249.142:9001/p/' + $scope.pad_id + '?showControls=true&showChat=true&showLineNumbers=true&useMonospaceFont=false');
            $scope.full_share_link = 'http://144.76.249.142:9001/p/' + $scope.pad_id;
            
            if($scope.TextDocumentData.ClientLead.Client !== undefined){
                
                $scope.mailToClient = $scope.TextDocumentData.ClientLead.Client.email;
            } else {
                
                $scope.mailToClient = null;
            }
        });
    };
            
    /**
     * Generuje ID nowego pada dokumentu tekstowego
     */
    $scope.generateRandomPadId = function() {
        
        var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        var string_length = 10;
        var randomstring = '';
        for (var i = 0; i < string_length; i++) {
            
          var rnum = Math.floor(Math.random() * chars.length);
          randomstring += chars.substring(rnum, rnum + 1);
        }
        
        return randomstring;
    };
    
    /**
     * Sprawdzanie w jakiej jesteśmy akcji. Tworzenie nowego pada lub wczytanie istniejącego 
     */
    if(full_url.indexOf("create") != -1){
        
        $scope.createNewPad();
    } else if(full_url.indexOf("update") != -1){
       
        $scope.loadExistingPad();
    }
    
    $scope.addTextInput = function(){
        
        newElement = "<div class='dynamicNewFormRow'><span>Kopia do:</span><input type='text' name='email[]'><i class='fa fa-close' title='Usuń dodatkowy adres' data-placement='top' data-toggle='tooltip'></i></div>";              
        
        angular.element('.dynamicFormRow.inputsContainer').append(newElement);
        
        $('[data-toggle="tooltip"]').tooltip();            
    };
    
    
    /**
     * Eksport do PDF 
     */
    $scope.exportPdf = function() {
 
        $window.open("http://" + $location.host() + "/text_documents/get_pdf.pdf?padId=" + $scope.pad_id);
    };
    
    /**
     * Eksport do DOC 
     */
    $scope.exportDoc = function() {
 
        $window.open("http://" + $location.host() + "/text_documents/get_doc?padId=" + $scope.pad_id);
    };
    
    $(document).ready(function () {  
        
        $(document).on("click", ".dynamicNewFormRow i.fa-close", function() {
            
            $(this).parent().remove();
        });
    });
    
});