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
    quantity INT,
    rating FLOAT,
    image VARCHAR(100),
    extension VARCHAR(20),
    create_at DATETIME,
    category_id INT(11)
    CONSTRAINT fk_category FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE users(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE,
    email VARCHAR(100) UNIQUE,
    password VARCHAR(50),
    address TEXT,
    image VARCHAR(100),
    extension VARCHAR(20)
);

CREATE TABLE orders(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    create_at DATETIME,
    total FLOAT,
    CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE order_items(
    order_id INT,
    product_id INT,
    quantity INT,
    subtotal FLOAT,
    CONSTRAINT fk_product FOREIGN KEY (product_id) REFERENCES products(id),
    CONSTRAINT fk_order FOREIGN KEY (order_id) REFERENCES orders(id)
);

CREATE TABLE reviews(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    product_id INT,
    comment TEXT,
    create_at DATE,
    punctuation int,
    CONSTRAINT fk_user_review FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT fk_product_review FOREIGN KEY (product_id) REFERENCES products(id)
);
