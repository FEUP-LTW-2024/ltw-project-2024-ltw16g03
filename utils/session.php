<?php
  require_once(__DIR__ . '/../database/item.class.php'); 
  class Session {
    private array $messages;

    public function __construct() {
      session_start();

      $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
      unset($_SESSION['messages']);
    }

    public function isLoggedIn() : bool {
      return isset($_SESSION['id']);    
    }

    public function logout() {
      session_destroy();
    }

    public function getId() : ?int {
      return isset($_SESSION['id']) ? $_SESSION['id'] : null;    
    }

    public function getName() : ?string {
      return isset($_SESSION['name']) ? $_SESSION['name'] : null;
    }

    public function getItemsInCart() : ?array {
      return isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
    }

    public function setId(int $id) {
      $_SESSION['id'] = $id;
    }

    public function setName(string $name) {
      $_SESSION['name'] = $name;
    }

    public function isInCart(int $itemID) : bool {
      return isset($_SESSION['cart'][$itemID]);
    }

    public function addItemToCart(Item $item) : bool {
      $_SESSION['cart'][$item->ItemID] = $item;
      return true;
    }

    public function removeItemFromCart(int $ItemID) {
      unset($_SESSION['cart'][$ItemID]);
    }

    public function clearCart() {
      unset($_SESSION['cart']);
    }


    public function addMessage(string $type, string $text) {
      $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
    }

    public function getMessages() {
      return $this->messages;
    }
  }
?>