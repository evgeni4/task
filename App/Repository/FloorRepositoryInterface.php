<?php


namespace App\Repository;


use App\Data\FloorDTO;

interface FloorRepositoryInterface
{
    public function insert(FloorDTO $floor): bool;
    /**
     * @return \Generator|FloorDTO[]
     */
    public function findAll() : \Generator;

    public function findOneById(int $id): FloorDTO;
}