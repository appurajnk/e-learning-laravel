<?php

namespace App\Repositories\Eloquent;

use App\Models\Transaction;
use App\Repositories\Contracts\ITransaction;


class TransactionRepository extends RepositoryAbstract implements ITransaction
{
    
    public function entity()
    {
        return Transaction::class;
    }
    
    public function fetchAll(array $data)
    {
 
        $builder = (new Transaction)->newQuery();
        
        if($data['query']){
            $builder->where('transactions.uuid', 'like', '%'.$data['query'].'%')
                    ->orWhereJoin('user.first_name', 'like', '%'.$data['query'].'%')
                    ->orWhereJoin('user.last_name', 'like', '%'.$data['query'].'%');
        }
        
        $builder->orderBy($data['sort'], $data['direction']);
        $transactions = $builder->with(['user'])->paginate($data['limit']);
        
        return $transactions;
    }
    
    
   
}