<?php

namespace App\Repositories\Eloquent;

use App\Models\Question;
use App\Models\Comment;
use App\Repositories\Contracts\IComment;

class CommentRepository extends RepositoryAbstract implements IComment
{
    
    public function entity()
    {
        return Comment::class;
    }
    
    public function fetchComments(array $data, $modelId)
    {
        $model = $data['model']::find($modelId);
        $comments = $model->comments()->with(['user', 'replies'])
                        ->orderBy('marked_as_answer', 'desc')
                        ->orderBy('created_at', 'asc')
                        ->paginate(5, ['*'], 'page', $data['page']);
        return $comments;
    }
    
    public function fetchComment($id)
    {
        $comment = Comment::with(['user', 'replies'])->find($id);
        return $comment;
    }
    
    public function storeComment(array $data)
    {
        $model = $data['model']::find($data['modelId']);
        $model->comments()->create([
            'body' => $data['body'],
            'user_id' => auth()->id()
        ]);
    }
    
    
    public function updateComment(array $data, $id)
    {
        $comment = $this->find($id);
        $comment->body = $data['body'];
        $comment->save();
    }
    
    public function destroyComment($id)
    {
        $comment = $this->find($id)->delete();
    }
    
    public function markAsAnswer($id)
    {
        $answer = $this->find($id);
        $question = Question::find($answer->commentable_id);
        $bestAnswers = Comment::where('marked_as_answer', true)
                            ->where('commentable_id', $answer->commentable_id)
                            ->get();
                            
        // only the person who asked the question can mark an answer
        if(auth()->check() && (auth()->user()->id == $question->user_id || auth()->user()->id == $question->course->author->id)){
            foreach($bestAnswers as $b){
                $b->marked_as_answer = false;
                $b->save();
            }
            $answer->marked_as_answer = true;
            $answer->save();
        }
    }
    
}








