<?php


namespace App\Repository;


use App\Data\WorkerDTO;

interface WorkerRepositoryInterface
{
    public function insert(WorkerDTO $workerDTO): bool;
    /**
     * @return \Generator|WorkerDTO[]
     */
    public function findAll(): \Generator;
}