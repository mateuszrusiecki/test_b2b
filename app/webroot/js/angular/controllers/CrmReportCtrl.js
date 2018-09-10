app.controller('CrmReportCtrl', function ($scope, $http, $filter) {

    $scope.date_from = $scope.date_to = new Date('Y-m-d');

    $scope.worker_report = function () {
        /*
        if (!empty($scope.range.start)) {
            $scope.input.date_from = $scope.range.start;
        }
        if (!empty($scope.range.end)) {
            $scope.input.date_to = $scope.range.end;
        }
        */
        $http.post('/client_leads/worker_report.json', $scope.input).success(function (data) {
            $scope.report = data;
            if (!empty(data['pie_category']['data'])) {
                pie_chart("#pie_category", data['pie_category']['data']);
            }
            if (!empty(data['pie_category_open']['data'])) {
                pie_chart("#pie_category_open", data['pie_category_open']['data']);
            }
            if (!empty(data['pie_category_close']['data'])) {
                pie_chart("#pie_category_close", data['pie_category_close']['data']);
            }
            if (!empty(data['pie_customer_sales']['data'])) {
                pie_chart("#pie_customer_sales", data['pie_customer_sales']['data']);
            }

            if (!empty(data['value_contracts']['data'])) {
                graph_chart("#graph_chart", data['value_contracts']['data']);
            }
        });
    }
    function pie_chart(el, data) {
        $.plot($(el), data, {
            series: {
                pie: {
                    innerRadius: 0.5,
                    show: true
                }
            }
        });
    }
    function graph_chart(el, data2) {
        var data = [];
        var dane = [];
        angular.forEach(data2, function (v, k) {
            dane = [v.created, v.amount, v.name + ' ' + v.amount + ' zł'];
            data.push(dane);
        });

        $.plot($(el),
                [{
                        data: data,
                        lines: {
                            fill: 0.6,
                            lineWidth: 0
                        },
                        color: ['#f89f9f']
                    }],
                {
                    xaxis: {
                        tickLength: 0,
                        tickDecimals: 0,
                        mode: "categories",
                        min: 0,
                        font: {
                            lineHeight: 14,
                            style: "normal",
                            variant: "small-caps",
                            color: "#6F7B8A"
                        }
                    },
                    yaxis: {
                        ticks: 5,
                        tickDecimals: 0,
                        tickColor: "#eee",
                        font: {
                            lineHeight: 14,
                            style: "normal",
                            variant: "small-caps",
                            color: "#6F7B8A"
                        }
                    },
                    grid: {
                        hoverable: true,
                        clickable: true,
                        tickColor: "#eee",
                        borderColor: "#eee",
                        borderWidth: 1
                    }
                });

        function showTooltip(x, y, contents) {
            $('<div id="tooltip">' + contents + '</div>').css({
                position: 'absolute',
                display: 'none',
                top: y + 5,
                left: x + 15,
                border: '1px solid #333',
                padding: '4px',
                color: '#fff',
                'border-radius': '3px',
                'background-color': '#333',
                opacity: 0.80
            }).appendTo("body").fadeIn(200);
        }

        var previousPoint = null;
        $(el).bind("plothover", function (event, pos, item) {
            $("#x").text(pos.x.toFixed(2));
            $("#y").text(pos.y.toFixed(2));

            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;

                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2),
                            y = item.datapoint[1].toFixed(2);

                    var contents = item.series.data[item.dataIndex]['2'];
                    showTooltip(item.pageX, item.pageY, contents);
                }
            } else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });

    }

    $scope.report_xls = function () {
        $http({
            method: 'POST',
            url: '/client_leads/raport_xls.xlsx',
            data: $scope.input
        })
    }
});












