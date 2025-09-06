<?php

interface BaseSource
{
    /**
     * Returns the number of tables in a sources.
     *
     * @return int
     */
    public function numberOfTables(): int;

    /**
     * Returns a list of table names as an array of strings from current soruce.
     *
     * @return array.
     */
    public function listOfTables(): array;

    /**
     * Returns an array of Columns
     * @return array
     */
    public function listColumns(string $tableName): array;
}
