<?php

namespace App\Service\Cabinet;
use App\Data\CabinetDTO;
use App\Data\FloorDTO;

interface CabinetServiceInterface
{
    public function add(CabinetDTO $cabinetDTO) : bool;
    /**
     * @return \Generator|CabinetDTO[]
     */
    public function getAll() : \Generator;

    /**
     * @return \Generator|FloorDTO[]
     */
    public function getCabinet(): \Generator;

    public function getOneById(int $id): CabinetDTO;
}