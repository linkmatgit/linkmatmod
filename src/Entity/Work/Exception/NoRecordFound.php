<?php


namespace App\Entity\Work\Exception;


class NoRecordFound extends \Exception
{
    public function __construct()
    {
        parent::__construct('', 0, null);
    }

    public function getMessageKey()
    {
        return 'No record Found';
    }

}