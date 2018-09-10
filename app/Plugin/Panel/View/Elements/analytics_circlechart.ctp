<div class="clearfix">
<h2>&nbsp;</h2>
<div style="float:left; padding-left: 10px; width: 390px;">
<?php  
    $chart = $this->requestAction(array('admin' => 'admin', 'prefix'=>'admin', 'controller' => 'panel', 'action' => 'chart2'));
    $newchart = array();
    $default = null;
    
    foreach($chart AS $i => $value){
        $n = $i;
        if(!empty($value['GoogleAnalyticsAccount']['dimensions']['@value'])){
            switch($value['GoogleAnalyticsAccount']['dimensions']['@value']){
                case '(none)':
                    $value['GoogleAnalyticsAccount']['label'] = __("Odwiedziny bezpośrednie");
                    $newchart[] = $value;
                    break;
                case 'referral':
                    $value['GoogleAnalyticsAccount']['label'] = __("Witryny odsyłające");
                    $newchart[] = $value;
                    break;
                case 'email':
                    $value['GoogleAnalyticsAccount']['label'] = __("Email");
                    $newchart[] = $value;
                    break;
                case 'organic':
                default:
                    if(empty($default)){
                        $value['GoogleAnalyticsAccount']['label'] = __("Wyszukiwarki");
                        $default = $i;
                        $newchart[] = $value;
                    } else {
                        $newchart[$default]['GoogleAnalyticsAccount']['metrics']['@value'] += $value['GoogleAnalyticsAccount']['metrics']['@value'];
                    }
            }
        } else {
            $error = true;
        }
    }
    $chart = $newchart;
    
//    $labels = Set::extract($chart, '{n}.GoogleAnalyticsAccount.label');
    //debug($chart);

if(empty($error)){
    
?>
    
    
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Źródło odwiedzin', 'Ilość'],
          <?php foreach($chart AS $value){ ?>
          ['<?php echo $value['GoogleAnalyticsAccount']['label'].' ('.$value['GoogleAnalyticsAccount']['metrics']['@value'].')';?>', <?php echo $value['GoogleAnalyticsAccount']['metrics']['@value']; ?>],
          <?php } ?>
        ]);

        var options = {
          title: 'Źródła odwiedzin',
          sliceVisibilityThreshold: 1/10000,
          backgroundColor: '#EBEBEB',
          colors: ['#5c5c5d', '#f18e00', '#c3c3c3', '#2222aa'],
          chartArea: {left: 10, top: 20, width: '90%', height: '80%'}
        };

        var chart = new google.visualization.PieChart(document.getElementById('circle_chart_div'));
        chart.draw(data, options);
      }
    </script>
    <div id="circle_chart_div" style="width: 390px; height: 300px;"></div>    
    
</div>
<?php } ?>
</div>
