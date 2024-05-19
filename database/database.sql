PRAGMA FOREIGN_KEYS = ON;

DROP TABLE IF EXISTS Order_;
DROP TABLE IF EXISTS Adm;
DROP TABLE IF EXISTS Cart;
DROP TABLE IF EXISTS Wishlist;
DROP TABLE IF EXISTS Messages;
DROP TABLE IF EXISTS Proposal;
DROP TABLE IF EXISTS Transact;
DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS Condition;
DROP TABLE IF EXISTS Size;
DROP TABLE IF EXISTS Type_;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS User;

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
