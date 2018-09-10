/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


app.controller('BiefAddCtrl', function ($scope, $http) {
    $scope.getBriefDefaultQuestion = function () {
        $http.get('/briefs/get_brief_default_question.json').success(function (data) {
            $scope.briefDefaultQuestions = data;
        });
    }
    $scope.getBriefDefaultQuestion();

    $scope.questions = [];
    $scope.customInput = {};
    $scope.onDragComplete = function (data, evt) {
        //console.log("drag success, data:", data);
    }
    
    $scope.remove_category = function(item) { 
        var index = $scope.questions.indexOf(item);
        $scope.questions.splice(index, 1);     
    }

    $scope.onDropComplete = function (data, category_name) {
        if (data.default) {
            $scope.onDropDefault(data.content);
            return true;
        }
        if (typeof category_name == 'undefined') {
            category_name = '';
        }
        $scope.onDropCategory(data.content, category_name)
    }
    $scope.onDropDefault = function (data) {
        var tmp = [];
        angular.copy($scope.briefDefaultQuestions, tmp);
        angular.forEach(tmp, function (v) {
            angular.forEach(v.questions, function (question) {
                if (data == question.group_name) {
                    $scope.questions.push(question);
                }
            });

        });
    }
    $scope.onDropCategory = function (data, category_name) {
        var tmp = {category_name: category_name, content: data};
        $scope.questions.push(tmp);
        $scope.customInput.content = '';

    }
    $scope.addCategory = function (category_name) {
        var tmp = {'category_name': category_name};
        $scope.questions.push(tmp);
    }




});