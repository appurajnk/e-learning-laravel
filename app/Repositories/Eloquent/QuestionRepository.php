<?php

namespace App\Repositories\Eloquent;

use App\Models\Question;
use App\Repositories\Contracts\IQuestion;
use App\Http\Resources\CourseResource;


class QuestionRepository extends RepositoryAbstract implements IQuestion
{
    
    public function entity()
    {
        return Question::class;
    }
    
    public function fetchQuestions(array $data)
    {
        $course = $data['course'];
        $query = $data['query'];
        $questionsFollowing = $data['questionsFollowing'];
        $questionsWithoutResponse = $data['questionsWithoutResponse'];
        $questionsWithoutAnswer = $data['questionsWithoutAnswer'];
        $orderBy = $data['orderBy'];
        
        $q = (new Question)->newQuery();
        
        if($course){
            $q = $q->where('course_id', $course);
        } else {
            $q = $q->whereHas('course', function($query){
                $query->where('user_id', auth()->id());
            });
        }
        
        
        if($query){
            $q = $q->where('title', 'like', "%$query%")->orWhere('body', 'like', "%$query%");
        }
        
        if($questionsWithoutResponse){
            $q = $q->doesntHave('comments');
        }
        
        if($questionsWithoutAnswer){
            $q = $q->where(function($query){
                    $query->whereDoesntHave('comments')
                        ->orWhereDoesntHave('comments', function($query2){
                           $query2->where('marked_as_answer', true); 
                        });
                });
        }
        

        if($orderBy=='recent'){
            $q = $q->orderBy('created_at', 'desc');
        } else {
            $q = $q->withCount('comments')->orderBy('comments_count', 'desc');
        }
        
        
        $questions = $q->with(['user', 'course'])->paginate(10, ['*'], 'page', $data['page']); 
       
        
        return $questions; 
    }
    
    public function fetchQuestion($uuid)
    {
        $question = Question::where('uuid', $uuid)
                        ->with('user', 'course', 'course.author')
                        ->first();
        $question->timeago = $question->created_at->diffForHumans();
        return $question;
    }
    
    public function storeQuestion(array $data)
    {
        Question::create([
            'user_id' => auth()->id(),
            'uuid' => (string)time() . auth()->id(),
            'course_id' => $data['course'],
            'title' => $data['title'],
            'body' => $data['body']
        ]);
        
    }
    
    public function updateQuestion(array $data, $id)
    {
        $question = $this->find($id);
        $question->update([
            'title' => $data['title'],
            'body' => $data['body']
        ]);
    }
    
    public function destroyQuestion($id)
    {
        $question = $this->find($id);
        $question->delete();
    }

    
}