<?php
$xychart = $this->requestAction(array('admin' => 'admin', 'prefix' => 'admin', 'controller' => 'panel', 'action' => 'chart'));

if (!empty($xychart)) {
    ?>
    <div style="width: 800px">
        <h2><span><?php echo __d('cms', 'Użytkownicy i odsłony w ostanim miesiącu'); ?></span></h2>
        <div style="margin: 10px 0;" >
            <?php
            $views = Set::extract($xychart, '{n}.GoogleAnalyticsAccount.metrics.0.@value');
            $viewers = Set::extract($xychart, '{n}.GoogleAnalyticsAccount.metrics.1.@value');

            $max = max(array_merge($viewers, $views));
            $min = min(array_merge($viewers, $views));

            $min = $min > 0 ? $min : 1;
            $max = $max > 0 ? $max : 1;

            $min_log = floor(log10($min));

            $max_log = floor(log10($max));

            $max = round($max, -$max_log) + pow(10, $max_log);  //

            $min = 10 * $min_log; //round($min, -$min_log);
            $scale = pow(10, round(log10($max - $min))) / 10;

            $labels = Set::extract($xychart, '{n}.GoogleAnalyticsAccount.dimensions.@value');
            foreach ($labels AS &$label) {
                $labelTime = strtotime($label);
                $label = date('j.m.Y\r', $labelTime);
            }
            ?>        

            <script type="text/javascript" src="https://www.google.com/jsapi"></script>
            <script type="text/javascript">
                google.load("visualization", "1", {packages:["corechart"]});
                google.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Data', 'Odsłony', 'Użytkownicy'],
    <?php foreach ($labels AS $i => $label) { ?>
                    ['<?php echo $label; ?>',  <?php echo $views[$i]; ?>, <?php echo $viewers[$i]; ?>],
    <?php } ?>
            ]);

            var options = {
                backgroundColor: '#EBEBEB',
                legend : {position: 'top'},
                colors: ['#f18e00', '#5c5c5d', '#c3c3c3', '#2222aa'],
                chartArea: {width: '90%', height: '75%', left: 60},
                series: [{areaOpacity: '0.2'}, {areaOpacity: '0.5'}]
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
            </script>
            <div id="chart_div" style="width: 800px; height: 500px; margin: 0px; padding: 0px;"></div>
        </div>
    </div>
    <?php
}
