<?php

namespace Rendi\Rframework\App\Views;

use Exception;

class View
{
    public static function render(string $name, array $data)
    {
        extract($data, EXTR_SKIP);

        if ($_ENV['APP_ENV'] === 'production') {
            throw new Exception('view error');
            exit();
        } else {
            if (file_exists(__DIR__ . '/../../Views/' . $name . '.php')) {
                require_once  __DIR__ . '/../../Views/' . $name . '.php';
            } else {
                echo "Error : Failed render view $name";
            }
        }
    }
}
