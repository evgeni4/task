<?php


namespace App\Service\Cabinet;


use App\Data\CabinetDTO;
use App\Data\FloorDTO;
use App\Repository\CabinetRepositoryInterface;

class CabinetService implements CabinetServiceInterface
{
    /**
     * @var CabinetRepositoryInterface
     */
    private $cabinetRepository;

    /**
     * CabinetService constructor.
     * @param CabinetRepositoryInterface $cabinetRepository
     */
    public function __construct(CabinetRepositoryInterface $cabinetRepository)
    {
        $this->cabinetRepository = $cabinetRepository;
    }

    public function add(CabinetDTO $cabinetDTO): bool
    {
        return $this->cabinetRepository->insert($cabinetDTO);
    }

    /**
     * @inheritDoc
     */
    public function getAll(): \Generator
    {
        return $this->cabinetRepository->findAll();
    }

    public function getOneById(int $id): CabinetDTO
    {
        return $this->cabinetRepository->findOneById($id);
    }

    public function getCabinet(): \Generator
    {
        return $this->cabinetRepository->findAllCabinet();
    }
}