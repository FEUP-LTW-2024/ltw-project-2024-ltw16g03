PRAGMA FOREIGN_KEYS = ON;

DROP TABLE IF EXISTS Adm;
DROP TABLE IF EXISTS Cart;
DROP TABLE IF EXISTS Wishlist;
DROP TABLE IF EXISTS Messages;
DROP TABLE IF EXISTS Transact;
DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS Type_;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS User;

/*******************************************************************************
   Create Tables
********************************************************************************/

CREATE TABLE User 
(
    UserID INTEGER PRIMARY KEY AUTOINCREMENT,
    RealName NVARCHAR(60) NOT NULL,
    Username NVARCHAR(60) NOT NULL,
    Password NVARCHAR(60) NOT NULL,
    Email NVARCHAR(60) NOT NULL,
    IsAdmin INTEGER NOT NULL CHECK (IsAdmin IN (0, 1))
);

CREATE TABLE Category 
(
    CategoryID INTEGER NOT NULL,
    CategoryName NVARCHAR(60) NOT NULL,
    CONSTRAINT PK_Category PRIMARY KEY (CategoryID)
);

CREATE TABLE Type_
(
    TypeID INTEGER NOT NULL,
    TypeName NVARCHAR(60) NOT NULL,
    CONSTRAINT PK_Type PRIMARY KEY (TypeID)
);

CREATE TABLE Item
(
    ItemID INTEGER NOT NULL,
    UserID INTEGER NOT NULL,
    CategoryID INTEGER NOT NULL,
    TypeID INTEGER NOT NULL,
    ItemName NVARCHAR(60) NOT NULL,
    Brand NVARCHAR(60) NOT NULL,
    Model NVARCHAR(60) NOT NULL,
    Dimension NVARCHAR(60) NOT NULL,
    Condition NVARCHAR(60) NOT NULL,
    Detail NVARCHAR(60) NOT NULL,
    Color NVARCHAR(60) NOT NULL,
    Price REAL NOT NULL,
    ImageURL NVARCHAR(255),
    IsSold INTEGER NOT NULL CHECK (IsSold IN (0, 1)),
    CONSTRAINT PK_Item PRIMARY KEY (ItemID),
    FOREIGN KEY (UserID) REFERENCES User (UserID)
        ON DELETE CASCADE ON UPDATE NO ACTION,
    FOREIGN KEY (CategoryID) REFERENCES Category(CategoryID)
        ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (TypeID) REFERENCES Type_ (TypeID)
        ON DELETE NO ACTION ON UPDATE NO ACTION
);


CREATE TABLE Transact 
(
    TransactionID INTEGER NOT NULL,
    SellerID INTEGER NOT NULL, 
    BuyerID INTEGER NOT NULL,
    ItemID INTEGER NOT NULL,
    TransactionDate DATE,
    IsComplete INTEGER NOT NULL CHECK (IsComplete IN (0, 1)),
    CONSTRAINT PK_Transaction PRIMARY KEY (TransactionId),
    FOREIGN KEY (SellerId) REFERENCES User (UserID)
        ON DELETE CASCADE ON UPDATE NO ACTION,
    FOREIGN KEY (BuyerId) REFERENCES User (UserID)
        ON DELETE CASCADE ON UPDATE NO ACTION,
    FOREIGN KEY (ItemID) REFERENCES Item (ItemID)
        ON DELETE CASCADE ON UPDATE NO ACTION
);

CREATE TABLE Messages 
(
    MessageID INTEGER NOT NULL,
    SenderID INTEGER NOT NULL,
    ReceiverID INTEGER NOT NULL,
    Content TEXT,
    Timestamp TIMESTAMP,
    CONSTRAINT PK_Message PRIMARY KEY (MessageId),
    FOREIGN KEY (SenderId) REFERENCES User (UserID)
        ON DELETE CASCADE ON UPDATE NO ACTION,
    FOREIGN KEY (ReceiverId) REFERENCES User (UserID)
        ON DELETE CASCADE ON UPDATE NO ACTION
);

CREATE TABLE Wishlist
(
    WishlistID INTEGER,
    UserID INTEGER NOT NULL,
    ItemID INTEGER NOT NULL,
    CONSTRAINT PK_Wishlist PRIMARY KEY (WishlistId),
    FOREIGN KEY (UserID) REFERENCES User (UserID)
        ON DELETE CASCADE ON UPDATE NO ACTION,
    FOREIGN KEY (ItemID) REFERENCES Item (ItemID)
        ON DELETE CASCADE ON UPDATE NO ACTION
);

CREATE TABLE Cart
(
    CartID INTEGER,
    UserID INTEGER NOT NULL,
    ItemID INTEGER NOT NULL,
    Quantity INTEGER NOT NULL,
    CONSTRAINT PK_Cart PRIMARY KEY (CartId),
    FOREIGN KEY (UserID) REFERENCES User (UserID)
        ON DELETE CASCADE ON UPDATE NO ACTION,
    FOREIGN KEY (ItemID) REFERENCES Item (ItemID)
        ON DELETE CASCADE ON UPDATE NO ACTION
);

CREATE TABLE Adm
(
    AdminID INTEGER NOT NULL,
    UserID INTEGER NOT NULL,
    CONSTRAINT PK_Admin PRIMARY KEY (AdminId),
    FOREIGN KEY (UserID) REFERENCES User (UserID)
        ON DELETE CASCADE ON UPDATE NO ACTION
);

/*******************************************************************************
   Create Foreign Keys
********************************************************************************/

CREATE INDEX IFK_ItemUserID ON Item (UserID);

CREATE INDEX IFK_ItemCategoryID ON Category (CategoryID);

CREATE INDEX IFK_ItemTypeID ON Type_ (TypeID);

CREATE INDEX IFK_TransactSellerID ON Transact (SellerID);

CREATE INDEX IFK_TransactBuyerID ON Transact (BuyerID);

CREATE INDEX IFK_TransactItemID ON Transact (ItemID);

CREATE INDEX IFK_MessageSenderID ON Messages (SenderID);

CREATE INDEX IFK_MessageReceiverID ON Messages (ReceiverID);

CREATE INDEX IFK_WishlistUserID ON Wishlist (UserID);

CREATE INDEX IFK_WishlistItemID ON Wishlist (ItemID);

CREATE INDEX IFK_CartUserID ON Cart (UserID);

CREATE INDEX IFK_CartItemID ON Cart (ItemID);

CREATE INDEX IFK_AdmUserID ON Adm (UserID);

/*******************************************************************************
   Populate Tables
********************************************************************************/

INSERT INTO Category (CategoryID, CategoryName) VALUES (1, 'Women');
INSERT INTO Category (CategoryID, CategoryName) VALUES (2, 'Men');
INSERT INTO Category (CategoryID, CategoryName) VALUES (3, 'Kids');
INSERT INTO Category (CategoryID, CategoryName) VALUES (4, 'Home');

INSERT INTO Type_ (TypeID, TypeName) VALUES (1, 'Clothing');
INSERT INTO Type_ (TypeID, TypeName) VALUES (2, 'Shoes');
INSERT INTO Type_ (TypeID, TypeName) VALUES (3, 'Bags');
INSERT INTO Type_ (TypeID, TypeName) VALUES (4, 'Accessories');
INSERT INTO Type_ (TypeID, TypeName) VALUES (5, 'Beauty');
INSERT INTO Type_ (TypeID, TypeName) VALUES (6, 'Grooming');
INSERT INTO Type_ (TypeID, TypeName) VALUES (7, 'Toys / Games');
INSERT INTO Type_ (TypeID, TypeName) VALUES (8, 'Baby care');
INSERT INTO Type_ (TypeID, TypeName) VALUES (9, 'Buggies');
INSERT INTO Type_ (TypeID, TypeName) VALUES (10, 'School supplies');
INSERT INTO Type_ (TypeID, TypeName) VALUES (11, 'Textiles');
INSERT INTO Type_ (TypeID, TypeName) VALUES (12, 'Home accessories');
INSERT INTO Type_ (TypeID, TypeName) VALUES (13, 'Tableware');
INSERT INTO Type_ (TypeID, TypeName) VALUES (14, 'Celebrations');

INSERT INTO User (RealName, Username, Password, Email, IsAdmin) VALUES
                ('Afonso Machado', 'vinagbot', '$2y$10$8ZZcI9whijiBY5Z.NfuBL.0R4n.OX9YtHmrgsGvpaHTZ6h4yR/5eK', 'up202207611@up.pt', '0');
INSERT INTO User (RealName, Username, Password, Email, IsAdmin) VALUES
                ('Teste1', '11', '$2y$10$emMkou1DFCyjun4hTrcmmuAvmPrP7BwLiUV3MN.JdBqRAAbl7YKAe', '11@gmail.com', '0');
INSERT INTO User (RealName, Username, Password, Email, IsAdmin) VALUES
                ('Teste2', '12', '$2y$10$4sY6lqqqq1niz72c8x5RLObiJpKorx9E2w775y0SXeZq70jaPofeO', '12@gmail.com', '0');

INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Model, Dimension, Condition, Detail, Color, Price, ImageURL, IsSold) VALUES (1, 1, 1, 1, 'Zara Summer Dress', 'Zara', 'Summer Dress', 'M', 'New', 'Beautiful summer dress in floral pattern.', 'brown', 30.00, 'https://m.media-amazon.com/images/I/71I5BZfd3YL.jpg', 0);
INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Model, Dimension, Condition, Detail, Color, Price, ImageURL, IsSold) VALUES (2, 2, 2, 2, 'Air Max Nike', 'Nike', 'Air Max', '42', 'Used', 'Classic Nike Air Max shoes in black and white.', 'red', 80.00, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/wzitsrb4oucx9jukxsmc/air-max-90-mens-shoes-6n3vKB.png', 0);
INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Model, Dimension, Condition, Detail, Color, Price, ImageURL, IsSold) VALUES (3, 3, 1, 3, 'Leather Tote', 'Coach', 'Leather Tote', 'M', 'Like New', 'Elegant leather tote bag with spacious compartments.', 'blue', 150.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRN6oGzmeKJiu1n6-SaxavaVp_0c6OLIxqd4q3YtU-hhw&s', 0);
INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Model, Dimension, Condition, Detail, Color, Price, ImageURL, IsSold) VALUES (11, 1, 4, 11, 'Blanket', 'IKEA', 'VINTER 2023 Throw', 'M', 'New', 'IKEA VINTER 2023 throw blanket in festive design.', 'green', 19.99, 'https://www.ikea.com/kr/en/images/products/vinterfint-throw-red__1249177_ph194559_s5.jpg', 0);
INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Model, Dimension, Condition, Detail, Color, Price, ImageURL, IsSold) VALUES (12, 2, 4, 12, 'Microfiber sheet', 'AmazonBasics', 'Microfiber Sheet Set', 'Queen', 'New', 'AmazonBasics microfiber sheet set for queen-Dimensiond bed.', 'orange', 24.99, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSLxJxQQE5ROH1vZaT68edJwHx2LiB1kDuR9jFqHzQHhA&s', 0);
INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Model, Dimension, Condition, Detail, Color, Price, ImageURL, IsSold) VALUES (13, 3, 4, 13, 'Dinnerware set 16-piece', 'Corelle', 'Winter Frost White Dinnerware Set', '16-Piece', 'New', 'Corelle Winter Frost White dinnerware set, 16-piece.', 'purple', 39.99, 'https://images.thdstatic.com/productImages/6bfe53a3-0d2b-41f8-81f4-c679b5405f5a/svn/white-corelle-dinnerware-sets-1148417-64_600.jpg', 0);
/*INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Model, Dimension, Condition, Detail, Price, ImageURL, IsSold) VALUES (4, 4, 2, 4, 'Sunglasses Ray-Ban', 'Ray-Ban', 'Aviator Sunglasses', 'M', 'New with Tags', 'Classic aviator sunglasses with polarized lenses.', 120.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQaEypjRH4jLX4e2szxP-vRHHFUx4N-43PKsgcQUQLGkg&s', 0);
INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Model, Dimension, Condition, Detail, Price, ImageURL, IsSold) VALUES (5, 5, 1, 5, 'Foundation', 'LOréal', 'True Match Foundation', 'M', 'New', 'LOréal True Match foundation in shade N3.', 12.99, 'https://static.beautytocare.com/cdn-cgi/image/width=1600,height=1600,f=auto/media/catalog/product//l/-/l-oreal-paris-true-match-foundation-3-d-3-w-golden-beige-30ml.jpg', 0);
INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Model, Dimension, Condition, Detail, Price, ImageURL, IsSold) VALUES (6, 6, 3, 6, 'New gillette fusion', 'Gillette', 'Fusion5 ProGlide Razor', 'M', 'New in Box', 'Gillette Fusion5 ProGlide razor with FlexBall technology.', 19.99, 'https://cdn11.bigcommerce.com/s-79bvd/images/stencil/2048x2048/products/12439/23764/s-l1600__62569.1500877243.jpg?c=2', 0);
INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Model, Dimension, Condition, Detail, Price, ImageURL, IsSold) VALUES (7, 7, 3, 7, 'Amazing harry potter lego', 'LEGO', 'Harry Potter Hogwarts Castle', 'M', 'New', 'LEGO Harry Potter Hogwarts Castle set with minifigures.', 199.99, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4Fb7sNSareJuK0r2sRPxlc4LCqN4PLfE5ztN4jd_X7A&s', 0);
INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Model, Dimension, Condition, Detail, Price, ImageURL, IsSold) VALUES (8, 8, 3, 8, 'Good quality diapers', 'Pampers', 'Swaddlers Diapers', 'Newborn', 'New', 'Pampers Swaddlers diapers for newborns, pack of 72.', 24.99, 'https://i5.walmartimages.com/seo/Pampers-Swaddlers-Diapers-Dimension-6-72-Count_768f66a7-cf53-417f-aa21-a03ecac9250f.c5a4f688582f70b98ef76bcfba3b8a2d.jpeg', 0);
INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Model, Dimension, Condition, Detail, Price, ImageURL, IsSold) VALUES (9, 9, 3, 9, 'Stroller Graco', 'Graco', 'Modes Click Connect Stroller', 'M', 'Like New', 'Graco Modes Click Connect stroller with multiple riding options.', 149.99, 'https://m.media-amazon.com/images/I/81U9XN+AgSL.jpg', 0);
INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Model, Dimension, Condition, Detail, Price, ImageURL, IsSold) VALUES (10, 10, 3, 10, 'Crayola pencils', 'Crayola', 'Colored Pencils', 'M', 'New', 'Crayola colored pencils pack of 24.', 4.99, 'https://m.media-amazon.com/images/I/71I5BZfd3YL.jpg', 0);
INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Model, Dimension, Condition, Detail, Price, ImageURL, IsSold) VALUES (14, 4, 4, 14, 'Birthday kit', 'Party City', 'Birthday Party Decorations Kit', 'M', 'New', 'Party City birthday party decorations kit.', 29.99, 'https://cdn.media.amplience.net/i/partycity/898725?$large$&fmt=auto&qlt=default', 0); */

INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (3, 1, 2, 1, '2024-03-05', 0);
INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (4, 1, 2, 11, '2024-03-10', 1);
INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (7, 2, 3, 2, '2024-03-25', 1);
INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (8, 2, 3, 12, '2024-03-30', 0);
INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (9, 3, 1, 3, '2024-04-05', 1);
INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (10, 3, 1, 13, '2024-04-10', 0);
/*INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (5, 4, 5, 8, '2024-03-15', 0);
INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (6, 4, 5, 14, '2024-03-20', 1);
INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (11, 5, 4, 2, '2024-04-15', 1);
INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (12, 5, 4, 3, '2024-04-20', 0);*/

INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (1, 1, 2, 'Hi, I see you are interested in my item. Let me know if you have any questions!', '2024-03-04 14:30:00');
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (2, 2, 1, 'Hi, yes, Im interested. Can you tell me more about the condition of the item?', '2024-03-05 09:15:00');
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (3, 1, 2, 'Sure, its in great condition. Hardly worn. Would you like to see more pictures?', '2024-03-06 11:45:00');
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (4, 2, 1, 'Yes, that would be helpful. Could you send them over?', '2024-03-07 13:20:00');
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (5, 1, 2, 'Thanks for the purchase! I ll ship the item tomorrow.', '2024-03-11 10:00:00');
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (6, 2, 1, 'Great, looking forward to it!', '2024-03-12 09:30:00');
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (11, 2, 3, 'Hi, I see you re interested in my item. Let me know if you have any questions!', '2024-03-26 12:20:00');
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (12, 3, 2, 'Hello! Yes, Im interested. Can you provide more details about the item?', '2024-03-27 10:15:00');
/*INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (7, 4, 5, 'Hi, I noticed you re interested in my item. Are you still considering it?', '2024-03-14 16:45:00');
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (8, 5, 4, 'Yes, Im still interested. Could you provide more details about its condition?', '2024-03-15 08:00:00');
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (9, 4, 5, 'Congratulations on your purchase! I ll have it shipped to you shortly.', '2024-03-21 11:10:00');
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (10, 5, 4, 'Thank you! Looking forward to receiving it.', '2024-03-22 09:45:00');*/

INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (1, 1, 12);
INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (2, 1, 2);
INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (3, 2, 3);
INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (4, 2, 13);
INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (5, 3, 1);
INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (6, 3, 11);
/*INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (7, 4, 10);
INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (8, 4, 11);
INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (9, 5, 8);
INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (10, 5, 12);*/

INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (1, 1, 2, 1); 
INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (2, 1, 12, 2);
INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (3, 2, 3, 1);
INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (4, 2, 13, 3);
INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (5, 3, 1, 2);
INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (6, 3, 11, 1);
/*INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (7, 4, 10, 4);
INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (8, 4, 11, 2);
INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (9, 5, 8, 1);
INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (10, 5, 12, 1); */
INSERT INTO User (RealName, Username, Password, Email, IsAdmin) VALUES
                ('5050', '5050', '$2y$10$2jCcgZges46eaKeQGDkloejXQGqE23n/xYCfjdzshZ.cigmKxUxAq', '5050@gmail.com', '0');
INSERT INTO User (RealName, Username, Password, Email, IsAdmin) VALUES
                ('asd123', 'asd123', '$2y$10$ahR5Jz4H6DI9QC8/sgR/7ulIYii5kN/7XF8gVnVZ3beUNVKRBmtYS', 'asd123@gmail.com', '0');
INSERT INTO User (RealName, Username, Password, Email, IsAdmin) VALUES
                ('123asd', '123asd', '$2y$10$If4wYH4Xv6pa7288ysIsU.ziqLJdgho5EVaYxw.IgNi1gT2hbppj6', '123asd@gmail.com', '0');
INSERT INTO User (RealName, Username, Password, Email, IsAdmin) VALUES
                ('asdf123', 'asdf123', '$2y$10$lm3fVkV5Cek4zELN7M6ytOwm77u64KTwDXiDB1HwFFuPbeymwI/Ee', 'asdf123@gmail.com', '0');
