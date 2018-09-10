/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
app.controller('TimePickerCtrl', function($scope, $window) {
             
		  $scope.hstep = 1;
		  $scope.mstep = 15;

		  $scope.options = {
		    hstep: [1, 2, 3],
		    mstep: [1, 5, 10, 15, 25, 30]
		  };

		  $scope.ismeridian = true;
		  $scope.toggleMode = function() {
		    $scope.ismeridian = ! $scope.ismeridian;
		  };
                  
		  $scope.update = function() {
		    var d = new Date();
		    d.setHours( 14 );
		    d.setMinutes( 0 );
		    $scope.mytime = d;
		  };
                  // zmiana  data od   ng-change
		  $scope.changedTimeStart = function () {

                    $scope.newtimestart = $scope.convertTime($scope.timestart);
                    
                    console.log('Godzina od:'+$scope.newtimestart);
		  };
                  // zmiana  data do   ng-change
                  $scope.changedTimeEnd = function () {
                    $scope.newtimeend = $scope.convertTime($scope.timeend);
                    
                    console.log('Godzina do:'+$scope.newtimeend);
		  };

		  $scope.clear = function() {
		    $scope.mytime = null;
		  };
                  
                   // conwertowanie daty do formatu TIME pod MySQL
                  $scope.convertTime = function(time){
                    var newTimeHour = time.getHours();
                    
                    if(newTimeHour <10){
                        newTimeHour = '0'+newTimeHour;
                    }
                    

                    var newTimeMinutes = time.getMinutes();
                    if(newTimeMinutes == 0){
                        newTimeMinutes = '00';
                    }
                    var newTime = newTimeHour+''+newTimeMinutes+'00';
                    return newTime;
                  }


                  $scope.setTimeStart = function(time){
                      if(time == null || typeof time =='undefined'){
                        var timestart = new Date();
                        timestart.setHours(8);
                        timestart.setMinutes(0);
                        $scope.timestart = timestart;
                      }else{
                        var hour = time.substring(0,2);
                        var minutes = time.substring(3,5);
                        
                        var timestart = new Date();
                        timestart.setHours(hour);
                        timestart.setMinutes(minutes);
                        $scope.timestart = timestart;
                      }
                        
                  }
                  
                  $scope.setTimeEnd = function(time){
                      if(time == null || typeof time =='undefined'){
                        var timeend = new Date();
                        timeend.setHours(10)
                        timeend.setMinutes(0);
                        $scope.timeend = timeend;
                      }else{
                        var hour = time.substring(0,2);
                        var minutes = time.substring(3,5);
                        
                        var timeend = new Date();
                        timeend.setHours(hour)
                        timeend.setMinutes(minutes);
                        $scope.timeend = timeend;
                      }
                      
                  }
});
