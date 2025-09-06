<?php

namespace ChuckGreenman\DdlToLaravel\Columns;

class Column
{
    public string $sourceColumnName;

    public string $sourceTableName;

    public string $sourceColumnType;

    public function __construct(
        string $sourceColumnName,
        string $sourceTableName,
        string $sourceColumnType,
    ) {
        $this->sourceColumnName = $sourceColumnName;
        $this->sourceTableName = $sourceTableName;
        $this->sourceColumnType = $sourceColumnType;
    }
}
