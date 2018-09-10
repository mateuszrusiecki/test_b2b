angular.module('appFilters', [])

.filter('rolename', function(){
    return function(input) {
        if(input=='client') return 'Klient';
        if(input=='manager') return 'Kordynator';
        return '';
    }
})

.filter('substring', function(){
    return function(str, start, end) {
        return str.substring(start, end);
    };
})

.filter('febDateFormat', function() {
   return function(str) {
       return str.substring(8, 10) + "." + str.substring(5,7) + "." + str.substring(0,4) + " | " + str.substring(11,16);
   }
})
.filter('roleFilter', function() {
    return function(items, role) {
        var filtered = [];
        if(typeof(items)=='undefined' || role==null) {
            return filtered;
        }
        for(var i = 0; i < items.length; i++) {
            var item = items[i];
            if(item.User.role == role) {
                filtered.push(item);
            }
        }
        return filtered;
    }
})
.filter('commentRegionFilter', function(){
    return function(items, regionId) {
        regionId = regionId || null;
        var filtered = [];
        if(typeof(items)=='undefined' || regionId==null) {
                return filtered;
        }
        for(var i=0; i<items.length; i++) {
            var item = items[i];
            if(item.Comment.region_id == regionId)
                filtered.push(item);
        }
        return filtered;
    }
})
.filter('nospace', function () {
    return function (value) {
        return (!value) ? '' : value.replace(/ /g, '');
    };
})
;

