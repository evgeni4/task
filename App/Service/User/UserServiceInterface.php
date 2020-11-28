<?php


namespace App\Service\User;

use App\Data\UserDTO;

interface UserServiceInterface
{
    public function register(UserDTO $userDTO): bool;

    public function login(string $email, string $password): ?UserDTO;

    public function currentUser(): ?UserDTO;

    public function isLogged(): bool;
}