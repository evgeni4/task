<?php


namespace App\Controller;

use Core\DataBinderInterface;
use Core\TemplateInterface;

abstract class ControllerAbstract
{
    /**
     * @var TemplateInterface
     */
    private $template;
    /**
     * @var DataBinderInterface
     */
    protected $dataBinder;

    public function __construct(TemplateInterface $template, DataBinderInterface $dataBinder)
    {
        $this->template = $template;
        $this->dataBinder = $dataBinder;
    }

    public function render(string $templateName, $data = null, array $errors = []): void
    {
        $this->template->render($templateName, $data, $errors);
    }

    public function redirect(string $url): void
    {
        header("Location: $url");
    }
}