//http://almende.github.io/chap-links-library/timeline.html
google.load("visualization", "1");
app.controller('TimeLineCtrl', function ($scope, $compile) {

    $scope.model = new google.visualization.DataTable();
    $scope.model.addColumn('datetime', 'start');
    $scope.model.addColumn('datetime', 'end');
    $scope.model.addColumn('string', 'content');
    $scope.model.addColumn('string', 'className');

    $scope.addRows = function (timeline) {
        angular.forEach(timeline, function (v) {
            if (null !== v.start) {
                var start = new Date(1 * v.start.Y, 1 * v.start.m - 1, 1 * v.start.d);
            }
            if (null !== v.end) {
                var end = new Date(1 * v.end.Y, 1 * v.end.m - 1, 1 * v.end.d);
            }
            if(typeof(v.desc) == 'undefined' || v.desc == null){
                v.desc = '';
            }
            switch (v.type) {
                case 'milestone':
                    v.content = '<div class="pointer" title="' + v.content + '\n' + v.desc + '" timeline-mile id="' + v.id + '" done="' + v.done + '" readonly="' + v.readonly + '">' + v.content + '</div>';
                    break;
                default:
                    v.content = '<div class="pointer" title="' + v.content + '\n' + v.desc + '" timeline-event id="' + v.id + '" done="' + v.done + '" readonly="' + v.readonly + '">' + v.content + '</div>';
                    break;
            }
            $scope.model.addRows([[start, end, v.content, v.type]]);
        });
    }
    $scope.addRowsPayment = function (timeline) {
        angular.forEach(timeline, function (v) {
            if (null !== v.start) {
                var start = new Date(1 * v.start.Y, 1 * v.start.m - 1, 1 * v.start.d);
            }
            if (null !== v.end) {
                var end = new Date(1 * v.end.Y, 1 * v.end.m - 1, 1 * v.end.d);
            }

            v.content = '<div timeline-payment invoice="' + v.payment_type + '" id="' + v.id + '" done="' + v.done + '">' + v.content + '</div>';

            $scope.model.addRows([[start, end, v.content, 'payment-' + v.type]]);
        });
    }


    $scope.options = {
        locale: "pl",
        width: "100%",
        height: "300px",
        style: "box", // optional
        layout: "box",
        axisOnTop: false,
        eventMargin: 5, // minimal margin between events
        eventMarginAxis: 5, // minimal margin beteen events and the axis
        editable: false,
        showNavigation: true
    };
    $scope.selectTimeLine = function (tee) {
        console.log($scope.model)
    }
});
