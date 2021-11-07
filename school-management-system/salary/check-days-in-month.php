<?php
$month = (int)$_POST['month_'];
$year = (int)$_POST['year_'];

$d = cal_days_in_month(CAL_GREGORIAN, $month, $year); //how many days in this month

echo $d;
