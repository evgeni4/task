<?php


namespace App\Repository;


use App\Data\CabinetDTO;
use App\Data\FloorDTO;
use App\Data\WorkerDTO;

class WorkerRepository extends DatabaseAbstract implements WorkerRepositoryInterface
{

    public function insert(WorkerDTO $workerDTO): bool
    {
        $this->db->query(
            "INSERT INTO worker(name, cabinet_id)
                  VALUES(?,?)
             "
        )->execute([
            $workerDTO->getName(),
            $workerDTO->getCabinet()->getId()
        ]);

        return true;
    }

    public function findAll(): \Generator
    {
        $lazyBookResult = $this->db->query(
            "
                  SELECT 
                      w.id as workerId,
                      w.name as title, 
                      w.cabinet_id, 
                      c.id as cabinetId,
                      c.name as titles,
                      c.floor_id,
                      f.id,
                      f.name as names
                  FROM worker as w
                  INNER JOIN cabinet as c on w.cabinet_id = c.id  
                  INNER JOIN floor as f on c.floor_id = f.id  
            ")->execute()
            ->fetchAssoc();

        foreach ($lazyBookResult as $row) {

            /** @var WorkerDTO $worker */
            /** @var CabinetDTO $cabinet */
            /** @var FloorDTO $floor */
            $worker = $this->dataBinder->bind($row, WorkerDTO::class);
            $cabinet = $this->dataBinder->bind($row, CabinetDTO::class);
            $floor = $this->dataBinder->bind($row, FloorDTO::class);
            $worker->setId($row['workerId']);
            $worker->setName($row['title']);
            $cabinet->setId($row['cabinetId']);
            $cabinet->setName($row['titles']);
            $floor->setId($row['cabinetId']);
            $floor->setName($row['names']);
            $cabinet->setFloor($floor);
            $worker->setCabinet($cabinet);

            yield $worker;
        }
    }
}