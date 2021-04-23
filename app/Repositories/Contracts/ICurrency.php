<?php
namespace App\Repositories\Contracts;

interface ICurrency extends IRepository
{
    
    public function getAll();
    public function findByCode($code);
    public function store(array $data);
    public function update(array $data, $id);
    public function destroy($id);
    public function markAsPrimary($id);
    public function toggleEnabled($id);



}