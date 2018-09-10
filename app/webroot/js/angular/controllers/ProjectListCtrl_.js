app.controller('ProjectListCtrl', function ($scope, $rootScope, $compile, DTOptionsBuilder, DTColumnBuilder, DTInstances) {
    $scope.dtOptions = DTOptionsBuilder.fromSource('/client_projects/get.json')
            .withOption('createdRow', createdRow)
            .withPaginationType('full_numbers')
            .withOption('dom', '<"toolbar-project">frtip')
            .withLanguageSource('/assets/global/plugins/datatables/i18n/Polish.json')

    $scope.dtColumns = [
        DTColumnBuilder.newColumn('id').withTitle('ID').notVisible(),
        DTColumnBuilder.newColumn('name').withTitle('Nazwa Projektu'),
        DTColumnBuilder.newColumn('start_project').withTitle('Początek'),
        DTColumnBuilder.newColumn('end_project').withTitle('Koniec'),
        DTColumnBuilder.newColumn('budget').withTitle('Budżet'),
        DTColumnBuilder.newColumn(null).withTitle('Status').notSortable()
                .renderWith(statusHtml),
    ];
    DTInstances.getLast().then(function (dtInstance) {
        $scope.dtInstance = dtInstance;
    });
    function createdRow(row, data, dataIndex) {
        // Recompiling so we can bind Angular directive to the DT
        $rootScope.$apply(function () {
            $compile(angular.element(row).contents())($scope);
        });
    }
    function statusHtml(data, type, full, meta) {
        return '<div status-project id="' + data.id + '"></div>';
    }
    // koniec konfiguracji tatatables

    $scope.message = '';







//bar configuration


    $scope.dtOptionsBar = DTOptionsBuilder.fromSource('/client_projects/get.json')
            .withOption('createdRow', createdRow)
            .withPaginationType('full_numbers')
            .withOption('dom', '<"toolbar-project">frtip')
            .withLanguageSource('/assets/global/plugins/datatables/i18n/Polish.json')

    $scope.dtColumnsBar = [
        DTColumnBuilder.newColumn('id').withTitle('ID').notVisible(),
        DTColumnBuilder.newColumn('name').withTitle('Nazwa Projektu'),
        DTColumnBuilder.newColumn(null).withTitle('Harmonogram').notSortable()
                .renderWith(barHtml),
    ];


    function barHtml(data, type, full, meta) {
        return '<div bar-project id="' + data.id + '"></div>';
    }
    // koniec konfiguracji tatatables

    $scope.message = '';


});