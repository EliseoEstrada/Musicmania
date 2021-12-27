CREATE DATABASE MusicmaniaDB;

USE MusicmaniaDB;

CREATE TABLE categories( 
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50)
);

CREATE TABLE products( 
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100),
    description TEXT,
    price FLOAT,
    amount INT,
    rating FLOAT,
    image VARCHAR(100),
    extension VARCHAR(20),
    create_at DATETIME,
    category_id INT(11),
    CONSTRAINT fk_category FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE users(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE,
    email VARCHAR(100),
    password VARCHAR(50),
    rol TINYINT,
    image VARCHAR(100),
    extension VARCHAR(20)
);

