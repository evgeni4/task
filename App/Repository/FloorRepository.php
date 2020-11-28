<?php


namespace App\Repository;


use App\Data\FloorDTO;

class FloorRepository extends DatabaseAbstract implements FloorRepositoryInterface
{

    public function insert(FloorDTO $floor): bool
    {
        $this->db->query(
            "INSERT INTO floor(name)
                  VALUES(?)
             "
        )->execute([
            $floor->getName()
        ]);

        return true;
    }

    public function findAll(): \Generator
    {
        $lazyBookResult = $this->db->query(
            "
                  SELECT 
                       id,name
                  FROM floor
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
    public function findOneById(int $id): FloorDTO
    {
        return $this->db->query(
            "
                SELECT 
                    id,
                    name
                FROM floor
                WHERE id = ?
            ")->execute([$id])
            ->fetch(FloorDTO::class)
            ->current();
    }
}