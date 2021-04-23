<?php
namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface IMessage
{
    public function createConversation(Request $request);
    
    public function sendMessage(Request $request, $conversation_id);
    
    public function getUserConversations();
    
    public function getConversationMessages($id);
    
    public function getConversationParticipants($id);
    
    public function getUnreadMessagesCount();
    
    
}