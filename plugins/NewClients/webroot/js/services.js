/*
febApp.factory('ProjectService', ['$http', '$q', function($http, $q) {
    var deferred = $q.defer();
    $http.get('api/projectsreview.json').then(function(response){
        console.log('read');
        deferred.resolve(response.data);
    });

    var projects = {
        list: function() {
            return deferred.promise;
        }
    };
    return projects;
}]);
*/


febApp.service('GlobalService', ['$rootScope', function($rootScope){
    this.getData = function() {
        return {allPanelsVisible: $rootScope.allPanelsVisible}
    }
}]);


febApp.service('ProjectService', ['$http', '$routeParams', '$q', function($http, $routeParams, $q) {
    this.list = function() {
        
        data = {};
        
        if($routeParams.mode == 'lead_id'){

            data = {
                params : {
                    lead_id : $routeParams.leadOrProjectId,
                }
            }
        } else if($routeParams.mode == 'client_project_id'){

            data = {
                params : {
                    client_project_id : $routeParams.leadOrProjectId,
                }
            }
        }  
        
        return $http.get('api/projectsreview.json', data);
    }
}]);


febApp.factory('ClientsProjectService', ['$http', '$routeParams', '$q', function($http, $routeParams, $q) {
    var deferred = $q.defer();
    
    data = {};
        
    if($routeParams.mode == 'lead_id'){
        
        data = {
            params : {
                lead_id : $routeParams.leadOrProjectId,
            }
        }
    } else if($routeParams.mode == 'client_project_id'){
        
        data = {
            params : {
                client_project_id : $routeParams.leadOrProjectId,
            }
        }
    }  
    
    $http.get('api/clientsprojectsreview.json', data).then(function(response){
        deferred.resolve(response.data);
    });

    var projects = {
        list: function() {
            return deferred.promise;
        }
    };
    return projects;
}]);


febApp.factory('ProjectDetailService', ['$http', '$q', function($http, $q){
    //var deferred = $q.defer();
    var project = {
        getData: function(id) {
            return $http.get('api/projectdetail/' + id + '.json')
        }
    }
    return project;
}]);


febApp.factory('UserService', ['$http', '$q', function($http, $q){
    var deferred = $q.defer();
    var deferredM = $q.defer();
    $http.get('api/users.json').then(function(response){
        deferred.resolve(response.data);
    });
    $http.get('api/managers.json').then(function(response){
        deferredM.resolve(response.data);
    })

    var users = {
        list: function() {
            return deferred.promise;
        },
        managers: function() {
            return deferredM.promise;
        }
    };
    return users;
}]);


febApp.service('currentUserService', function($http){
    this.getCurrentUser = function() {
        return $http.get('api/userdata.json');
    }
});

/*
febApp.factory('currentUserService', function($http, $q){
    var deferred = $q.defer();

    $http.get('api/userdata.json').then(function(response){
        deferred.resolve(response.data);
    })

    var data = {
        getCurrentUser: function() {
            return deferred.pormise;
        }
    };
    return data;
});
*/