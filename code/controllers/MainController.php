<?php

namespace controllers;

use base\BaseController;
use models\BookGuest;

class MainController extends BaseController
{
    public function actionShow()
    {
        $book = new BookGuest();
        $guests = $book->showRecords();

        return $this->render($guests, 'main');
    }

    public function actionAddRecord()
    {
        $book = new BookGuest();
        return $book->addRecord($this->post);
    }
}
