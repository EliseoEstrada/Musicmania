INSERT INTO Categories SET name = 'Joyeria';
INSERT INTO Categories SET name = 'Ropa';
INSERT INTO Categories SET name = 'Decoracion';
INSERT INTO Categories SET name = 'Accesorios';
INSERT INTO Categories SET name = 'Hogar';
INSERT INTO Categories SET name = 'Oficina';
INSERT INTO Categories SET name = 'Otros';



CREATE TABLE users(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE,
    email VARCHAR(100),
    password VARCHAR(50),
    rol TINYINT,
    image VARCHAR(100),
    extension VARCHAR(20)
);


#/////////////////////////////////STORE PROCEDURES;

# _SIGNUP
DELIMITER $%
CREATE PROCEDURE sp_signup ( IN p_username VARCHAR(50), IN p_email VARCHAR(100), IN p_password VARCHAR(50) )
BEGIN
    INSERT INTO users 
    (username, email, password, rol) 
    VALUES (p_username, p_email, p_password, 0);
END $%
DELIMITER ;


# _LOGIN
DELIMITER $%
CREATE PROCEDURE sp_login (IN p_email VARCHAR(100), IN p_password VARCHAR(50))
BEGIN
    SELECT id, username, email, password, rol, image, extension 
    FROM users
    WHERE email = p_email AND password = p_password;
END $%
DELIMITER ;

# _ADDPRODUCT
DELIMITER $%
CREATE PROCEDURE sp_addProduct (
    IN p_title VARCHAR(100),
    IN p_description TEXT,
    IN p_price FLOAT,
    IN p_amount INT,
    IN p_category INT,
    IN p_imageName VARCHAR(100),
    IN p_imageExtension VARCHAR(20)
)
BEGIN
    INSERT INTO products
    (title, description, price, amount, rating, image, extension, create_at, category_id)
    VALUES 
    (p_title, p_description, p_price, p_amount, 0.0, p_imageName, p_imageExtension, NOW(), p_category);
END $%
DELIMITER ;