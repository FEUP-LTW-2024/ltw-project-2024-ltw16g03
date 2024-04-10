DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Transact;
DROP TABLE IF EXISTS Messages;
DROP TABLE IF EXISTS Wishlist;
DROP TABLE IF EXISTS Cart;
DROP TABLE IF EXISTS Adm;

/*******************************************************************************
   Create Tables
********************************************************************************/

CREATE TABLE User 
(
    UserID INTEGER NOT NULL,
    Username NVARCHAR(60) NOT NULL,
    Password NVARCHAR(60) NOT NULL,
    Email NVARCHAR(60) NOT NULL,
    IsAdmin INTEGER NOT NULL CHECK (IsAdmin IN (0, 1)),
    CONSTRAINT PK_User PRIMARY KEY (UserId)
);

CREATE TABLE Item
(
    ItemID INTEGER NOT NULL,
    UserID INTEGER NOT NULL,
    CategoryID INTEGER NOT NULL,
    Brand NVARCHAR(60) NOT NULL,
    Model NVARCHAR(60) NOT NULL,
    Size NVARCHAR(60) NOT NULL,
    Condition NVARCHAR(60) NOT NULL,
    Description NVARCHAR(60) NOT NULL,
    Price REAL NOT NULL,
    ImageURL NVARCHAR(255),
    IsSold INTEGER NOT NULL CHECK (IsSold IN (0, 1)),
    CONSTRAINT PK_Item PRIMARY KEY (ItemId),
    FOREIGN KEY (UserId) REFERENCES User (UserId)
        ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (CategoryId) REFERENCES Item (ItemId)
        ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE Category 
(
    CategoryID INTEGER NOT NULL,
    CategoryName NVARCHAR(60) NOT NULL
);

CREATE TABLE Transact 
(
    TransactionID INTEGER NOT NULL,
    SellerID INTEGER NOT NULL, 
    BuyerID INTEGER NOT NULL,
    ItemID INTEGER NOT NULL,
    TransactionDate DATE,
    CONSTRAINT PK_Transaction PRIMARY KEY (TransactionId),
    IsComplete INTEGER NOT NULL CHECK (IsComplete IN (0, 1)),
    FOREIGN KEY (SellerId) REFERENCES User (UserId)
        ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (BuyerId) REFERENCES User (UserId)
        ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (ItemId) REFERENCES Item (ItemId)
        ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE Messages 
(
    MessageID INTEGER NOT NULL,
    SenderID INTEGER NOT NULL,
    ReceiverID INTEGER NOT NULL,
    Content TEXT,
    Timestamp TIMESTAMP,
    CONSTRAINT PK_Message PRIMARY KEY (MessageId),
    FOREIGN KEY (SenderId) REFERENCES User (UserId)
        ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (ReceiverId) REFERENCES User (UserId)
        ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE Wishlist
(
    WishlistID INTEGER NOT NULL,
    UserID INTEGER NOT NULL,
    ItemID INTEGER NOT NULL,
    CONSTRAINT PK_Wishlist PRIMARY KEY (WishlistId),
    FOREIGN KEY (UserId) REFERENCES User (UserId)
        ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (ItemId) REFERENCES User (UserId)
        ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE Cart
(
    CartID INTEGER NOT NULL,
    UserID INTEGER NOT NULL,
    ItemID INTEGER NOT NULL,
    Quantity INTEGER NOT NULL,
    CONSTRAINT PK_Cart PRIMARY KEY (CartId),
    FOREIGN KEY (UserId) REFERENCES User (UserId)
        ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (ItemId) REFERENCES User (UserId)
        ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE Adm
(
    AdminID INTEGER NOT NULL,
    UserID INTEGER NOT NULL,
    CONSTRAINT PK_Admin PRIMARY KEY (AdminId),
    FOREIGN KEY (UserId) REFERENCES User (UserId)
        ON DELETE NO ACTION ON UPDATE NO ACTION
);

/*******************************************************************************
   Create Foreign Keys
********************************************************************************/

CREATE INDEX IFK_ItemUserID ON Item (UserID);

CREATE INDEX IFK_ItemCategoryID ON Item (CategoryID);

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

INSERT INTO User (UserID, Username, Password, Email, IsAdmin) VALUES (1, "filipageraldes", "abcde1", "fg@gmail.com", 0);
INSERT INTO User (UserID, Username, Password, Email, IsAdmin) VALUES (2, "cherif_09", "ab1233", "cherifff@gmail.com", 0);
INSERT INTO User (UserID, Username, Password, Email, IsAdmin) VALUES (3, "beepboop", "12999999", "beeep@gmail.com", 0);
INSERT INTO User (UserID, Username, Password, Email, IsAdmin) VALUES (4, "adminuser", "adminpass", 'admin@gmail.com', 1);


INSERT INTO Category (CategoryID, CategoryName) VALUES (1, "T-shirt");
INSERT INTO Category (CategoryID, CategoryName) VALUES (2, "Sweatshirt");
INSERT INTO Category (CategoryID, CategoryName) VALUES (2, "Sneakers");

INSERT INTO Item (ItemID, UserID, CategoryID, Brand, Model, Size, Condition, Description, Price, ImageURL, IsSold) VALUES (1, 1, 1, "Ralph Lauren", "Slim-Fit", "S", "New without tags", "Slim-fit T-shirt of Ralph Lauren, Size S, New", 10.99, "", 0);
INSERT INTO Item (ItemID, UserID, CategoryID, Brand, Model, Size, Condition, Description, Price, ImageURL, IsSold) VALUES (2, 2, 2, "Nike", "AirMax", "40", "Used", "Nike AirMax White, 40.0, With some use", 20, "", 1);
INSERT INTO Item (ItemID, UserID, CategoryID, Brand, Model, Size, Condition, Description, Price, ImageURL, IsSold) VALUES (3, 3, 3, "Nike", "Air Force", "40.5", "New with tags", "Nike Air Force White, 40.5, New with tags", 100, "", 0);

INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (1, 1, 3, 2, "2024-03-02", 0);
INSERT INTO Transact (TransactionID, SellerID, BuyerID, ItemID, TransactionDate, IsComplete) VALUES (1, 2, 3, 1, "2024-03-02", 1);

INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (1, 3, 2, "Hi! Can I get a refund?", "2024-03-02 08:00:00");
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (2, 3, 1, "Hi! Can you send me more photos?", "2024-03-02 08:09:01");
INSERT INTO Messages (MessageID, SenderID, ReceiverID, Content, Timestamp) VALUES (3, 1, 3, "Sure! There you go: ", "2024-03-02 09:30:34");

INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (1, 1, 3);
INSERT INTO Wishlist (WishlistID, UserID, ItemID) VALUES (2, 1, 2);

INSERT INTO Cart (CartID, UserID, ItemID, Quantity) VALUES (1, 3, 1, 1);

INSERT INTO Adm (AdminID, UserID) VALUES (1, 4);