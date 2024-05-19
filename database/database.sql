PRAGMA FOREIGN_KEYS = ON;

DROP TABLE IF EXISTS Adm;
DROP TABLE IF EXISTS Cart;
DROP TABLE IF EXISTS Wishlist;
DROP TABLE IF EXISTS Messages;
DROP TABLE IF EXISTS Proposal;
DROP TABLE IF EXISTS Transact;
DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS Type_;
DROP TABLE IF EXISTS Condition;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Order_;

/*******************************************************************************
   Create Tables
********************************************************************************/

CREATE TABLE User 
(
    UserID INTEGER PRIMARY KEY,
    RealName NVARCHAR(60) NOT NULL,
    Username NVARCHAR(60) NOT NULL,
    Password NVARCHAR(60) NOT NULL,
    Email NVARCHAR(60) NOT NULL,
    ImageUrl NVARCHAR(60) NOT NULL,
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

CREATE TABLE Size
(
    SizeID INTEGER NOT NULL,
    SizeName NVARCHAR(60) NOT NULL,
    CategoryID INTEGER NOT NULL,
    CONSTRAINT PK_Size PRIMARY KEY (SizeID),
    CONSTRAINT FK_Size_Category FOREIGN KEY (CategoryID)
        REFERENCES Category (CategoryID)
);


CREATE TABLE Condition
(
    ConditionID INTEGER NOT NULL,
    ConditionName NVARCHAR(60) NOT NULL,
    CONSTRAINT PK_Condition PRIMARY KEY (ConditionID)
);

CREATE TABLE Item
(
    ItemID INTEGER PRIMARY KEY,
    UserID INTEGER NOT NULL,
    CategoryID INTEGER NOT NULL,
    TypeID INTEGER NOT NULL,
    ItemName NVARCHAR(60) NOT NULL,
    Brand NVARCHAR(60) NOT NULL,
    Dimension NVARCHAR(60),
    Detail NVARCHAR(60) NOT NULL,
    Color NVARCHAR(60) NOT NULL,
    ImageUrl NVARCHAR(60) NOT NULL,
    Condition NVARCHAR(60) NOT NULL,
    Price REAL NOT NULL,
    IsSold INTEGER NOT NULL CHECK (IsSold IN (0, 1)),
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
    TransactionDate TIMESTAMP,
    CONSTRAINT PK_Transaction PRIMARY KEY (TransactionId),
    FOREIGN KEY (SellerId) REFERENCES User (UserID)
        ON DELETE CASCADE ON UPDATE NO ACTION,
    FOREIGN KEY (BuyerId) REFERENCES User (UserID)
        ON DELETE CASCADE ON UPDATE NO ACTION,
    FOREIGN KEY (ItemID) REFERENCES Item (ItemID)
        ON DELETE CASCADE ON UPDATE NO ACTION
);

CREATE TABLE Proposal 
(
    ProposalID INTEGER,
    ItemID INTEGER NOT NULL,
    BuyerID INTEGER NOT NULL,
    Price REAL NOT NULL,
    CurrentState INTEGER NOT NULL CHECK (CurrentState IN (0, 1, 2)),
    CONSTRAINT PK_Proposal PRIMARY KEY (ProposalID),
    FOREIGN KEY (ItemID) REFERENCES Item (ItemID)
        ON DELETE CASCADE ON UPDATE NO ACTION,
    FOREIGN KEY (BuyerId) REFERENCES User (UserID)
        ON DELETE CASCADE ON UPDATE NO ACTION
);

CREATE TABLE Messages 
(
    MessageID INTEGER,
    SenderID INTEGER NOT NULL,
    ReceiverID INTEGER NOT NULL,
    Content TEXT,
    Timestamp TIMESTAMP,
    ProposalID INTEGER,
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

CREATE TABLE Order_
(
    OrderID INTEGER,
    UserID INTEGER NOT NULL,
    ShippingName NVARCHAR(60) NOT NULL,
    ShippingLastName NVARCHAR(60) NOT NULL,
    ShippingTaxID NVARCHAR(60) NOT NULL,
    ShippingCountry NVARCHAR(60) NOT NULL,
    ShippingAddress NVARCHAR(255) NOT NULL,
    ShippingCity NVARCHAR(60) NOT NULL,
    ShippingState NVARCHAR(60) NOT NULL,
    ShippingPostalCode NVARCHAR(20) NOT NULL,
    ShippingPhone NVARCHAR(20) NOT NULL,
    PaymentOption NVARCHAR(60) NOT NULL,
    TotalAmount REAL NOT NULL,
    OrderDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT PK_Order PRIMARY KEY (OrderID),
    FOREIGN KEY (UserID) REFERENCES User (UserID)
        ON DELETE CASCADE ON UPDATE NO ACTION
);
/*******************************************************************************
   Create Trigger
********************************************************************************/

CREATE TRIGGER remove_item_from_cart
AFTER UPDATE OF isSold ON Item
WHEN NEW.isSold = 1
BEGIN
    DELETE FROM Cart WHERE ItemID = NEW.ItemID;
    DELETE FROM Wishlist WHERE ItemID = NEW.ItemID;
END;

/*******************************************************************************
   Create Foreign Keys
********************************************************************************/

CREATE INDEX IFK_ItemUserID ON Item (UserID);

CREATE INDEX IFK_ItemCategoryID ON Category (CategoryID);

CREATE INDEX IFK_ItemTypeID ON Type_ (TypeID);

CREATE INDEX IFK_ItemConditionID ON Condition (ConditionID);

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

CREATE INDEX IFK_OrderUserID ON Order_ (UserID);

/*******************************************************************************
   Populate Tables
********************************************************************************/

INSERT INTO Category (CategoryID, CategoryName) VALUES (1, 'Women');
INSERT INTO Category (CategoryID, CategoryName) VALUES (2, 'Men');
INSERT INTO Category (CategoryID, CategoryName) VALUES (3, 'Kids');
INSERT INTO Category (CategoryID, CategoryName) VALUES (4, 'Baby');

INSERT INTO Type_ (TypeID, TypeName) VALUES (1, 'Jeans');
INSERT INTO Type_ (TypeID, TypeName) VALUES (2, 'Trousers');
INSERT INTO Type_ (TypeID, TypeName) VALUES (3, 'Tops');
INSERT INTO Type_ (TypeID, TypeName) VALUES (4, 'T-shirts');
INSERT INTO Type_ (TypeID, TypeName) VALUES (5, 'Dresses');
INSERT INTO Type_ (TypeID, TypeName) VALUES (6, 'Skirts');
INSERT INTO Type_ (TypeID, TypeName) VALUES (7, 'Jackets');
INSERT INTO Type_ (TypeID, TypeName) VALUES (8, 'Sweatshirts');
INSERT INTO Type_ (TypeID, TypeName) VALUES (9, 'Shirts');
INSERT INTO Type_ (TypeID, TypeName) VALUES (10, 'Shorts');
INSERT INTO Type_ (TypeID, TypeName) VALUES (11, 'Swimwear');
INSERT INTO Type_ (TypeID, TypeName) VALUES (12, 'Activewear');
INSERT INTO Type_ (TypeID, TypeName) VALUES (13, 'Shoes');
INSERT INTO Type_ (TypeID, TypeName) VALUES (14, 'Accessories');

INSERT INTO Condition (ConditionID, ConditionName) VALUES (1, 'Brand New with Tags');
INSERT INTO Condition (ConditionID, ConditionName) VALUES (2, 'Like New');
INSERT INTO Condition (ConditionID, ConditionName) VALUES (3, 'Very Good');
INSERT INTO Condition (ConditionID, ConditionName) VALUES (4, 'Good');
INSERT INTO Condition (ConditionID, ConditionName) VALUES (5, 'Fair');
INSERT INTO Condition (ConditionID, ConditionName) VALUES (6, 'Poor');


INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (1, 'XXL', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (2, 'XL', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (3, 'L', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (4, 'M', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (5, 'S', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (6, 'XS', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (7, 'XXS', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (8, '37', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (9, '38', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (10, '39', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (11, '40', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (12, '41', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (13, '42', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (14, '43', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (15, '44', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (16, '45', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (17, '46', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (18, '47', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (19, '48', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (20, '49', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (21, '50', 1);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (22, 'XXL', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (23, 'XL', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (24, 'L', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (25, 'M', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (26, 'S', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (27, 'XS', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (28, 'XXS', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (29, '37', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (30, '38', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (31, '39', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (32, '40', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (33, '41', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (34, '42', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (35, '43', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (36, '44', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (37, '45', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (38, '46', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (39, '47', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (40, '48', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (41, '49', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (42, '50', 2);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (43, '2-3 years', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (44, '3-4 years', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (45, '4-5 years', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (46, '5-6 years', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (47, '6-7 years', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (48, '7-8 years', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (49, '9-10 years', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (50, '10-11 years', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (51, '11-12 years', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (52, '12-13 years', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (53, '13-14 years', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (54, '14-15 years', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (55, '15-16 years', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (56, '23', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (57, '24', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (58, '25', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (59, '26', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (60, '27', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (61, '28', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (62, '30', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (63, '31', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (64, '32', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (65, '33', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (66, '34', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (67, '35', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (68, '36', 3);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (69, '0-3 months', 4);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (70, '3-6 months', 4);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (71, '6-9 months', 4);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (72, '9-12 months', 4);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (73, '12-18 months', 4);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (74, '18-24 months', 4);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (75, '15', 4);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (76, '16', 4);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (77, '17', 4);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (78, '18', 4);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (79, '19', 4);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (80, '20', 4);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (81, '21', 4);
INSERT INTO Size (SizeID, SizeName, CategoryID) VALUES (82, '22', 4);


INSERT INTO User (RealName, Username, Password, Email, ImageUrl, IsAdmin) VALUES
                ('Afonso Machado', 'vinagbot', '$2y$10$8ZZcI9whijiBY5Z.NfuBL.0R4n.OX9YtHmrgsGvpaHTZ6h4yR/5eK', 'up202207611@up.pt', 'https://picsum.photos/seed/picsum/200/300', '0');
INSERT INTO User (RealName, Username, Password, Email, ImageUrl, IsAdmin) VALUES
                ('Teste1', '11', '$2y$10$emMkou1DFCyjun4hTrcmmuAvmPrP7BwLiUV3MN.JdBqRAAbl7YKAe', '11@gmail.com', 'https://picsum.photos/seed/picsum/200/300','0');
INSERT INTO User (RealName, Username, Password, Email, ImageUrl, IsAdmin) VALUES
                ('Teste2', '12', '$2y$10$4sY6lqqqq1niz72c8x5RLObiJpKorx9E2w775y0SXeZq70jaPofeO', '12@gmail.com', 'https://picsum.photos/seed/picsum/200/300', '1');

INSERT INTO Item (UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Color, ImageURL, Condition, Price, IsSold) VALUES (1, 1, 1, 'Zara Summer Dress', 'Zara', 'M', 'Beautiful summer dress in floral pattern.', 'brown', 'https://picsum.photos/200/300', 'Like New', 30.00, 0);
INSERT INTO Item (UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Color, ImageURL, Condition, Price, IsSold) VALUES (2, 2, 2, 'Air Max Nike', 'Nike', '42', 'Classic Nike Air Max shoes in black and white.', 'red', 'https://picsum.photos/200/300', 'Like New', 80.00, 0);
INSERT INTO Item (UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Color, ImageURL, Condition, Price, IsSold) VALUES (3, 1, 3, 'Leather Tote', 'Coach', 'M', 'Elegant leather tote bag with spacious compartments.', 'blue', 'https://picsum.photos/200/300', 'Like New', 150.00, 0);
INSERT INTO Item (UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Color, ImageURL, Condition, Price, IsSold) VALUES (1, 4, 11, 'Blanket', 'IKEA', 'M', 'IKEA VINTER 2023 throw blanket in festive design.', 'green', 'https://picsum.photos/200/300', 'Like New', 19.99, 0);
INSERT INTO Item (UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Color, ImageURL, Condition, Price, IsSold) VALUES (2, 4, 12, 'Microfiber sheet', 'AmazonBasics', 'Queen', 'AmazonBasics microfiber sheet set for queen-Dimensiond bed.', 'orange', 'https://picsum.photos/200/300', 'Like New', 24.99, 0);
INSERT INTO Item (UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Color, ImageURL, Condition, Price, IsSold) VALUES (3, 4, 13, 'Dinnerware set 16-piece', 'Corelle', '16-Piece', 'Corelle Winter Frost White dinnerware set, 16-piece.', 'purple', 'https://picsum.photos/200/300', 'Like New', 39.99, 0);
INSERT INTO Item (UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Color, ImageURL, Condition, Price, IsSold) VALUES (3, 4, 13, 'Dinnerware set 16-piece', 'Corelle', '16-Piece', 'Corelle Winter Frost White dinnerware set, 16-piece.', 'purple', 'https://picsum.photos/200/300', 'Like New', 39.99, 0);
INSERT INTO Item (UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Color, ImageURL, Condition, Price, IsSold) VALUES (3, 4, 13, 'Dinnerware set 16-piece', 'Corelle', '16-Piece', 'Corelle Winter Frost White dinnerware set, 16-piece.', 'purple', 'https://picsum.photos/200/300', 'Like New', 39.99, 0);
INSERT INTO Item (UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Color, ImageURL, Condition, Price, IsSold) VALUES (3, 4, 13, 'Dinnerware set 16-piece', 'Corelle', '16-Piece', 'Corelle Winter Frost White dinnerware set, 16-piece.', 'purple', 'https://picsum.photos/200/300', 'Like New', 39.99, 0);
INSERT INTO Item (UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Color, ImageURL, Condition, Price, IsSold) VALUES (3, 4, 13, 'Dinnerware set 16-piece', 'Corelle', '16-Piece', 'Corelle Winter Frost White dinnerware set, 16-piece.', 'purple', 'https://picsum.photos/200/300', 'Like New', 39.99, 0);
INSERT INTO Item (UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Color, ImageURL, Condition, Price, IsSold) VALUES (3, 4, 13, 'Dinnerware set 16-piece', 'Corelle', '16-Piece', 'Corelle Winter Frost White dinnerware set, 16-piece.', 'purple', 'https://picsum.photos/200/300', 'Like New', 39.99, 0);
/*INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Price, ImageURL, IsSold) VALUES (4, 4, 2, 4, 'Sunglasses Ray-Ban', 'Ray-Ban', 'Aviator Sunglasses', 'M', 'New with Tags', 'Classic aviator sunglasses with polarized lenses.', 120.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQaEypjRH4jLX4e2szxP-vRHHFUx4N-43PKsgcQUQLGkg&s', 0);
INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Price, ImageURL, IsSold) VALUES (5, 5, 1, 5, 'Foundation', 'LOréal', 'True Match Foundation', 'M', 'New', 'LOréal True Match foundation in shade N3.', 12.99, 'https://static.beautytocare.com/cdn-cgi/image/width=1600,height=1600,f=auto/media/catalog/product//l/-/l-oreal-paris-true-match-foundation-3-d-3-w-golden-beige-30ml.jpg', 0);
INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Price, ImageURL, IsSold) VALUES (6, 6, 3, 6, 'New gillette fusion', 'Gillette', 'Fusion5 ProGlide Razor', 'M', 'New in Box', 'Gillette Fusion5 ProGlide razor with FlexBall technology.', 19.99, 'https://cdn11.bigcommerce.com/s-79bvd/images/stencil/2048x2048/products/12439/23764/s-l1600__62569.1500877243.jpg?c=2', 0);
INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Price, ImageURL, IsSold) VALUES (7, 7, 3, 7, 'Amazing harry potter lego', 'LEGO', 'Harry Potter Hogwarts Castle', 'M', 'New', 'LEGO Harry Potter Hogwarts Castle set with minifigures.', 199.99, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4Fb7sNSareJuK0r2sRPxlc4LCqN4PLfE5ztN4jd_X7A&s', 0);
INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Price, ImageURL, IsSold) VALUES (8, 8, 3, 8, 'Good quality diapers', 'Pampers', 'Swaddlers Diapers', 'Newborn', 'New', 'Pampers Swaddlers diapers for newborns, pack of 72.', 24.99, 'https://i5.walmartimages.com/seo/Pampers-Swaddlers-Diapers-Dimension-6-72-Count_768f66a7-cf53-417f-aa21-a03ecac9250f.c5a4f688582f70b98ef76bcfba3b8a2d.jpeg', 0);
INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Price, ImageURL, IsSold) VALUES (9, 9, 3, 9, 'Stroller Graco', 'Graco', 'Modes Click Connect Stroller', 'M', 'Like New', 'Graco Modes Click Connect stroller with multiple riding options.', 149.99, 'https://m.media-amazon.com/images/I/81U9XN+AgSL.jpg', 0);
INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Price, ImageURL, IsSold) VALUES (10, 10, 3, 10, 'Crayola pencils', 'Crayola', 'Colored Pencils', 'M', 'New', 'Crayola colored pencils pack of 24.', 4.99, 'https://m.media-amazon.com/images/I/71I5BZfd3YL.jpg', 0);
INSERT INTO Item (ItemID, UserID, CategoryID, TypeID, ItemName, Brand, Dimension, Detail, Price, ImageURL, IsSold) VALUES (14, 4, 4, 14, 'Birthday kit', 'Party City', 'Birthday Party Decorations Kit', 'M', 'New', 'Party City birthday party decorations kit.', 29.99, 'https://cdn.media.amplience.net/i/partycity/898725?$large$&fmt=auto&qlt=default', 0); */

/*INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (3, 1, 2, 1, '2024-03-05', 0);
INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (4, 1, 2, 11, '2024-03-10', 1);
INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (7, 2, 3, 2, '2024-03-25', 1);
INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (8, 2, 3, 12, '2024-03-30', 0);
INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (9, 3, 1, 3, '2024-04-05', 1);
INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (10, 3, 1, 13, '2024-04-10', 0);*/
/*INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (5, 4, 5, 8, '2024-03-15', 0);
INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (6, 4, 5, 14, '2024-03-20', 1);
INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (11, 5, 4, 2, '2024-04-15', 1);
INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (12, 5, 4, 3, '2024-04-20', 0);*/


/*INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (1, 1, 2, 'Hi, I see you are interested in my item. Let me know if you have any questions!', '2024-03-04 14:30:00');
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (2, 2, 1, 'Hi, yes, Im interested. Can you tell me more about th of the item?', '2024-03-05 09:15:00');
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (3, 1, 2, 'Sure, its in grea. Hardly worn. Would you like to see more pictures?', '2024-03-06 11:45:00');
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (4, 2, 1, 'Yes, that would be helpful. Could you send them over?', '2024-03-07 13:20:00');
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (5, 1, 2, 'Thanks for the purchase! I ll ship the item tomorrow.', '2024-03-11 10:00:00');
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (6, 2, 1, 'Great, looking forward to it!', '2024-03-12 09:30:00');
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (11, 1, 3, 'Hi, I see you re interested in my item. Let me know if you have any questions!', '2024-03-26 12:20:00');
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (12, 3, 2, 'Hello! Yes, Im interested. Can you provide more details about the item?', '2024-03-27 10:15:00');*/
/*INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (7, 4, 5, 'Hi, I noticed you re interested in my item. Are you still considering it?', '2024-03-14 16:45:00');
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (8, 5, 4, 'Yes, Im still interested. Could you provide more details about it?', '2024-03-15 08:00:00');
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (9, 4, 5, 'Congratulations on your purchase! I ll have it shipped to you shortly.', '2024-03-21 11:10:00');
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (10, 5, 4, 'Thank you! Looking forward to receiving it.', '2024-03-22 09:45:00');*/

/*INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (1, 1, 12);
INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (2, 1, 2);
INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (3, 2, 3);
INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (4, 2, 13);
INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (5, 3, 1);
INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (6, 3, 11);*/
/*INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (7, 4, 10);
INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (8, 4, 11);
INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (9, 5, 8);
INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (10, 5, 12);*/

/*INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (1, 1, 2, 1); 
INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (2, 1, 12, 2);
INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (3, 2, 3, 1);
INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (4, 2, 13, 3);
INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (5, 3, 1, 2);
INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (6, 3, 11, 1);*/
/*INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (7, 4, 10, 4);
INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (8, 4, 11, 2);
INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (9, 5, 8, 1);
INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (10, 5, 12, 1); */

