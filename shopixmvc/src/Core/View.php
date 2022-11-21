<?php

namespace App\Core;

class View
{
    private array $params = [];
    private string $template = "Error.tpl";

    public function __construct(
        private readonly \Smarty $smarty,
    )
    {
        $this->smarty->setTemplateDir(__DIR__ . '/../../template');
        $this->smarty->setCompileDir(__DIR__ . '/../../smarty/template_c');
        $this->smarty->setCacheDir(__DIR__ . '/../../smarty/cache');
        $this->smarty->setConfigDir(__DIR__ . '/../../smarty/config');
    }

    public function addTemplateParameter(string $key, mixed $value): void
    {
        $this->params[$key] = $value;
    }

    public function getTemplateParameter(string $key): mixed
    {
        return $this->params[$key];
    }

    public function setTemplate(string $template): void
    {
        if(!str_contains($template, '.tpl')) {
            $template .= '.tpl';
        }

        $this->template = $template;
    }

    public function display(): void
    {
        $this->smarty->assign($this->params);
        $this->smarty->display($this->template);
    }

    public function getTemplate(): string
    {
        return $this->template;
    }
}


