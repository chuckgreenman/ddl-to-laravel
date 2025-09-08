<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use ChuckGreenman\DdlToLaravel\Columns\Column;
use ChuckGreenman\DdlToLaravel\Sources\PostgreSqlSource;
use PDO;

class PostgreSqlSourceTest extends TestCase
{
    private ?PostgreSqlSource $postgreSqlSource = null;
    private ?PDO $connection = null;

    protected function setUp(): void
    {
        parent::setUp();

        $host = getenv('POSTGRES_HOST') ?: 'localhost';
        $port = getenv('POSTGRES_PORT') ?: '5432';
        $dbname = getenv('POSTGRES_DB') ?: 'northwind';
        $user = getenv('POSTGRES_USER') ?: 'postgres';
        $password = getenv('POSTGRES_PASSWORD') ?: 'postgres';

        try {
            $dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
            $this->connection = new PDO($dsn, $user, $password);
            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (\PDOException $e) {
            $this->markTestSkipped(
                "PostgreSQL database connection failed: " . $e->getMessage()
            );
        }

        $this->postgreSqlSource = new PostgreSqlSource($this->connection);
    }

    protected function tearDown(): void
    {
        $this->connection = null;
        $this->postgreSqlSource = null;
        parent::tearDown();
    }

    public function test_number_of_tables_returns_integer(): void
    {
        $result = $this->postgreSqlSource->numberOfTables();
        $this->assertIsInt($result);
        $this->assertEquals(13, $result);
    }

    public function test_list_of_tables_returns_array(): void
    {
        $result = $this->postgreSqlSource->listOfTables();
        $this->assertIsArray($result);
        $this->assertEquals(
            [
                "categories",
                "customer_customer_demo",
                "customer_demographics",
                "customers",
                "employee_territories",
                "employees",
                "order_details",
                "orders",
                "products",
                "regions",
                "shippers",
                "suppliers",
                "territories"
            ],
            $result
        );
    }

    public function test_list_columns_returns_array(): void
    {
        $expected = [
            new Column("categories", "category_id", "INTEGER"),
            new Column("categories", "category_name", "CHARACTER VARYING"),
            new Column("categories", "description", "TEXT"),
            new Column("categories", "picture", "BYTEA")
        ];

        $result = $this->postgreSqlSource->listColumns("categories");
        $this->assertEquals($expected, $result);
        $this->assertIsArray($result);
    }
}