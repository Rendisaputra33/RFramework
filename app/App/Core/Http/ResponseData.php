<?php

namespace Rendi\Rframework\App\Core\Http;

class ResponseData
{
    private int $code;

    public function __construct(int $code)
    {
        $this->code = $code;
    }

    public function json(array $data)
    {
        // remove any string that could create an invalid JSON 
        // such as PHP Notice, Warning, logs...
        ob_clean();

        // this will clean up any previously added headers, to start clean
        header_remove();

        // Set the content type to JSON and charset 
        // (charset can be set to something else)
        header("Content-type: application/json; charset=utf-8", true, $this->code);
        echo json_encode($data);
    }
}
