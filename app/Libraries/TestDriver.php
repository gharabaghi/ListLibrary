<?php
namespace App\Libraries;

use App\Libraries\ListLibrary\Interfaces\ListDriver;

class TestDriver implements ListDriver
{
    public function getList(): array
    {
        return [
            [
                'a' => 1,
                'b' => 2
            ],
            [
                'a' => 3,
                'b' => 4
            ],
            [
                'a' => 5,
                'b' => 6
            ],
            [
                'a' => 7,
                'b' => 8
            ],
            [
                'a' => 9,
                'b' => 10
            ],
            [
                'a' => 11,
                'b' => 12
            ],
            [
                'a' => 13,
                'b' => 14
            ],
            [
                'a' => 15,
                'b' => 16
            ],
        ];
    }
}
