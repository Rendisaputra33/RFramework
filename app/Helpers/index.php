<?php

use Rendi\Rframework\App\Core\Http\ResponseData;
use Rendi\Rframework\App\Views\View;

if (!function_exists('getName')) {
    function getName()
    {
        return 'rendi saputra';
    }
}

if (!function_exists('baseUrl')) {
    function baseUrl(): string
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'] . '/';
        return $protocol . $domainName;
    }
}

if (!function_exists('response')) {
    function response(int $code = 200)
    {
        header_remove();
        return new ResponseData($code);
    }
}

if (!function_exists('template')) {
    function template(string $name, array $data)
    {
        View::render('template/header', $data);
        View::render($name, $data);
        View::render('template/footer', $data);
    }
}
