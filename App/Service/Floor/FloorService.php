<?php


namespace App\Service\Floor;


use App\Data\FloorDTO;
use App\Repository\FloorRepositoryInterface;

class FloorService implements FloorServiceInterface
{
    /**
     * @var FloorRepositoryInterface
     */
    private $floorRepository;

    /**
     * FloorService constructor.
     * @param FloorRepositoryInterface $floorRepository
     */
    public function __construct(FloorRepositoryInterface $floorRepository)
    {
        $this->floorRepository = $floorRepository;
    }

    public function addFloor(FloorDTO $floor): bool
    {
       return $this->floorRepository->insert($floor);
    }

    public function getAll(): \Generator
    {
        return $this->floorRepository->findAll();
    }
    public function getOneById(int $id): FloorDTO
    {
        return $this->floorRepository->findOneById($id);
    }
}