<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use ChuckGreenman\DdlToLaravel\Columns\Column;
use ChuckGreenman\DdlToLaravel\Sources\MySqlSource;
use PDO;

class MySqlSourceTest extends TestCase
{
    private ?MySqlSource $mySqlSource = null;
    private ?PDO $connection = null;

    protected function setUp(): void
    {
        parent::setUp();

        $host = getenv("MYSQL_HOST") ?: "127.0.0.1";
        $port = getenv("MYSQL_PORT") ?: "3306";
        $dbname = getenv("MYSQL_DATABASE") ?: "northwind";
        $user = getenv("MYSQL_USER") ?: "root";
        $password = getenv("MYSQL_PASSWORD") ?: "mysql";

        try {
            $dsn = "mysql:host={$host};port={$port};dbname={$dbname}";
            $this->connection = new PDO($dsn, $user, $password);
            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION,
            );
        } catch (\PDOException $e) {
            $this->markTestSkipped(
                "MySQL database connection failed: " . $e->getMessage(),
            );
        }

        $this->mySqlSource = new MySqlSource($this->connection);
    }

    protected function tearDown(): void
    {
        $this->connection = null;
        $this->mySqlSource = null;
        parent::tearDown();
    }

    public function test_number_of_tables_returns_integer(): void
    {
        $result = $this->mySqlSource->numberOfTables();
        $this->assertIsInt($result);
        $this->assertEquals(13, $result);
    }

    public function test_list_of_tables_returns_array(): void
    {
        $result = $this->mySqlSource->listOfTables();
        $this->assertIsArray($result);
        $this->assertEquals(
            [
                "Categories",
                "CustomerCustomerDemo",
                "CustomerDemographics",
                "Customers",
                "EmployeeTerritories",
                "Employees",
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
        $expected = [
            new Column("Categories", "CategoryID", "INT"),
            new Column("Categories", "CategoryName", "VARCHAR"),
            new Column("Categories", "Description", "TEXT"),
            new Column("Categories", "Picture", "LONGBLOB"),
        ];

        $result = $this->mySqlSource->listColumns("Categories");
        $this->assertEquals($expected, $result);
        $this->assertIsArray($result);
    }
}
