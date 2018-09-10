//controler porzucony na rzecz ProjectFilesCtrl.js
app.controller('ScannerCtrl', function ($scope, $http, $filter, $q) {
    function myCallBackFunc(success, mesg, thumbs, images) {
        console.log(images);
        $('.page-logo').html('<img src="data:'+images['0'].mimetype+';'+images['0'].datatype+','+images['0'].data+'" />');
    }
    $scope.skanuj = function () {
        com_asprise_scan_request(myCallBackFunc,
                com_asprise_scan_cmd_method_SIMPLE_SCAN, // simple scan without the applet UI
                com_asprise_scan_cmd_return_IMAGES_AND_THUMBNAILS,
                null);
    }

});