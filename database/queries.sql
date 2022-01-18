
#/////////////////////////////////STORE PROCEDURES/////////////////////////////////


# sign_up
DELIMITER $%
CREATE PROCEDURE sp_signup ( IN p_username VARCHAR(50), IN p_email VARCHAR(100), IN p_password VARCHAR(50) )
BEGIN

    INSERT INTO users 
    (username, email, password, rol) 
    VALUES (p_username, p_email, p_password, 0);

END $%
DELIMITER ;


# _login
DELIMITER $%
CREATE PROCEDURE sp_login (IN p_user VARCHAR(100), IN p_password VARCHAR(50))
BEGIN

    SELECT id, username, email, password, rol, image, extension 
    FROM users
    WHERE (email = p_user OR username = p_user) AND password = p_password;

END $%
DELIMITER ;


# add_product
DELIMITER $%
CREATE PROCEDURE sp_add_product (
    IN p_title VARCHAR(100),
    IN p_description TEXT,
    IN p_price FLOAT,
    IN p_quantity INT,
    IN p_category INT,
    IN p_image_name VARCHAR(100),
    IN p_image_extension VARCHAR(20)
)
BEGIN

    INSERT INTO products
    SET title       = p_title,
    description     = p_description,
    price           = p_price,
    quantity        = p_quantity,
    rating          = 0.0,
    image           = p_image_name,
    extension       = p_image_extension,
    create_at       = NOW(),
    category_id     = p_category;

END $%
DELIMITER ;


# get_all_products
DELIMITER $%
CREATE PROCEDURE sp_get_all_products ()
BEGIN

    SELECT 
    P.id,
    P.title, 
    P.description, 
    P.price, 
    P.quantity, 
    P.rating, 
    P.image, 
    P.extension, 
    P.create_at, 
    C.name 'category'
    FROM products P
    INNER JOIN categories C
    ON C.id = P.category_id;

END $%
DELIMITER ;


# get_products_by_category
DELIMITER $%
CREATE PROCEDURE sp_get_products_by_category( 
    IN p_category VARCHAR(100)
)
BEGIN

    SELECT 
    P.id,
    P.title, 
    P.description, 
    P.price, 
    P.quantity, 
    P.rating, 
    P.image, 
    P.extension, 
    P.create_at, 
    C.name 'category'
    FROM products P
    INNER JOIN categories C
    ON C.id = P.category_id
    WHERE C.name = p_category;

END $%
DELIMITER ;


# get_one_product
DELIMITER $%
CREATE PROCEDURE sp_get_one_product( 
    IN p_id INT
)
BEGIN

    SELECT 
    P.id,
    P.title, 
    P.description, 
    P.price, 
    P.quantity, 
    P.rating, 
    P.image, 
    P.extension, 
    P.create_at, 
    C.name 'category'
    FROM products P
    INNER JOIN categories C
    ON C.id = P.category_id
    WHERE P.id = p_id;

END $%
DELIMITER ;