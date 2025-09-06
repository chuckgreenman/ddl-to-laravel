<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use ChuckGreenman\DdlToLaravel\Sources\SqliteSource;
use PDO;

class SqliteSourceTest extends TestCase
{
    private ?SqliteSource $sqliteSource = null;
    private ?PDO $connection = null;

    protected function setUp(): void
    {
        parent::setUp();

        $dbPath = __DIR__ . "/../data/northwind.db";

        if (!file_exists($dbPath)) {
            $this->markTestSkipped(
                "Northwind database not found at: " . $dbPath,
            );
        }

        $this->connection = new PDO("sqlite:" . $dbPath);
        $this->connection->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION,
        );

        $this->sqliteSource = new SqliteSource($this->connection);
    }

    protected function tearDown(): void
    {
        $this->connection = null;
        $this->sqliteSource = null;
        parent::tearDown();
    }

    public function test_number_of_tables_returns_integer(): void
    {
        $result = $this->sqliteSource->numberOfTables();
        $this->assertIsInt($result);
        $this->assertEquals(13, $result);
    }

    public function test_list_of_tables_returns_array(): void
    {
        $result = $this->sqliteSource->listOfTables();
        $this->assertIsArray($result);
        $this->assertEquals(
            [
                "Categories",
                "CustomerCustomerDemo",
                "CustomerDemographics",
                "Customers",
                "Employees",
                "EmployeeTerritories",
                "Order Details",
                "Orders",
                "Products",
                "Regions",
                "Shippers",
                "Suppliers",
                "Territories",
            ],
            $result,
        );
    }

    public function test_list_columns_returns_array(): void
    {
        $result = $this->sqliteSource->listColumns("Orders");
        $this->assertIsArray($result);
    }
}
