<?php

namespace App\Http\Controllers\Api\v1\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IMessage;

class MessageController extends Controller
{
    
    protected $messenger;
    
    public function __construct(IMessage $messenger)
    {
        $this->messenger = $messenger;
    }
    
    
    public function createConversation(Request $request)
    {
        $conversation = $this->messenger->createConversation($request);
        
        return response()->json($conversation, 200);
    }
    
    public function getUserConversations()
    {
        $conversations = $this->messenger->getUserConversations();
        return response()->json($conversations, 200);
    }
    
    public function getConversationMessages($conversation)
    {
        $messages= $this->messenger->getConversationMessages($conversation);
        return response()->json($messages, 200);
    }
    
    public function sendMessage(Request $request, $conversation)
    {
        $messages = $this->messenger->sendMessage($request, $conversation);
        //$messages= $this->messenger->getConversationMessages($conversation);
        
        return response()->json($messages, 200);
        
    }
}
