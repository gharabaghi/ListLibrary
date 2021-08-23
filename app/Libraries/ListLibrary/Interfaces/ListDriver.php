<?php

namespace App\Libraries\ListLibrary\Interfaces;

interface ListDriver{
    public function getList(): array;
}