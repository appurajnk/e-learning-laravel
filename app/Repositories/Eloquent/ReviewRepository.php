<?php

namespace App\Repositories\Eloquent;

use App\Models\Review;
use App\Models\Course;
use App\Repositories\Contracts\IReview;
use App\Events\UpdateCourseStats;


class ReviewRepository extends RepositoryAbstract implements IReview
{
    
    public function entity()
    {
        return Review::class;
    }
    
    public function fetchReviews(array $data, $id)
    {
        
        $reviews = Review::latest()->with(['user', 'comments', 'comments.user'])
        	->where('course_id', $id);
        
        if($data['rating']){
    	    $reviews = $reviews->whereRaw('ROUND(rating) = ?', [$data['rating']]);
    	}
    	
        $reviews = $reviews->paginate(2, ['*'], 'page', $data['page']);
        	
    	return $reviews;
    }
    
    public function fetchSummary($id)
    {
      
        $ratings = $this->findWhere('course_id', $id);
        $course = Course::find($id);
        
        $ratings = $ratings->each(function ($item, $key) {
            $item->rating = round($item->rating, 0);
        });
        
        $ratings = collect([
            ['rating' => '5', 'total' => 0, 'width' => 0],
            ['rating' => '4', 'total' => 0, 'width' => 0],
            ['rating' => '3', 'total' => 0, 'width' => 0],
            ['rating' => '2', 'total' => 0, 'width' => 0],
            ['rating' => '1', 'total' => 0, 'width' => 0]
        ]);
        
        $data = \DB::table('reviews')
                ->where('course_id', $id)
                ->selectRaw('round(rating) as rating, count(rating) as total')
                ->groupBy(\DB::raw('round(rating)'))
                ->get();
        
        $course_ratings = $ratings->map(function ($item, $key) use ($data, $course) {
            $v = $item['rating'];
            $r = $data->where('rating', $v);
            if($r->isNotEmpty()){
                $x = $r->first()->total;
                $item['total'] = $r->first()->total;
                $item['width'] = ($r->first()->total / $course->reviews->count()) * 100;
            }
            return $item;
        });
        
        $course_average = round($course->reviews()->avg('rating'),1);
        
        $data = [
            'summary' => $course_ratings,
            'course_avg' => (float)$course_average
        ];
        
        return $data;
        
    }
    
    public function storeReview(array $data)
    {
        $course = Course::find($data['course']);
		
		$course->reviews()->create([
			'rating' => $data['rating'],
			'title' => $data['title'],
			'user_id' => auth()->id(),
			'body' => $data['body']
        ]);
        
        event(new UpdateCourseStats($course, 'total_reviews'));
    }
    
    public function updateReview(array $data, $id)
    {
        $review = $this->find($id);
        $review->update([
			'rating' => $data['rating'],
			'title' => $data['title'],
			'body' => $data['body']
        ]);
        event(new UpdateCourseStats($review->course, 'total_reviews'));
    }
    
    public function destroyReview($id)
    {
        $review = $this->find($id);
        $review->delete();
        event(new UpdateCourseStats($review->course, 'total_reviews'));
    }
    
}