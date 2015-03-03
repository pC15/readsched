<?php
//title: book title
//tpages: total pages of book
//spages: total pages read in one day
//daysperweek: number of days read in a week
//startdate

$title = $_GET['title'];
$tpages = (int) $_GET['totalpages'];
$spages = (int) $_GET['sittingpages'];
$daysperweek = (int) $_GET['daysperweek'];
$startdate = $_GET['startdate'];

//$totaldays: total pages divided by pages in one sitting.
//$weeks: $totaldays divided by days per week
//use ceiling (ceil()) to round all fractions up
$totaldays = ceil($tpages / $spages);
$weeks = ceil($totaldays / $daysperweek);

//for conversion purposes, I need substrings of the month, day and year of the selected start date
$startmonth = substr($startdate, 0, 2);
$startday = substr($startdate, 3, 2);
$startyear = substr($startdate, 6);

//calculate the julian day using grgoriantojd()
//I cast the variables as ints here, but I could have done it when I instantiated them
$julcalstartdate = gregoriantojd((int) $startmonth, (int) $startday, (int) $startyear);
//calculate the end date in julian days
$julcalenddate = $julcalstartdate + ($weeks * 7);
//convert to gregorian
$enddate = cal_from_jd($julcalenddate, CAL_GREGORIAN);
//$enddate is an array. $enddate[date] gives us date with slashes


//printed statements for testing
//commented out when I decided to use ajax
//Summary: <br/>
//Title: $title <br/>
//Total Pages: $tpages <br/>
//Sitting Pages: $spages <br/>
//Days Per Week: $daysperweek <br/>
//Start Date: $startdate <br/><br/>
//
//Start Date: $startmonth / $startday / $startyear
//Start Date: $julcalstartdate <br/><br/>
//End Date: $julcalenddate
//End Date: $enddate[date] <br/><br/>

echo <<<here
According to my calculations, it will take $totaldays days over $weeks weeks to finish $title.

Your approximate date of completion is: $enddate[date].

here;
?>