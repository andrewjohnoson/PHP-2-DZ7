<?php

namespace App;

class AdminDataTable
{
    protected array $rows;
    protected array $columns;

    public function __construct(array $rows, array $cols)
    {
        $this->rows = $rows;
        $this->columns = $cols;
    }

    public function render()
    {
        foreach ($this->rows as $row) {
            $className = get_class($row);
            foreach ($this->columns as $functionName => $column) {
                $table[$className][$functionName] = $column($row);
            }
            yield [$className => $table[$className]];
        }
    }
}