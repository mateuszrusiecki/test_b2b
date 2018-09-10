    
<style>
    body{
        line-height: 30px;
    }
    h1{
        text-align: center;
        padding: 40px 0;
    }

    .left{
        float: left;
    }

    .right{
        /*float: right;*/
        text-align: right;
    }

    .pdf_signatures, .pdf_content{
        margin-bottom: 70px;
    }
    .bold{
        font-weight: bold;
    }
</style>


<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">

        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->

        <!-- BEGIN PAGE TOP -->
        <div class="page-top">
            <!-- BEGIN HEADER SEARCH BOX -->
            <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->

            <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">

            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>


<div class="page-container">
    <div class="page-sidebar-wrapper">

    </div>

    <div class="page-content-wrapper">
        <div class="page-content">

            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE HEAD -->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <div class="pdf_name left">
                        <?php echo $profile['Profile']['firstname'] . ' ' . $profile['Profile']['surname']; ?><br/>
                        <?php //echo __d('public','Imię i nazwisko pracownika'); ?>
                    </div>

                    <div class="pdf_data right">
                        <?php echo $profile['Profile']['place_of_work'] ?>
                        <?php echo __d('public', ' dnia '); ?> 
                        <?php echo substr($vacation['Vacation']['created'], 0, 10) ?>
                    </div>
                    <h1><?php echo __d('public', 'Wniosek'); ?>
                        <?php
                        if ($vacation['VacationType']['is_hours'])
                        {
                            echo __d('public', ' o udzielenie zwolnienia ');
                        } else
                        {
                            echo __d('public', ' o urlop ');
                        }
                        ?>
                    </h1>


                    <div class="pdf_content">
                        <p><?php echo __d('public', 'Proszę o udzielenie'); ?>:</p>
                        <p>
                            <?php
                            if ($vacation['VacationType']['is_hours'])
                            {
                                echo __d('public', 'Zwolnienia od pracy w dniu ');
                                echo '<span class="bold">' . $vacation['Vacation']['date_start'] . '</span>';
                                echo __d('public', ' w celu załatwienia spraw osobistych ');
                                echo __d('public', 'od godziny ');
                                echo '<span class="bold">' . date('H:i', strtotime($vacation['Vacation']['time_start'])) . '</span>';
                                echo __d('public', ' do godziny ');
                                echo '<span class="bold">' . date('H:i', strtotime($vacation['Vacation']['time_end'])) . '</span>';
                            } else {
                                //echo __d('public','Urlopu wypoczynkowego / bezpłatnego / okolicznościowego / opieki nad dzieckiem / * ');
                                echo $vacationType['VacationType']['name'];
                                echo __d('public', ' w okresie od dnia ');
                                echo '<span class="bold">' . $vacation['Vacation']['date_start'] . '</span>';
                                echo __d('public', ' do dnia ');
                                echo '<span class="bold">' . $vacation['Vacation']['date_end'] . '</span>';
                            }
                            ?>

                            <?php echo __d('public', 'włącznie tj.'); ?>

                            <?php
                            if ($vacation['VacationType']['is_hours'])
                            {
                                $hours = strtotime($vacation['Vacation']['time_end']) - strtotime($vacation['Vacation']['time_start']);
                                $godziny = floor(( strtotime($vacation['Vacation']['time_end']) - strtotime($vacation['Vacation']['time_start']) ) / 3600);
                                $minuty = (( strtotime($vacation['Vacation']['time_end']) - strtotime($vacation['Vacation']['time_start']) ) / 60) % 60;
                                if ($godziny > 0)
                                {
                                    echo '<span class="bold">' . $godziny . ':' . $minuty . '</span>';
                                    echo __d('public', ' godzin roboczych');
                                } else {
                                    echo '<span class="bold">' . $minuty . '</span>';
                                    echo __d('public', ' minut');
                                }
                            } else {
                                $secs = strtotime($vacation['Vacation']['date_end']) - strtotime($vacation['Vacation']['date_start']);
                                $sum_days = $days = ($secs / 86400) + 1; //+1 ponieważ urlop liczy się razem z datą początkową, np. od 2015-03-08 do 2015-03-08 
                                echo '<span class="bold">' . $days . '</span>';
                                echo __d('public', ' dni roboczych');
                            }
                            ?>.

                        </p>

                    </div>

                    <div class="pdf_signatures">
                        <div class="left">
                            ...............................................<br/>
                            <?php echo __d('public', 'podpis przełożonego'); ?>
                        </div>

                        <div class="right">
                            ...............................................<br/>
                            <?php echo __d('public', 'podpis pracownika'); ?>
                        </div>

                    </div>

                </div>
                <!-- END PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD -->
            <!-- BEGIN PAGE BREADCRUMB -->

        </div>
    </div>
</div>


<div class="page-footer">
    <div class="page-footer-inner">

    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
