<?php

namespace Rendi\Rframework\App\Core\Http;

class Request
{
    private static array $queries = [];

    public function __construct(array $request, array $queries = [])
    {
        $this->makeRequestBodyObject($request);
        $this->makeRequestQueryObject($queries);
    }

    private function makeRequestQueryObject($queries)
    {
        foreach ($queries as $key => $value) {
            self::$queries[$key] = $value;
        }
    }

    private function makeRequestBodyObject(array $request)
    {
        if ($request) {
            foreach ($request as $key => $value) {
                $this->$key = $value;
            }
        } else {
            $this->jsonRequest();
        }
    }

    private function jsonRequest()
    {
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true);
        if ($input) {
            foreach ($input as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    public function query(string $query)
    {
        return self::$queries[$query];
    }
}
