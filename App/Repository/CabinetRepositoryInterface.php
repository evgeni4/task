<?php


namespace App\Repository;


use App\Data\CabinetDTO;

interface CabinetRepositoryInterface
{
    public function insert(CabinetDTO $floor): bool;
    /**
     * @return \Generator|CabinetDTO[]
     */
    public function findAll(): \Generator;

    public function findOneById(int $id): CabinetDTO;
}