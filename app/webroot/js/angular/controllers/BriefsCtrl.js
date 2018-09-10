app.controller('BriefsCtrl', function ($scope,$http,$timeout) {
   
    $scope.category_names = {};
    $scope.brief_complete = false;
 
 //??
    $scope.$watch( 'group_model', function() {
         //console.log($scope.section_model);
         if(typeof $scope.group_model != 'undefined'){
            //window.location =  '/bonus_panels/index/'+$scope.section_model ;
            $scope.category_names = {'1':'lol','2':'lol2'};
        }
    });
  //??  
    
    $scope.copyLink = function (link) {
        $scope.copylink = link;
    }
    
    $scope.submitAnswer = function(brief_question_id,keyEvent) {
        if (keyEvent.which === 13) { //zapisuje odpowiedź po wciśnięciu enter
            if(angular.element('#brief_answer_input_'+brief_question_id).val() && $scope.brief_complete == false){
                data = {
                    brief_question_id : brief_question_id, 
                    answer : angular.element('#brief_answer_input_'+brief_question_id).val() 
                };

                $http.post('/briefs/save_answer_ajax', data);

                angular.element('.brief_answer_input').val('');
            } else{
                console.log('podałeś pustą wartość');
            }
        }
        
    };
    
    //akcja ta sama co wyżej tylko wywoływana po kliknięciu strzałki a nie na enterze
    $scope.submitAnswerClick = function(brief_question_id) {
            if(angular.element('#brief_answer_input_'+brief_question_id).val()){
                if($scope.brief_complete == false){ //przyjmuje odpowiedzi tylko jeśl brief jest otwarty
                    data = {
                        brief_question_id : brief_question_id, 
                        answer : angular.element('#brief_answer_input_'+brief_question_id).val() 
                    };

                    $http.post('/briefs/save_answer_ajax', data);

                    angular.element('.brief_answer_input').val('');
                }else{
                    angular.element('#brief_answer_input_'+brief_question_id).val('Brief został zamknięty. Proszę skontaktować się z autorem briefa.');
                }
            } else{
                console.log('podałeś pustą wartość');
            }
        
    };
    
        
    $scope.getBrief = function(brief_id){
//        $http.get('/briefs/view/'+brief_id + '.json').success(function(data){
//            $scope.brief_questions = data;
//        }); 
        $http.post('/briefs/view.json',{'brief_id':brief_id}).success(function(data){
            $scope.brief_questions = data;
        }); 
         
        $scope.getAnswers(brief_id);
    };
    
    $scope.getAnswers = function(brief_id){ //pobieranie odpowiedzi(odświeżanie czata
        $http.post('/briefs/get_answers_ajax.json',{'brief_id':brief_id}).success(function(data, status, headers, config) {
            angular.element('.reset_answer').text('');
            $scope.brief_complete = data.data.completed;
            
            angular.forEach(data.data,function(v,k){
                if(typeof v.Profile == 'undefined' || (typeof v.Profile !== 'undefined' && v.Profile.firstname == null) ){
                    angular.element('#answer_'+v.brief_question_id).append('<strong>[Klient]</strong>: ' +v.answer+'<br/>');
                } else {
                    angular.element('#answer_'+v.brief_question_id).append('<strong>['+v.Profile.firstname + ' ' + v.Profile.surname + ']</strong>: ' +v.answer+'<br/>');
                }
                angular.element('#answer_'+v.brief_question_id).addClass('form-control');
            });

            $scope.brief_id = brief_id;
            if( $scope.brief_complete == false){
                $timeout(function(){
                    $scope.getAnswers($scope.brief_id);
                    console.log('ok 2'+$scope.brief_id);
                },1000);
            }
        });
    }; 
    
    $scope.notifySalesmanButton = true;
    $scope.notifySended = false;
    $scope.notifySalesman = function(brief_id){
        $http.post('/briefs/notify_salesman.json',{'brief_id':brief_id}).success(function(data, status, headers, config) {    
            $scope.notifySalesmanButton = false;
            $scope.notifySended = true;
            $timeout(function () {
                $scope.notifySended = false;
            }, 2000);
        });

    };


});












