<?php

namespace App\Service\Worker;

use App\Data\WorkerDTO;
use App\Repository\WorkerRepositoryInterface;

class WorkerService implements WorkerServiceInterface
{
    /**
     * @var WorkerRepositoryInterface
     */
    private $workerRepository;

    /**
     * WorkerService constructor.
     * @param WorkerRepositoryInterface $workerRepository
     */
    public function __construct(WorkerRepositoryInterface $workerRepository)
    {
        $this->workerRepository = $workerRepository;
    }

    public function add(WorkerDTO $workerDTO): bool
    {
       return $this->workerRepository->insert($workerDTO);
    }

    public function getAll(): \Generator
    {
        return $this->workerRepository->findAll();
    }
}