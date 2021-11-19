<?php

namespace Rendi\Rframework\Controllers;

use Rendi\Rframework\App\Core\Http\Request;

class Test
{
    public function index(string $id)
    {
        echo $id;
    }

    public function query(Request $request)
    {
        echo $request->query('test');
    }
}
