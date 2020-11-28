<?php


namespace App\Controller;


use App\Data\CabinetDTO;
use App\Data\FloorDTO;
use App\Data\UserDTO;
use App\Data\WorkerDTO;
use App\Service\Cabinet\CabinetServiceInterface;
use App\Service\Floor\FloorServiceInterface;
use App\Service\User\UserServiceInterface;
use App\Service\Worker\WorkerServiceInterface;
use Core\DataBinderInterface;
use Core\TemplateInterface;

class DashboardController extends ControllerAbstract
{
    /**
     * @var UserServiceInterface
     */
    private $userService;
    private $floorService;
    private $cabinetService;
    private $workerService;

    public function __construct(
        TemplateInterface $template,
        DataBinderInterface $dataBinder,
        UserServiceInterface $userService,
        FloorServiceInterface $floorService,
        CabinetServiceInterface $cabinetService,
        WorkerServiceInterface $workerService)
    {
        parent::__construct($template, $dataBinder);
        $this->userService = $userService;
        $this->floorService = $floorService;
        $this->cabinetService = $cabinetService;
        $this->workerService = $workerService;
    }

    public function index()
    {
        $data = $this->userService->isLogged();
        if (!$data) {
            $this->redirect("login.php");
            exit;
        }
        $this->render("dashboard/dashboard", $data);
    }

    public function floorAll()
    {
        if (!$this->userService->isLogged()) {
            $this->redirect("login.php");
            exit;
        }

        try {
            $floors = $this->floorService->getAll();
            $this->render("floor/all_floor", $floors);
        } catch (\Exception $ex) {
            $floors = $this->floorService->getAll();
            $this->render("floor/all_floor", $floors,
                [$ex->getMessage()]);
        }
    }

    public function floorNew(array $formData = [])
    {
        $data = $this->userService->currentUser();
        if (!$data) {
            $this->redirect("index.php");
            exit;
        }
        if (isset($formData['add'])) {
            $this->floorNewProcess($formData);
        } else {
            $this->render("floor/floorNew",$data);
        }
    }
    private function floorNewProcess($formData)
    {
        try {
            $floor = $this->dataBinder->bind($formData, FloorDTO::class);

            $this->floorService->addFloor($floor);
            $_SESSION['name'] = 'Этаж успешно добавлен!';
            $this->redirect("floorAll.php");
        } catch (\Exception $ex) {
            $this->render("floor/floorNew", null,
                [$ex->getMessage()]);
        }
    }

    public function cabinetNew(array $formData = [])
    {
        $data = $this->userService->isLogged();
        if (!$data) {
            $this->redirect("index.php");
            exit;
        }
        if (isset($formData['add'])) {
          $this->cabinetNewProcess($formData);
        } else {
            $floors = $this->floorService->getAll();
            $this->render("cabinet/cabinetNew",$floors);
        }
    }
    private function cabinetNewProcess($formData)
    {
        try {
            $floor = $this->floorService->getOneById($formData['floor_id']);
            /** @var CabinetDTO $cabinet */
            $cabinet = $this->dataBinder->bind($formData, CabinetDTO::class);
            $cabinet->setFloor($floor);
            $this->cabinetService->add($cabinet);
           // var_dump($cabinet);
            $this->redirect("cabinetAll.php");
        } catch (\Exception $ex) {
            $this->render("cabinet/cabinetNew", null,
                [$ex->getMessage()]);
        }
    }
    public function cabinetAll()
    {
        if (!$this->userService->isLogged()) {
            $this->redirect("login.php");
            exit;
        }

        try {
            $cabinets = $this->cabinetService->getAll();
            $this->render("cabinet/all_cabinet", $cabinets);
        } catch (\Exception $ex) {
            $cabinets = $this->cabinetService->getAll();
            $this->render("cabinet/all_cabinet", $cabinets,
                [$ex->getMessage()]);
        }
    }

    public function workerNew(array $formData = [])
    {
        $data = $this->userService->isLogged();
        if (!$data) {
            $this->redirect("index.php");
            exit;
        }
        if (isset($formData['add'])) {
            $this->workerNewProcess($formData);
        } else {
            $cabinet = $this->cabinetService->getCabinet();
            $this->render("worker/workerNew",$cabinet);
        }
    }
    private function workerNewProcess($formData)
    {
        try {
            $cabinet = $this->cabinetService->getOneById($formData['cabinet_id']);
            /** @var WorkerDTO $worker */
            $worker = $this->dataBinder->bind($formData, WorkerDTO::class);
            $worker->setCabinet($cabinet);
            $this->workerService->add($worker);
           // $this->render("worker/workerNew");
            $this->redirect("workerAll.php");
        } catch (\Exception $ex) {
            $this->render("worker/workerNew", null,
                [$ex->getMessage()]);
        }
    }

    public function workerAll()
    {
        if (!$this->userService->isLogged()) {
            $this->redirect("login.php");
            exit;
        }

        try {
            $worker = $this->workerService->getAll();
            $this->render("worker/workerAll", $worker);

        } catch (\Exception $ex) {
            $worker = $this->cabinetService->getAll();
            $this->render("worker/workerAll", $worker,
                [$ex->getMessage()]);
        }
    }
}