<?php
namespace App\Http\Controllers;

use App\Libraries\ListLibrary\Classes\ListLibrary;
use App\Libraries\TestDriver;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ii()
    {
        $columns = ['a' => ['type' => 'string', 'width' => '12']/* ,'b'=>['type'=>'int','title'=>'test'] */];
        $metadata = ['test1' => 'first metadata', 'test2' => 'second metadata'];
        // dd(array_reverse(['a','b']));
        // dd(array_intersect(array_keys($columns),['c','b']));
        $listLib = new ListLibrary(new TestDriver(), 12, $columns, ['a'], ['a'], $metadata);
        // dd($listLib->getDriv)
        // dd($listLib->getDriver()->getList());
        // dd($listLib->list);
        dd($listLib->getList());
        // dd(Arr::has([]))
        dd(is_bool(true));
        dd('ab' < 'aa');
        $perPage = 2;
        $page = 3;
        $aa = [1, 2, 3, 4, 5, 6, 7, 8, 9];
        dd(array_slice($aa, $perPage * ($page - 1), $perPage));
    }
}
