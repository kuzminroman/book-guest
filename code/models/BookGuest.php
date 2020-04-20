<?php

namespace models;

class BookGuest extends \base\DataBase
{
    private $tableName = 'guest_book';

    /**
     * @param $fields
     * @return bool|\mysqli_result
     */
    public function addRecord($fields)
    {
        $dateNow = date("Y-m-d H:i:s");
        $book = [
            'id' => 'NULL',
            'dtime' => $dateNow,
            'name' => $fields['nameGuest'],
            'body' => $fields['text']
        ];

        return $this->add($book, $this->tableName);
    }

    /**
     * @return array
     */
    public function showRecords()
    {
        return $this->show($this->tableName, ['name', 'body', 'dtime'], null, ['order', 'id'], 'desc', 5);
    }

}