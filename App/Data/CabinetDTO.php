<?php


namespace App\Data;


class CabinetDTO
{
    /**
     * @var integer
     */
    private $id;
    /**
     * @var FloorDTO
     */
    private $floor;
    /**
     * @var string
     */
    private $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return FloorDTO
     */
    public function getFloor(): FloorDTO
    {
        return $this->floor;
    }

    /**
     * @param FloorDTO $floor
     */
    public function setFloor(FloorDTO $floor): void
    {
        $this->floor = $floor;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

}