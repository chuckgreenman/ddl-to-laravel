# DDL to Laravel
Generate Laravel migrations, models and factories from DDLs

When working on a migration project to Laravel we need to convert the database schema to Laravel migrations, models and factories. When we do that manually it is time consuming and error prone.

Creating factories automatically encourages us to write tests and helps encourage writing more tests.

## Architecture

The project is divided into three main components:
* DDL Parser
  * Parse DDLs from the four supported databases
  * Eventually support callable functions like nullable, default, etc.
* Column Content Litmus Test
  * Select 100 rows randomly from each column, and determine the column type.
  * For Example: ipAddress is just a string, but it is a special string.
* Blueprint Generator
  * Generate a new migration file from the DDL and Column Content Litmus Test



## Column Type Support Table

Laravel's Blueprint class has many methods to create columns

| Method                  | MySQL | PostgreSQL | SQLite | SQL Server |
|-------------------------|-------|------------|--------|------------|
| id                      | No    | No         | No     | No         |
| increments              | No    | No         | No     | No         |
| integerIncrements        | No    | No         | No     | No         |
| tinyIncrements           | No    | No         | No     | No         |
| smallIncrements          | No    | No         | No     | No         |
| mediumIncrements         | No    | No         | No     | No         |
| bigIncrements            | No    | No         | No     | No         |
| char                    | No    | No         | No     | No         |
| string                  | No    | No         | No     | No         |
| tinyText                | No    | No         | No     | No         |
| text                    | No    | No         | No     | No         |
| mediumText              | No    | No         | No     | No         |
| longText                | No    | No         | No     | No         |
| integer                 | No    | No         | No     | No         |
| tinyInteger             | No    | No         | No     | No         |
| smallInteger            | No    | No         | No     | No         |
| mediumInteger           | No    | No         | No     | No         |
| bigInteger              | No    | No         | No     | No         |
| unsignedInteger         | No    | No         | No     | No         |
| unsignedTinyInteger     | No    | No         | No     | No         |
| unsignedSmallInteger    | No    | No         | No     | No         |
| unsignedMediumInteger   | No    | No         | No     | No         |
| unsignedBigInteger      | No    | No         | No     | No         |
| float                   | No    | No         | No     | No         |
| double                  | No    | No         | No     | No         |
| decimal                 | No    | No         | No     | No         |
| unsignedFloat           | No    | No         | No     | No         |
| unsignedDouble          | No    | No         | No     | No         |
| unsignedDecimal         | No    | No         | No     | No         |
| boolean                 | No    | No         | No     | No         |
| enum                    | No    | No         | No     | No         |
| set                     | No    | No         | No     | No         |
| json                    | No    | No         | No     | No         |
| jsonb                   | No    | No         | No     | No         |
| date                    | No    | No         | No     | No         |
| dateTime                | No    | No         | No     | No         |
| dateTimeTz              | No    | No         | No     | No         |
| time                    | No    | No         | No     | No         |
| timeTz                  | No    | No         | No     | No         |
| timestamp               | No    | No         | No     | No         |
| timestampTz             | No    | No         | No     | No         |
| softDeletes             | No    | No         | No     | No         |
| softDeletesTz           | No    | No         | No     | No         |
| year                    | No    | No         | No     | No         |
| binary                  | No    | No         | No     | No         |
| uuid                    | No    | No         | No     | No         |
| ipAddress               | No    | No         | No     | No         |
| macAddress              | No    | No         | No     | No         |
| geometry                | No    | No         | No     | No         |
| point                   | No    | No         | No     | No         |
| lineString              | No    | No         | No     | No         |
| polygon                 | No    | No         | No     | No         |
| geometryCollection      | No    | No         | No     | No         |
| multiPoint              | No    | No         | No     | No         |
| multiLineString         | No    | No         | No     | No         |
| multiPolygon            | No    | No         | No     | No         |
| multiPolygonZ           | No    | No         | No     | No         |
| computed                | No    | No         | No     | No         |
| rememberToken           | No    | No         | No     | No         |
| addColumn               | No    | No         | No     | No         |
| addColumnDefinition     | No    | No         | No     | No         |
| getColumns              | No    | No         | No     | No         |
| getAddedColumns         | No    | No         | No     | No         |
| getChangedColumns       | No    | No         | No     | No         |
