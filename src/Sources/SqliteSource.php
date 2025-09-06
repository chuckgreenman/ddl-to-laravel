<?php

namespace ChuckGreenman\DdlToLaravel\Sources;

use PDO\Sqlite;

class SqliteSource implements BaseSource
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
        return [];
    }
}
