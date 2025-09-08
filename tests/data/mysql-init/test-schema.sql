-- MySQL test schema that exactly matches MySqlSourceTest expectations
CREATE TABLE Categories (
    CategoryID INT AUTO_INCREMENT PRIMARY KEY,
    CategoryName VARCHAR(255),
    Description TEXT,
    Picture LONGBLOB
);

CREATE TABLE CustomerCustomerDemo (
    CustomerID CHAR(5),
    CustomerTypeID CHAR(10)
);

CREATE TABLE CustomerDemographics (
    CustomerTypeID CHAR(10) PRIMARY KEY,
    CustomerDesc TEXT
);

CREATE TABLE Customers (
    CustomerID CHAR(5) PRIMARY KEY,
    CompanyName VARCHAR(40)
);

CREATE TABLE EmployeeTerritories (
    EmployeeID INT,
    TerritoryID VARCHAR(20)
);

CREATE TABLE Employees (
    EmployeeID INT AUTO_INCREMENT PRIMARY KEY,
    LastName VARCHAR(20)
);

CREATE TABLE `Order Details` (
    OrderID INT,
    ProductID INT
);

CREATE TABLE Orders (
    OrderID INT AUTO_INCREMENT PRIMARY KEY,
    CustomerID CHAR(5)
);

CREATE TABLE Products (
    ProductID INT AUTO_INCREMENT PRIMARY KEY,
    ProductName VARCHAR(40)
);

CREATE TABLE Regions (
    RegionID INT PRIMARY KEY,
    RegionDescription CHAR(50)
);

CREATE TABLE Shippers (
    ShipperID INT AUTO_INCREMENT PRIMARY KEY,
    CompanyName VARCHAR(40)
);

CREATE TABLE Suppliers (
    SupplierID INT AUTO_INCREMENT PRIMARY KEY,
    CompanyName VARCHAR(40)
);

CREATE TABLE Territories (
    TerritoryID VARCHAR(20) PRIMARY KEY,
    TerritoryDescription CHAR(50)
);