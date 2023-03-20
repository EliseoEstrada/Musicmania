
# ========================== STORE PROCEDURES ==========================


# ========================== sign_up ==========================
DELIMITER $%
CREATE PROCEDURE sp_signup ( 
    IN p_username VARCHAR(50), 
    IN p_email VARCHAR(100), 
    IN p_password VARCHAR(50) 
)
BEGIN

    INSERT INTO users 
    (username, email, password) 
    VALUES (p_username, p_email, p_password);

END $%
DELIMITER ;


# ========================== login ========================== 
DELIMITER $%
CREATE PROCEDURE sp_login (
    IN p_user VARCHAR(100), 
    IN p_password VARCHAR(50)
)
BEGIN

    SELECT id, username, email, password, address, image, extension 
    FROM users
    WHERE (email = p_user OR username = p_user) AND password = p_password;

END $%
DELIMITER ;


# ========================== update_user_data ========================== 
DELIMITER $%
CREATE PROCEDURE sp_update_user_data ( 
    IN p_id INT,
    IN p_username VARCHAR(50), 
    IN p_email VARCHAR(100), 
    IN p_address VARCHAR(500) 
)
BEGIN

    UPDATE users 
    SET username = p_username,
        email    = p_email,
        address  = p_address
    WHERE id = p_id;

END $%
DELIMITER ;

# ========================== update_user_image ========================== 
DELIMITER $%
CREATE PROCEDURE sp_update_user_image ( 
    IN p_id INT,
    IN p_image_name VARCHAR(100),
    IN p_image_extension VARCHAR(20)
)
BEGIN

    UPDATE users 
    SET image       = p_image_name,
        extension   = p_image_extension
    WHERE id = p_id;

END $%
DELIMITER ;

# ========================== update_user_password ========================== 
DELIMITER $%
CREATE PROCEDURE sp_update_user_password ( 
    IN p_id INT,
    IN p_password VARCHAR(50)
)
BEGIN

    UPDATE users 
    SET password = p_password
    WHERE id = p_id;

END $%
DELIMITER ;



# ========================== add_product ========================== 
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


# ========================== get_all_products ========================== 
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


# ========================== get_products_by_category ========================== 
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

# ========================== get_products_by_title ========================== 
DELIMITER $%
CREATE PROCEDURE sp_get_products_by_title( 
    IN p_title TEXT
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
    WHERE P.title LIKE CONCAT('%',p_title,'%');

END $%
DELIMITER ;


# ========================== get_one_product ========================== 
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



# ========================== create_order ========================== 
DELIMITER $%
CREATE PROCEDURE sp_create_order( 
    IN p_user_id INT,
    IN p_total FLOAT
)
BEGIN

    INSERT INTO Orders
    SET user_id     = p_user_id,
    create_at       = NOW(),
    total           = p_total;

    SELECT LAST_INSERT_ID();

END $%
DELIMITER ;

# ========================== add_items_by_order ========================== 
DELIMITER $%
CREATE PROCEDURE sp_add_item_order( 
    IN p_order_id INT,
    IN p_product_id INT,
    IN p_quantity INT,
    IN p_subtotal FLOAT
)
BEGIN

    INSERT INTO order_items
    SET order_id    = p_order_id,
    product_id      = p_product_id,
    quantity        = p_quantity,
    subtotal        = p_subtotal;

END $%
DELIMITER ;


# ========================== get_orders_by_userId ========================== 
DELIMITER $%
CREATE PROCEDURE sp_get_orders_by_user( 
    IN p_id INT
)
BEGIN

    SELECT 
    O.id,
    DATE_FORMAT(O.create_at, '%d/%m/%Y - %H:%i') create_at, 
    O.total
    FROM orders O
    INNER JOIN users U
    ON O.user_id = U.id
    WHERE O.user_id = p_id;

END $%
DELIMITER ;


# ========================== get_products_orders_by_id ========================== 
DELIMITER $%
CREATE PROCEDURE sp_get_products_orders_by_id( 
    IN p_idUser INT,
    IN p_idProduct INT
)
BEGIN
    SELECT 
    OI.product_id 
    FROM orders O
    INNER JOIN order_items OI 
    ON O.id = OI.order_id
    WHERE O.user_id = p_idUser AND OI.product_id = p_idProduct
    GROUP BY OI.product_id;
 
END $%
DELIMITER ;


# ========================== add_review ========================== 
DELIMITER $%
CREATE PROCEDURE sp_add_review (
    IN p_user_id INT,
    IN p_product_id INT,
    IN p_comment TEXT,
    IN p_punctuation INT
)
BEGIN

    INSERT INTO reviews
    SET user_id   = p_user_id,
    product_id    = p_product_id,
    comment       = p_comment,
    punctuation   = p_punctuation,
    create_at     = NOW();

END $%
DELIMITER ;


# ========================== get_all_reviews ========================== 
DELIMITER $%
CREATE PROCEDURE sp_get_all_reviews (
    IN p_product_id INT
)
BEGIN

    SELECT 
        R.id,
        R.comment,
        R.create_at,
        R.punctuation,
        U.username,
        U.image
    FROM reviews R
    INNER JOIN users U
    ON R.user_id = U.id
    WHERE R.product_id = p_product_id;

END $%
DELIMITER ;
