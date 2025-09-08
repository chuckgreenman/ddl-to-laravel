-- PostgreSQL test schema that exactly matches PostgreSqlSourceTest expectations
\c northwind;
CREATE TABLE categories (
    category_id INTEGER PRIMARY KEY,
    category_name CHARACTER VARYING(255),
    description TEXT,
    picture BYTEA
);

CREATE TABLE customer_customer_demo (
    customer_id CHAR(5),
    customer_type_id CHAR(10)
);

CREATE TABLE customer_demographics (
    customer_type_id CHAR(10) PRIMARY KEY,
    customer_desc TEXT
);

CREATE TABLE customers (
    customer_id CHAR(5) PRIMARY KEY,
    company_name CHARACTER VARYING(40)
);

CREATE TABLE employee_territories (
    employee_id INTEGER,
    territory_id CHARACTER VARYING(20)
);

CREATE TABLE employees (
    employee_id INTEGER PRIMARY KEY,
    last_name CHARACTER VARYING(20)
);

CREATE TABLE order_details (
    order_id INTEGER,
    product_id INTEGER
);

CREATE TABLE orders (
    order_id INTEGER PRIMARY KEY,
    customer_id CHAR(5)
);

CREATE TABLE products (
    product_id INTEGER PRIMARY KEY,
    product_name CHARACTER VARYING(40)
);

CREATE TABLE regions (
    region_id INTEGER PRIMARY KEY,
    region_description CHAR(50)
);

CREATE TABLE shippers (
    shipper_id INTEGER PRIMARY KEY,
    company_name CHARACTER VARYING(40)
);

CREATE TABLE suppliers (
    supplier_id INTEGER PRIMARY KEY,
    company_name CHARACTER VARYING(40)
);

CREATE TABLE territories (
    territory_id CHARACTER VARYING(20) PRIMARY KEY,
    territory_description CHAR(50)
);