<?php
namespace App\Libraries\ListLibrary\Classes;

class ListSearch
{
    protected array $searchable;
    protected $needle;

    public function __construct(array $searchable, $needle = null)
    {
        $this->searchable = $searchable;
        $this->needl = $needle;
    }

    public function getSearchable() :array
    {
        return $this->searchable;
    }

    public function setSearchable(array $searchable)
    {
        $this->searchable = $searchable;
        return $this;
    }

    public function getNeedle()
    {
        return $this->needle;
    }

    public function setNeedle($needle)
    {
        $this->needle = $needle;
    }

    public function search(array $list, $needle = null) : array
    {
        if (!$needle && !$this->needle) {
            return $list;
        } elseif (!$needle) {
            $needle = $this->needle;
        }
        $output = [];
        foreach ($list as $l) {
            if (array_search($needle, array_intersect_key($l, array_flip($this->searchable)), true) !== false) {
                $output[] = $l;
            }
        }

        return $output;
    }
}
