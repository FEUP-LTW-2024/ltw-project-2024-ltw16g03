<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Retro Club</title>
        <link rel="stylesheet" href="../css/style.css">
        <script src="script.js" defer></script>
    </head>
    <body>
        <header class="classic">
            <a href="homepage.php"> 
                <img class = "logo" src="../assets/Retro Club Logotipo.png" alt="logo"/>           
            </a>
            <h1>PROCESS ORDER</h1>                       
        </header>
        <main>   
            <section class="process-order">
                <article class="shipping-left">
                    <h1 class="shipping-titles2">SHIPPING</h1>
                    <input type="text" placeholder="Name">
                    <input type="text" placeholder="Last name">
                    <input type="text" placeholder="Tax ID number">
                    <input type="text" placeholder="Country">
                    <input type="text" placeholder="Address">
                    <input type="text" placeholder="City">
                    <input type="text" placeholder="State">
                    <input type="text" placeholder="Postal code">
                    <input type="text" placeholder="Date of birth">
                    <input type="text" placeholder="Phone">
                </article>
                <article class="shipping-right">
                    <h1 class="shipping-titles2">PAYMENT</h1>
                    <div class="payment-option">
                        <input type="radio" name="payment" id="debit-card">
                        <label for="debit-card">Debit or Credit Card</label>
                        <img src="../assets/mastercard.png" alt="Debit Card" height = "50" width = "80">
                    </div>
                    <div class="payment-option">
                        <input type="radio" name="payment" id="paypal">
                        <label for="paypal">Paypal</label>
                        <img src="../assets/paypal.png" alt="Paypal" height = "50" width = "120">
                    </div>
                    <div class="debit-card-details">
                        <input type="text" placeholder="Card holder">
                        <input type="text" placeholder="Card number">
                        <input type="text" placeholder="CVV2 security code">
                        <input type="text" placeholder="Expiry date">
                    </div>
                    <div class="paypal-details">
                        <p>You will complete your payment via PayPal.</p>
                    </div>
                </article>
            </section>
            <section class="total">
                <article>
                    <div class="items-total">
                        <p>2 items</p>
                        <p class="big-total"><span class="bold-text">TOTAL</span> 20.00 $</p>
                    </div>
                    <div class="final-button">
                        <button>AUTHORISE PAYMENT</button>
                    </div>
                </article>
            </section>
        </main>
        <footer>
            Copyright &copy; 2024 Retro Club. All rights reserved.
        </footer>    
    </body>
</html>