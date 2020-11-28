<?php

namespace App\Data;

use Exception;

class UserDTO
{
    private $id;
    private $email;
    private $password;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): UserDTO
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     * @return UserDTO
     * @throws Exception
     */
    public function setEmail($email): UserDTO
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     * @return UserDTO
     * @throws Exception
     */
    public function setPassword($password): UserDTO
    {
        $this->password = $password;
        return $this;
    }

}