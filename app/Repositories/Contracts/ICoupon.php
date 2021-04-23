<?php
namespace App\Repositories\Contracts;
use Illuminate\Http\Request;
interface ICoupon extends IRepository
{
    
    public function create(array $data);
    public function activate($id);
    public function findByCourse(array $data, $id);
    public function apply(array $data);
    public function removeCoupon($itemId);
    public function getAdminCoupons(array $data);
    public function getSitewideCoupon();
    
}