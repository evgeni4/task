<?php
namespace App\Repository;

use App\Data\UserDTO;
use Core\DataBinderInterface;
use Database\DatabaseInterface;
class UserRepository extends DatabaseAbstract implements UserRepositoryInterface
{
    public function __construct(DatabaseInterface $database,
                                DataBinderInterface $dataBinder)
    {
        parent::__construct($database, $dataBinder);
    }

    public function insert(UserDTO $userDTO): bool
    {
        $this->db->query(
            "INSERT INTO users(email, password)
                  VALUES(?,?)
             "
        )->execute([
            $userDTO->getEmail(),
            $userDTO->getPassword()
        ]);

        return true;
    }

    public function update(int $id, UserDTO $userDTO): bool
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
    }
    public function findOneByUsername(string $email): ?UserDTO
    {
        return $this->db->query(
            "SELECT id, 
                    email, 
                    password
                  FROM users
                  WHERE email = ?
             "
        )->execute([$email])
            ->fetch(UserDTO::class)
            ->current();

    }
    public function findOneById(int $id): ?UserDTO
    {
        return $this->db->query(
            "SELECT id,
                    email, 
                    password
                  FROM users
                  WHERE id = ?
             "
        )->execute([$id])
            ->fetch(UserDTO::class)
            ->current();
    }
}