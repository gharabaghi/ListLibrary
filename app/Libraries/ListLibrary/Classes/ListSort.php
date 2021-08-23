<?php
namespace App\Libraries\ListLibrary\Classes;

class ListSort
{
    protected array $sortable;

    protected $column;

    public function __construct(array $sortable, string $column = null)
    {
        $this->sortable = $sortable;

        $this->column = $column;
    }

    public function getSortable():array
    {
        return $this->sortable;
    }

    public function setSortable(array $sortable)
    {
        $this->sortable = $sortable;
    }

    public function setColumn(string $column)
    {
        $this->column = $column;
    }

    public function getColumn():string
    {
        return $this->column;
    }

    public function sort(array $list, string $column = null):array
    {
        if (!$column && !$this->column) {
            return $list;
        } elseif (!$column) {
            $column = $this->column;
        }

        if (in_array($column, $this->sortable, true) === false) {
            throw new \Exception('This column is not sortable');
        }

        usort($list, function ($a, $b) use ($column) {
            return ($a[$column] > $b[$column]) ? 1 : -1;
        });

        return $list;
    }
}
