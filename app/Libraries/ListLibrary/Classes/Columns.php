<?php
namespace App\Libraries\ListLibrary\Classes;

class Columns
{
    protected $outputColumns;

    protected $columnTypes;

    protected $columnsInfo;

    const COLUMN_TYPE_STRING = 'string';
    const COLUMN_TYPE_NUMBER = 'int';

    public function __construct(array $columns)
    {
        $this->setVars($columns);
    }

    public function setColumns(array $columns)
    {
        $this->setVars($columns);
    }

    public function getColumnTypes():array
    {
        return $this->columnTypes;
    }

    public function getColumnsInfo():array
    {
        return $this->columnsInfo;
    }

    public function getOutpuColumns():array
    {
        return $this->outputColumns;
    }

    public function filterOutput(array $list):array
    {
        $outList = [];
        foreach ($list as $l) {
            $outList[] = array_intersect_key($l, array_flip($this->outputColumns));
        }

        return $outList;
    }

    public function castColumns($list)
    {
        for ($i = 0; $i < count($list); $i++) {
            foreach ($list[$i] as $k => $item) {
                if (array_key_exists($k, $this->columnTypes)) {
                    switch ($this->columnTypes[$k]) {
                    case self::COLUMN_TYPE_NUMBER:
                        $list[$i][$k] = intval($list[$i][$k]);
                        break;
                    case self::COLUMN_TYPE_STRING:
                        $list[$i][$k] = strval($list[$i][$k]);
                        break;
                    default:
                        continue 2;
                    }
                }
            }
        }

        return $list;
    }

    protected function setVars($columns)
    {
        $this->outputColumns = array_keys($columns);

        $this->columnTypes = [];
        $this->columnsInfo = [];
        foreach (array_keys($columns) as $k) {
            if (array_key_exists('type', $columns[$k])) {
                $this->columnTypes[$k] = $columns[$k]['type'];
            }

            $info = [];
            if (array_key_exists('width', $columns[$k])) {
                $info['width'] = $columns[$k]['width'];
            }
            if (array_key_exists('title', $columns[$k])) {
                $info['title'] = $columns[$k]['title'];
            }
            if (!empty($info)) {
                $this->columnsInfo[$k] = $info;
            }
        }
    }
}
