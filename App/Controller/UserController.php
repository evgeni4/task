<?php


namespace App\Controller;


use App\Data\UserDTO;
use App\Service\User\UserServiceInterface;
use Core\DataBinderInterface;
use Core\TemplateInterface;

class UserController extends ControllerAbstract
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    public function __construct(
        TemplateInterface $template,
        DataBinderInterface $dataBinder,
        UserServiceInterface $userService)
    {
        parent::__construct($template, $dataBinder);
        $this->userService = $userService;
    }

    public function index()
    {
        $data = $this->userService->currentUser();
        $this->render("home/index", $data);
    }

    public function register(array $formData = [])
    {
        $data = $this->userService->isLogged();
        if ($data) {
            $this->redirect("dashboard.php");
            exit;
        }
        if (isset($formData['register'])) {
            $this->registerProcess($formData);
        } else {
            $this->render("users/login");
        }
    }

    private function registerProcess($formData)
    {
        try {
            /** @var UserDTO $user */
            $this->verifyEmail($formData);
            $this->verifyPassword($formData);
            $user = $this->dataBinder->bind($formData, UserDTO::class);
            $this->userService->register($user);
            $_SESSION['email'] = 'Регистрация успешно завершена!';
            $this->redirect("login.php");
        } catch (\Exception $ex) {
            $this->render("users/login", null,
                [$ex->getMessage()]);
        }
    }

    public function login(array $formData = [])
    {
        $data = $this->userService->isLogged();
        if ($data) {
            $this->redirect("index.php");
            exit;
        }
        $email = "";
        if (isset($formData['login'])) {
            $this->loginProcess($formData);
        } else {
            if (isset($_SESSION['email'])) {
                $email = $_SESSION['email'];
            }
            $this->render("users/login",
                $email === "" ? "" : $email);
        }
    }

    private function loginProcess($formData)
    {
        try {
            $user = $this->userService->login($formData['email'], $formData['password']);
            $currentUser = $this->dataBinder->bind($formData, UserDTO::class);

            if (null !== $user) {
                $_SESSION['id'] = $user->getId();
                $this->redirect("index.php");
            }
        } catch (\Exception $ex) {
            $this->render("users/login", null,
                [$ex->getMessage()]);
        }

    }

    /**
     * @param $formData
     * @return bool
     * @throws \Exception
     */
    private function verifyEmail($formData): bool
    {
        if ($formData['email'] == '') {
            throw new \Exception("Введите email!");
        }
        $validateEmail = preg_match("/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/", $formData['email']);
        if (!$validateEmail) {
            throw new \Exception("Email не валиден!");
        }
        return true;
    }

    /**
     * @param $formData
     * @throws \Exception
     */
    private function verifyPassword($formData): void
    {
        if ($formData['password'] !== $formData['password2']) {
            throw new \Exception("Пароли не совпадают!");
        }
        if ($formData['password'] === '') {
            throw new \Exception("Введите пароль (8 символов), должен содержать буквы (латинские) и цифры!");
        }
        $validatePassword = preg_match("/^(?=.*[a-z])(?=.*\d)[a-zA-Z\d]{8,}$/", $formData['password']);
        if (!$validatePassword) {
            throw new \Exception("Пароль (8 символов), должен содержать буквы (латинские) и цифры!");
        }
    }
}