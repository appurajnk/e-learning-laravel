<?php

namespace App\Http\Controllers\Api\v1\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IQuestion;

class QuestionController extends Controller
{
    
    protected $questions;
    
    public function __construct(IQuestion $questions)
    {
        $this->questions = $questions;
    }
    
    public function fetchQuestions(Request $request)
    {
        $questions = $this->questions->fetchQuestions($request->all());
        return response()->json($questions, 200);
    }
    
    public function fetchQuestion($uuid)
    {
        $questions = $this->questions->fetchQuestion($uuid);
        return response()->json($questions, 200);
    }
    
    public function storeQuestion(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:120',
            'body' => 'required'
        ]);
        
        return $this->questions->storeQuestion($request->all());
    }
    
    public function updateQuestion(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:120',
            'body' => 'required'
        ]);
        
        return $this->questions->updateQuestion($request->all(), $id);
    }
    
    public function destroyQuestion($id)
    {
        return $this->questions->destroyQuestion($id);
    }
}
