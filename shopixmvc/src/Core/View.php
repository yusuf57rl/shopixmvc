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
    }

    public function addTemplateParameter(string $key, mixed $value): void
    {
        $this->params[$key] = $value;
    }

    public function getTemplateParameter(string $key): mixed
    {
        return $this->params[$key];
    }

    public function getTemplateParameters(): array
    {
        return $this->params;
    }

    public function setTemplate(string $template): void
    {
        if(!str_contains($template, '.tpl')) {
            $template .= '.tpl';
        }

        $this->template = $template;
    }

    /**
     * @return void
     * @throws \SmartyException
     * @codeCoverageIgnore dont need to test
     */
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


