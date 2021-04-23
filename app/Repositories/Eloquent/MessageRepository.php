<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\IMessage;
use App\Http\Resources\CourseResource;
use Musonza\Chat\Models\Conversation;
use Illuminate\Http\Request;
use Chat;

class MessageRepository  implements IMessage
{
    
    public function createConversation(Request $request)
    {
        // first check if there is a conversation between the two
        $conversation = Chat::conversations()->between(auth()->user()->id, $request->recipient);
        if(! $conversation){
            $participants = [auth()->user()->id, $request->recipient];
            $conversation = Chat::createConversation($participants)->makePrivate();
        }
        
        $this->sendMessage($request, $conversation->id);
        
        return $conversation;
    }
    
    public function sendMessage(Request $request, $conversation_id)
    {
        $conversation = Conversation::find($conversation_id);
        $message = Chat::message($request->message)
                      ->from(auth()->user())
                      ->to($conversation)
                      ->send();
        $messages = $conversation->messages;
        return $messages;
    }
    
    public function getUserConversations()
    {
        $conversations = Chat::conversations()->setUser(auth()->user())->get();
        foreach($conversations as $con){
            $recipient = Conversation::find($con->id)->users()->where('id', '<>', auth()->id())->first();
            $con->messages = $con->messages;
            $con->recipient = $recipient;
        }
        
        return  $conversations;
    }
        
    
    public function getConversationMessages($id)
    {
        $conversation = Conversation::find($id);
        $messages = Chat::conversation($conversation)->setUser(auth()->user())->getMessages();
        return $messages;
    }
    
    public function getConversationParticipants($id)
    {
        $participants = Chat::conversations()->getById($id)->users;
        return $participants;
    }
    
    public function getUnreadMessagesCount()
    {
        $unreadCount = Chat::messages()->setUser(auth()->user())->unreadCount();
        return $unreadCount;
        
    }
   
    
}






