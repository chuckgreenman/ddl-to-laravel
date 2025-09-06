<?php

namespace ChuckGreenman\DdlToLaravel\Sources;

use ChuckGreenman\DdlToLaravel\Columns\Column;

class SqliteSource implements Source
{
    private $connection;

    public function __construct($sqliteConnection)
    {
        $this->connection = $sqliteConnection;
    }

    public function numberOfTables(): int
    {
        $statement = $this->connection->prepare(
            "SELECT count(*) FROM sqlite_master WHERE type = 'table' AND name NOT LIKE 'sqlite_%';",
        );
        $statement->execute();
        $result = $statement->fetchColumn();

        return $result ?: 0;
    }

    public function listOfTables(): array
    {
        $statement = $this->connection->prepare(
            "SELECT name FROM sqlite_master WHERE type = 'table' AND name NOT LIKE 'sqlite_%';",
        );
        $statement->execute();
        $results = $statement->fetchAll(\PDO::FETCH_COLUMN);

        return $results ?: [];
    }

    public function listColumns(string $tableName): array
    {
        $query = 'PRAGMA table_info("%s");';
        $statement = $this->connection->prepare(sprintf($query, $tableName));
        $statement->execute();
        $columns = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $columns = array_map(function ($column) use ($tableName) {
            return new Column(
                $tableName,
                $column['name'],
                $column['type']
            );
        }, $columns);

        return $columns;
    }
}
