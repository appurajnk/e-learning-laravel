<?php

namespace App\Http\Controllers\Api\v1\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IReview;

class ReviewController extends Controller
{
    
    protected $reviews;
    
    public function __construct(IReview $reviews)
    {
        $this->reviews = $reviews;
    }
    
    public function fetchReviews(Request $request, $id)
    {
        $reviews = $this->reviews->fetchReviews($request->all(), $id);
        return response()->json($reviews, 200);
    }
    
    public function fetchSummary($id){
        $ratings = $this->reviews->fetchSummary($id);
        return response()->json($ratings, 200);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'rating' => 'required|numeric|min:1',
            'title' => 'required',
            'body' => 'required',
        ]);
    
        return $this->reviews->storeReview($request->all());
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'rating' => 'required|numeric|min:1',
            'title' => 'required',
            'body' => 'required',
        ]);
            
        return $this->reviews->updateReview($request->all(), $id);
    }
    
    public function destroy($id)
    {
        return $this->reviews->destroyReview($id);   
    }
    
    
}
