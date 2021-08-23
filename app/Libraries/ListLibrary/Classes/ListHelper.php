<?php

namespace App\Libraries\ListLibrary\Classes;


class ListHelper{

    protected $columns;

    public function __construct(int $columns)
    {
       //Validation needed
       $this->columns = $columns; 
    }

    public function getColumns(){
        return $this->columns;
    }

    public function setColumns(int $columns)
    {
        //Validation needed
        $this->columns = $columns;
    }

    //functions for validation, search, sort, get additional data
}