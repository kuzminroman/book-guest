<?php

namespace components;

class ProjectHelper
{
    public static function dateToRecord($date)
    {
        $dateMain = strtotime($date);

        $dateForMessage = strftime("%d %B", $dateMain);
        if (strtotime(date('Y-m-d')) == strtotime(date_format(date_create($date), "Y-m-d"))) {
            $dateForMessage = 'сегодня';
        }

        $dateTimeMessage = 'Запись создана ' . $dateForMessage . ' в ' . strftime("%H:%M", $dateMain);
        return $dateTimeMessage;

    }

}