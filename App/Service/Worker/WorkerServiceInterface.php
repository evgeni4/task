<?php
namespace App\Service\Worker;

use App\Data\WorkerDTO;

interface WorkerServiceInterface
{
    public function add(WorkerDTO $workerDTO) : bool;
    /**
     * @return \Generator|WorkerDTO[]
     */
    public function getAll() : \Generator;

}