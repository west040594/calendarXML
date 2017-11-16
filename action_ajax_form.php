<?php
if (isset($_POST["yearSelect"])) {
   require_once('./Calendar.php');
   require_once('./Connection.php');
   require_once('./Days.php');
   require_once('./Holidays.php');
   require_once('./Types.php');
   $select_year = $_POST['yearSelect'];
   $calendar = new Calendar($select_year); //Объект XML календаря
   $connection = new Connection('localhost', 'root', '', 'calendar');
   $days_table = new Days($connection);
   $holidays_table = new Holidays($connection);
   $types_table = new Types($connection);

   if(!$days_table->yearIsset($select_year)) { //Если полей с выбранным годом не существуют в БД
       // Вставляем значения
       foreach ($calendar->days as $day) {
           $days_table->insert($day['day'], $day['type_id'], $day['holiday_id'], $select_year);
       }
   }

   foreach ($calendar->holidays as $holiday) { //Проходим по разделу каникул xml
       $holiday_title = $holiday['title'];
       if(!$holidays_table->holidayIsset($holiday_title)) { //Если праздника нету в бд - добавляем
           $holidays_table->insert($holiday_title);
       }
   }
    // Получем дни из Бд по выбранному году
    $days_records = $days_table->select($select_year);
   // Формируем таблицу значений на вывод
    $table = [];
    for ($i = 0; $i < sizeof($days_records); $i++) {
       $table[$i]['row'] = $i + 1;
       $table[$i]['day'] = $days_records[$i]['day'] . ".{$select_year}";
       //$table[$i]['typeTitle'] = $calendar->getTypeTitle($days_records[$i]['type_id']);
       $table[$i]['typeTitle'] = $types_table->getTitle($days_records[$i]['type_id']);
       //$table[$i]['holidayTitle'] = $calendar->getHolidayTitle($days_records[$i]['holiday_id']);
       $table[$i]['holidayTitle'] = $holidays_table->getTitle($days_records[$i]['holiday_id']);
    }

    //Возвращаем JSON представление массива
    $result = [
        'table' => $table,
    ];
    echo json_encode($result);
}
