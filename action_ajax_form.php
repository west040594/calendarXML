<?php
if (isset($_POST["yearSelect"])) {
    require_once('./Calendar.php');
    $year = $_POST['yearSelect'];
    $calendar = new Calendar($year);
    $table = [];
    for ($i = 0; $i < sizeof($calendar->days); $i++) {
       $table[$i]['row'] = $i + 1;
       $table[$i]['day'] = $calendar->days[$i]['day'] . ".{$year}";
       $table[$i]['typeTitle'] = $calendar->getTypeTitle($calendar->days[$i]['type']);
       $table[$i]['holidayTitle'] = $calendar->getHolidayTitle($calendar->days[$i]['holiday_id']);
    }
    $result = array(
        'table' => $table,
    );
    echo json_encode($result);
}
