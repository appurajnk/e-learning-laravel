<?php

namespace App\Http\Controllers\Api\v1\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IComment;


class CommentController extends Controller
{
    //
    
    protected $comments;
    
    public function __construct(IComment $comments)
    {
        $this->comments = $comments;
    }
    
    public function fetchComments(Request $request, $modelId)
    {
        $comments = $this->comments->fetchComments($request->all(), $modelId);
        return response()->json($comments, 200);
    }
    
    public function fetchComment($id)
    {
        $comment = $this->comments->fetchComment($id);
        return response()->json($comment, 200);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|string'
        ]);

        return $this->comments->storeComment($request->all());    
    }
    
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'body' => 'required|string'
        ]);
        return $this->comments->updateComment($request->all(), $id);
    }
    
    public function destroy($id)
    {
        return $this->comments->destroyComment($id);
    }
    
    public function markAsAnswer($id)
    {
        return $this->comments->markAsAnswer($id);
    }
    
    
    
    
    
    
}
