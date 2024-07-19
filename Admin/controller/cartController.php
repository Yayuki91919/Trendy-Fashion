<?php
include_once __DIR__. '/../model/cart.php';

class cartController extends Cart 
{
    
    public function getUserCart($e){
        return $this->getCart($e);
    }
    public function getEditCart($cart_id){
        return $this->EditCart($cart_id);
    }
    public function removeCart($cart_id)
    {
        return $this->deleteCart($cart_id);
    }
    public function addToCart($d_id,$cid,$quantity)
    {
        return $this->addCart($d_id,$cid,$quantity);
    }

    
}
?>
