<?php

namespace App\Libraries\ListLibrary\Classes;

class Paginator{

    protected $perPage;

    protected $page;

    public function construct(int $perPage = null, int $page = null){

        //setting default page length in a config file would be a better choice
        $this->perPage = $perPage?? 10;

        $this->page = $page?? 1;

    }

    public function getPerPage():int{
        return $this->perPage;
    }

    public function setPerPage(int $perPage){
        $this->perPage = $perPage;
    }

    public function getPage():int{
        return $this->page;
    }

    public function setPage(int $page){
        $this->page = $page;
    }

    public function paginate($list, $page=null):array{
        return array_slice($list,($this->perPage)*(($page??$this->page)-1),$this->perPage);
    }
}