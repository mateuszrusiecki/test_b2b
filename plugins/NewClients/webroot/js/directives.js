febApp.directive('fixparentwidth', function(){
    return {
        link: function(scope, element, attrs) {
            element.bind("load", function(e){
               var parent = element[0].parentElement;
               parent.style.width = element[0].clientWidth + 'px';
               //console.log(parent);
            });
        }
    }
});