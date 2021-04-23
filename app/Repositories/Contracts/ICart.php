<?php
namespace App\Repositories\Contracts;

use Gloudemans\Shoppingcart\Contracts\Buyable;

interface ICart extends IRepository
{
    
    
    public function addToCart(array $data);
    
    public function fetchItems();
    
    public function remove(array $data);
    
    public function switchToSaveForLater($id);
    
    public function switchToWishlist($id);
    
    public function switchToCart($id);
    
    public function emptyCart();
    
    public function enrollNow(array $data);
    
    public function checkIfCourseIsInCart($course_id);
}