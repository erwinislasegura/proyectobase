<?php

namespace App\Core;

class Controller
{
    protected function view(string $view, array $data = [], string $layout = 'layouts/main'): void
    {
        extract($data, EXTR_SKIP);

        $viewFile = BASE_PATH . '/app/views/' . $view . '.php';
        if (!file_exists($viewFile)) {
            throw new \RuntimeException("Vista no encontrada: {$view}");
        }

        if ($layout === '') {
            require $viewFile;
            return;
        }

        require BASE_PATH . '/app/views/' . $layout . '.php';
    }
}
