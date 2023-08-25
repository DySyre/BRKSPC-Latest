<?php
function build_calendar($month, $year){
    //create array containing abbreviations of days of week.
    $daysOfWeek = array('Sundy','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

    // What is the first dy of the month
    $firstDayOfMonth = mktime(0,0,0,$month, 1,$year);

    // How many days does this month contain
    $numberDays = date('t',$firstDayOfMonth);

    //Retrieve some iniformation about the first day of the month
    $dateComponents = getdate($firstDayOfMonth);

    //what is the name of the month
    $monthName = $dateComponents['month'];

    $dayOfWeek = $dateComponents['wday'];

    $datetoday = date('Y-m-d');

    $calendar = "<table class='table table-bordered'>";
    $calendar.="<center><h2>$monthName $year</h2>";
    $calendar.="<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0,0,0,$month-1, 1,$year))."
    &year=".date('Y', mktime(0,0,0,$month-1, 1,$year))."'>Previous Month</a>";

    $calendar.="<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0,0,0,$month+1, 1,$year))."
    &year=".date('Y', mktime(0,0,0,$month+1, 1,$year))."'>Next Month</a></center>";



    $calendar .="<tr>";

    // Caalendar header
    foreach($daysOfWeek as $day){
        $calendar .="<th class='header'>$day</th>";
    }

    // Create the rest of the calendar

    //initiate the day counter, startnig with the 1st.

    $currentDay = 1;

}


?>