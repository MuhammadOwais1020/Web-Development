<?php
$gr = "";
$month = "";
$year = "";
$p_u_a = "";
$sql = "";

if (isset($_POST['filter-search'])) {
    $gr = $_POST['gr-number'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $p_u_a = $_POST['PaidUnpaidAll'];

    if ($gr != "") {
        $sql = "SELECT * FROM fees WHERE GR_no = " + $gr;
    } else if ($p_u_a == "All Records") {
        $sql = "SELECT * from fees order by fee_id DESC";
    } else if ($month != "" && $year == "" && $p_u_a == "") {
        $sql = 'SELECT * FROM fees WHERE fee_month = ' + $month + ' order by fee_id DESC';
    } else if ($month == "" && $year != "" && $p_u_a == "") {
        $sql = "SELECT * FROM fees WHERE fee_year = " + $year + " order by fee_id DESC";
    } else if ($month == "" && $year == "" && $p_u_a != "") {
        $sql = "SELECT * FROM fees WHERE status_ = '" + $p_u_a + "' order by fee_id DESC";
    } else if ($month != "" && $year != "" && $p_u_a == "") {
        $sql = "SELECT * FROM fees WHERE fee_month = " + $month + " and fee_year = " + $year + " order by fee_id DESC";
    } else if ($month != "" && $year == "" && $p_u_a != "") {
        $sql = "SELECT * FROM fees WHERE fee_month = " + $month + " and status_ = '" + $p_u_a + "' order by fee_id DESC";
    } else if ($month == "" && $year != "" && $p_u_a != "") {
        $sql = "SELECT * FROM fees WHERE fee_year = " + $year + " and status_ = '" + $p_u_a + "' order by fee_id DESC";
    } else if ($month != "" && $year != "" && $p_u_a != "") {
        $sql = "SELECT * FROM fees WHERE fee_month = " + $month + " and fee_year = " + $year + " and status_ = '" + $p_u_a + "' order by fee_id DESC";
    } else {
        $sql = "SELECT * from fees order by fee_id DESC";
    }
    echo $sql;
}
