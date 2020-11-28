<?php

namespace App\Service\User;


use App\Data\UserDTO;
use App\Repository\UserRepositoryInterface;
use App\Service\Encryption\EncryptionServiceInterface;
use App\Service\User\UserServiceInterface;


class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var EncryptionServiceInterface
     */
    private $encryptionService;


    public function __construct(UserRepositoryInterface $userRepository, EncryptionServiceInterface $encryptionService)
    {
        $this->userRepository = $userRepository;
        $this->encryptionService = $encryptionService;
    }

    /**
     * @param UserDTO $userDTO
     * @return bool
     * @throws \Exception
     */
    public function register(UserDTO $userDTO): bool
    {

        $plainPassword = $userDTO->getPassword();
        $passwordHash = $this->encryptionService->hash($plainPassword);
        $userDTO->setPassword($passwordHash);
        return $this->userRepository->insert($userDTO);
    }

    /**
     * @param string $email
     * @param string $password
     * @return UserDTO|null
     * @throws \Exception
     */
    public function login(string $email, string $password): ?UserDTO
    {
        $userFromDB = $this->userRepository->findOneByUsername($email);
        if (null === $userFromDB) {
            throw new \Exception("Ваше имя пользователя не существует");
        }
        if (false === $this->encryptionService->verify($password, $userFromDB->getPassword())) {
            throw new \Exception("Неправильный пароль!");
        }
        return $userFromDB;
    }
    public function currentUser(): ?UserDTO
    {
        if(!$_SESSION['id']){
            return null;
        }
        return $this->userRepository->findOneById(intval($_SESSION['id']));
    }
    public function isLogged(): bool
    {
        if(!$this->currentUser()){
            return false;
        }
        return true;
    }
}