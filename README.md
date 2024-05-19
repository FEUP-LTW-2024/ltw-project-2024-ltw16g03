# Retro Club

## Group ltw16g03

- Afonso Machado (up202207611) 33%
- Filipa Geraldes (up202208030) 33%
- Luís Arruda (up202206970) 33%

## Install Instructions

    git clone git@github.com:FEUP-LTW-2024/ltw-project-2024-ltw16g03.git
    git checkout final-delivery-v1
    sqlite3 database/database.db < database/database.sql
    sudo apt-get install php-gd
    php -S localhost:9000

## External Libraries

We have used the following external libraries:

- PHP-GD

## Screenshots

(2 or 3 screenshots of your website)

## Implemented Features

**General**:

- [X] Register a new account.
- [X] Log in and out.
- [X] Edit their profile, including their name, username, password, and email.

**Sellers**  should be able to:

- [X] List new items, providing details such as category, brand, model, size, and condition, along with images.
- [ ] Track and manage their listed items.
- [X] Respond to inquiries from buyers regarding their items and add further information if needed.
- [X] Print shipping forms for items that have been sold.

**Buyers**  should be able to:

- [X] Browse items using filters like category, price, and condition.
- [X] Engage with sellers to ask questions or negotiate prices.
- [X] Add items to a wishlist or shopping cart.
- [X] Proceed to checkout with their shopping cart (simulate payment process).

**Admins**  should be able to:

- [X] Elevate a user to admin status.
- [X] Introduce new item categories, sizes, conditions, and other pertinent entities.
- [X] Oversee and ensure the smooth operation of the entire system.

**Security**:
We have been careful with the following security aspects:

- [X] **SQL injection**
- [X] **Cross-Site Scripting (XSS)**
- [X] **Cross-Site Request Forgery (CSRF)**

**Password Storage Mechanism**: hash_password&verify_password

**Aditional Requirements**:

We also implemented the following additional requirements (you can add more):

- [X] **Temporary Cart for Non-Logged In Users**
- [ ] **Rating and Review System**
- [ ] **Promotional Features**
- [ ] **Analytics Dashboard**
- [ ] **Multi-Currency Support**
- [ ] **Item Swapping**
- [ ] **API Integration**
- [ ] **Dynamic Promotions**
- [X] **User Preferences**
- [ ] **Shipping Costs**
- [ ] **Real-Time Messaging System**
