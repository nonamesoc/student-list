<?php
/**
 * Created by PhpStorm.
 * User: Noname
 * Date: 27.01.2019
 * Time: 18:05
 */

class Pager
{
    public $totalRecords;
    public $recordsPerPage;

    public function __construct($totalRecords,$recordsPerPage = 50){
        $this->totalRecords = $totalRecords;
        $this->recordsPerPage = $recordsPerPage;
    }

    public function getTotalPages(){
        $totalPages = ceil($this->totalRecords/$this->recordsPerPage);
        return $totalPages;
    }

}