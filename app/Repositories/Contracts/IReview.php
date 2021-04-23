<?php
namespace App\Repositories\Contracts;

interface IReview extends IRepository
{
    
    public function fetchReviews(array $data, $id);
    public function fetchSummary($id);
    public function storeReview(array $data);
    public function updateReview(array $data, $id);
    public function destroyReview($id);
    
    
}