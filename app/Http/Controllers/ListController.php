<?php

namespace App\Http\Controllers;

use App\Libraries\DBDriver;
use App\Libraries\ListLibrary\Classes\ListLibrary;
use App\Models\ListModel;
use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = [
        'name'=>[
                'type'=>'string',
                'width'=>'100',
                'title'=>'نام'
            ],
        'email'=>[
                'type'=>'string',
                'width'=>'100',
                'title'=>'ایمیل'
            ],
        'count'=>[
                'type'=>'int',
                'width'=>'100',
                'title'=>'تعداد'
            ],
        'title'=>[
                'type'=>'string',
                'width'=>'100',
                'title'=>'عنوان'
            ],
        'id'=>[
                'type'=>'int',
                'width'=>'100',
                'title'=>'آی‌دی'
            ],
        ];



        $searchable = ['name','email'];
        $sortable = ['name','id','count'];
        $metadata = ['first'=>'this is first metadta','second'=>'this is second'];

        $dbDriver = new DBDriver();

        $listLib = new ListLibrary($dbDriver,100,3,$columns,$searchable,$sortable,$metadata);

        return response($listLib->getList(1),200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ListModel  $listModel
     * @return \Illuminate\Http\Response
     */
    public function show(ListModel $listModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ListModel  $listModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListModel $listModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListModel  $listModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListModel $listModel)
    {
        //
    }
}
