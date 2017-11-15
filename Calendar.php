<?php

class Calendar
{
    public $year;
    public $days = [];
    public $holidays = [];

    private $xml_url;
    private $xml_calendar;

    public function __construct($year)
    {
        $this->year = $year;
        $this->xml_url = "http://xmlcalendar.ru/data/ru/{$this->year}/calendar.xml";
        $this->xml_calendar = simplexml_load_file($this->xml_url);
        $this->makeHolidays();
        $this->makeDays();
    }

    public function  getTypeTitle($type)
    {
        switch ($type) {
            case 1:
                return 'выходной день';
            case 2:
                return 'рабочий и сокращенный';
            case 3:
                return 'рабочий день';
            default:
                return null;
        }
    }

    public function getHolidayTitle($id)
    {
        global $searchId;
        $searchId = $id;
        $result = array_filter($this->holidays, function($innerArray){
            global $searchId;
            return in_array($searchId, $innerArray);    //Поиск по всему массиву
        });

        return current($result)['title'];

    }

    private function makeHolidays()
    {
        $i = 0;
        foreach($this->xml_calendar->holidays->holiday as $holiday) {
            if(isset($holiday->attributes()->id))
                $this->holidays[$i]['id'] = (string)$holiday->attributes()->id;
            else
                $this->holidays[$i]['id'] = null;

            if(isset($holiday->attributes()->title))
                $this->holidays[$i]['title'] = (string)$holiday->attributes()->title;
            else
                $this->holidays[$i]['title'] = null;

            $i++;
        }
    }


    private function makeDays()
    {
        $i = 0;
        foreach($this->xml_calendar->days->day as $day) {
            if(isset($day->attributes()->d))
                $this->days[$i]['day'] = (string)$day->attributes()->d;
            else
                $this->days[$i]['day'] = null;

            if(isset($day->attributes()->t))
                $this->days[$i]['type'] = (int)$day->attributes()->t;
            else
                $this->days[$i]['type'] = null;

            if(isset($day->attributes()->h))
                $this->days[$i]['holiday_id'] = (int)$day->attributes()->h;
            else
                $this->days[$i]['holiday_id'] = null;

            $i++;
        }
    }

}