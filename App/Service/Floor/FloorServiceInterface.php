<?php

namespace App\Service\Floor;

use App\Data\FloorDTO;

interface FloorServiceInterface
{
    public function addFloor(FloorDTO $floor): bool;

    /**
     * @return \Generator|FloorDTO[]
     */
    public function getAll(): \Generator;

    public function getOneById(int $id): FloorDTO;
}