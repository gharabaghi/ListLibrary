<?php
namespace App\Libraries\ListLibrary\Classes;

use App\Libraries\ListLibrary\Interfaces\ListDriver;

class ListLibrary
{
    protected $defaultPageLength = 15;

    protected $driver;

    protected $list;

    protected ListHelper $helper;

    protected $perPage;

    protected ListSort $listSort;

    protected ListSearch $listSearch;

    protected array $metadata;

    protected Paginator $paginator;

    protected Columns $columns;

    public function __construct($driver, $perPage = null, array $columns, array $searchable = [], array $sortable = [], array $metadata = [])
    {
        $this->setDriverObject($driver);

        $this->list = [];

        $this->listSort = new ListSort($sortable);

        $this->validateCols($columns, $searchable, $sortable);

        $this->paginator = new Paginator($perPage ?? $this->defaultPageLength, 1);

        $this->listSearch = new ListSearch($searchable);

        $this->metadata = $metadata;

        $this->columns = new Columns($columns);
    }

    protected function validateCols($columns, $searchable, $sortable)
    {
        if (count(array_intersect(array_keys($columns), $searchable)) != count($searchable)) {
            throw new \Exception('All members of searchable array must be present in columns array.');
        }
        if (count(array_intersect(array_keys($columns), $sortable)) != count($sortable)) {
            throw new \Exception('All members of sortable array must be present in columns array.');
        }
    }

    public function getPerPage():int
    {
        return $this->paginator->getPerPage();
    }

    public function setPerPage(int $perPage)
    {
        $this->paginator->setPerPage($perPage);
    }

    public function getSearchable():array
    {
        return $this->listSearch->getSearchable();
    }

    public function setSearchable(array $searchable)
    {
        $this->listSearch->setSearchable($searchable);
    }

    public function getSortable():array
    {
        return $this->listSort->getSortable();
    }

    public function setSortable(array $sortable)
    {
        $this->listSort->setSortable($sortable);
    }

    public function getMetadata():array
    {
        return $this->metadata;
    }

    public function setMetadata(array $metadata)
    {
        $this->metadata = $metadata;
    }

    public function getDriver()
    {
        return $this->driver;
    }

    public function setDriver($driver)
    {
        $this->setDriverObject($driver);
    }

    public function getList($page = null, $search = null, $sort = null):array
    {
        if ($page) {
            $this->paginator->setPage($page);
        }

        if ($search) {
            $this->listSearch->setNeedle($search);
        }

        if ($sort) {
            $this->listSort->setColumn($sort);
        }

        $this->list = $this->driver->getList();

        return ['list' => $this->fetchContent(), 'metadata' => $this->metadata, 'columns' => $this->columns->getColumnsInfo()];
    }

    public function nextPage()
    {
        $this->paginator->setPage($this->paginator->getPage() + 1);
        return $this->getList();
    }

    public function previousPage()
    {
        $page = $this->paginator->getPage();
        if ($page > 1) {
            $page--;
        }
        return $this->getList();
    }

    protected function fetchContent()
    {
        $list = $this->listSearch->search($this->list);

        $list = $this->listSort->sort($list);

        $list = $this->paginator->paginate($list);

        $list = $this->columns->filterOutput($list);

        $list = $this->columns->castColumns($list);

        return $list;
    }

    protected function setDriverObject($driver)
    {
        if (!($driver instanceof ListDriver)) {
            throw new \Exception('Driver must implement ListDriver interface');
        }

        $this->driver = $driver;
    }
}
