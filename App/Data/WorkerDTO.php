<?php


namespace App\Data;


class WorkerDTO
{
    /**
     * @var integer
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var CabinetDTO
     */
    private $cabinet;

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

    /**
     * @return CabinetDTO
     */
    public function getCabinet(): CabinetDTO
    {
        return $this->cabinet;
    }

    /**
     * @param CabinetDTO $cabinet
     */
    public function setCabinet(CabinetDTO $cabinet): void
    {
        $this->cabinet = $cabinet;
    }

}