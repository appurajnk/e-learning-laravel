<?php
namespace App\Repositories\Contracts;

interface IPayout extends IRepository
{
    
    public function fetchAllPeriods(array $data);
    
    public function fetchPeriodByUuid($uuid);
    
    public function fetchStatementsByPeriod($uuid);
    
    public function closePeriod($uuid);

    public function closeAllOpenPeriods();
    
    public function fetchPayoutsForPeriod($uuid);

    public function processPayout($uuid);

    public function fetchPayoutStatusUpdate($uuid);

    
    
}