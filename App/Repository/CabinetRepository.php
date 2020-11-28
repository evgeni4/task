<?php


namespace App\Repository;


use App\Data\CabinetDTO;
use App\Data\FloorDTO;

class CabinetRepository extends DatabaseAbstract implements CabinetRepositoryInterface
{

    public function insert(CabinetDTO $cabinetDTO): bool
    {
        $this->db->query(
            "INSERT INTO cabinet(floor_id,name)
                  VALUES(?,?)
             "
        )->execute([
            $cabinetDTO->getFloor()->getId(),
            $cabinetDTO->getName()
        ]);

        return true;
    }

    /**
     * @return \Generator|CabinetDTO[]
     */
    public function findAll(): \Generator
    {
        $lazyBookResult = $this->db->query(
            "
                  SELECT 
                     c.id as cabinetId, 
                      c.floor_id,
                      c.name as title,
                      f.id as floorId,
                      f.name
                  FROM cabinet as c
                  INNER JOIN floor as f on c.floor_id = f.id 
            ")->execute()
            ->fetchAssoc();

        foreach ($lazyBookResult as $row) {

            /** @var CabinetDTO $cabinet */
            /** @var FloorDTO $floor */
            $cabinet = $this->dataBinder->bind($row, CabinetDTO::class);
            $floor = $this->dataBinder->bind($row, FloorDTO::class);
            $cabinet->setId($row['cabinetId']);
            $cabinet->setName($row['title']);
            $floor->setId($row['floorId']);
            $cabinet->setFloor($floor);

            yield $cabinet;
        }
    }

    public function findOneById(int $id): CabinetDTO
    {
        return $this->db->query(
            "
                SELECT 
                    id,
                    floor_id,
                    name
                FROM cabinet
                WHERE id = ?
            ")->execute([$id])
            ->fetch(CabinetDTO::class)
            ->current();
    }

    public function findAllCabinet(): \Generator
    {
        $lazyBookResult = $this->db->query(
            "
                  SELECT 
                       id,name
                  FROM cabinet as c
            ")->execute()
            ->fetchAssoc();

        foreach ($lazyBookResult as $row) {

            /** @var FloorDTO $floor */
            $floor = $this->dataBinder->bind($row, FloorDTO::class);
            $floor->setId($row['id']);
            $floor->setName($row['name']);

            yield $floor;
        }
    }
}