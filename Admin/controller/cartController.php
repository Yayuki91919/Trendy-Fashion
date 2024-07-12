<?php
include_once __DIR__. '/../model/cart.php';

class cartController extends Cart 
{
    

    public function getUserCart($e){
        return $this->getCart($e);
    }
    public function removeCart($cart_id)
    {
        return $this->deleteCart($cart_id);
    }
    
}
?>
