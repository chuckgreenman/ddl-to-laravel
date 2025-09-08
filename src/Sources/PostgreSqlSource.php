<?php

namespace ChuckGreenman\DdlToLaravel\Sources;

use ChuckGreenman\DdlToLaravel\Columns\Column;

class PostgreSqlSource implements Source
{
    private $connection;

    public function __construct($postgresConnection)
    {
        $this->connection = $postgresConnection;
    }

    public function numberOfTables(): int
    {
        $statement = $this->connection->prepare(
            "SELECT COUNT(*) FROM information_schema.tables 
             WHERE table_schema = 'public' 
             AND table_type = 'BASE TABLE';"
        );
        $statement->execute();
        $result = $statement->fetchColumn();

        return $result ?: 0;
    }

    public function listOfTables(): array
    {
        $statement = $this->connection->prepare(
            "SELECT table_name FROM information_schema.tables 
             WHERE table_schema = 'public' 
             AND table_type = 'BASE TABLE'
             ORDER BY table_name;"
        );
        $statement->execute();
        $results = $statement->fetchAll(\PDO::FETCH_COLUMN);

        return $results ?: [];
    }

    public function listColumns(string $tableName): array
    {
        $query = "SELECT column_name, data_type 
                  FROM information_schema.columns 
                  WHERE table_schema = 'public' 
                  AND table_name = :tableName
                  ORDER BY ordinal_position;";
        
        $statement = $this->connection->prepare($query);
        $statement->execute(['tableName' => $tableName]);
        $columns = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $columns = array_map(function ($column) use ($tableName) {
            return new Column(
                $tableName,
                $column['column_name'],
                strtoupper($column['data_type'])
            );
        }, $columns);

        return $columns;
    }
}