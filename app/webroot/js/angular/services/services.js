app.service('GlobalService', ['$rootScope', function($rootScope){
    this.getData = function() {
        return {allPanelsVisible: $rootScope.allPanelsVisible}
    }
}]);

app.service('ProjectService', ['$http', '$q', function($http, $q) {
    this.list = function() {
        return $http.get('/graphic_projects/projectsreview.json');
    }
}]);


//app.service('testService', function(){
//    this.sayHello= function(text){
//        return "Service says \"Helllo " + text + "\"";
//    };        
//});