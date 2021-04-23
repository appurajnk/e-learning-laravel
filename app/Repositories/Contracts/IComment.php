<?php
namespace App\Repositories\Contracts;

interface IComment extends IRepository
{
    
    public function fetchComments(array $data, $modelId);
    public function fetchComment($id);
    public function storeComment(array $data);
    public function updateComment(array $data, $id);
    public function destroyComment($id);
    public function markAsAnswer($id);
    
}