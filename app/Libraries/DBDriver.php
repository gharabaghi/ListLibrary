<?php
namespace App\Libraries;

use App\Libraries\ListLibrary\Interfaces\ListDriver;
use App\Models\ListModel;

class DBDriver implements ListDriver
{
    public function getList():array
    {
        return ListModel::all()->toArray();
    }
}
