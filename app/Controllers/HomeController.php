<?php

namespace Rendi\Rframework\Controllers;

use Rendi\Rframework\App\Core\Database\Query;
use Rendi\Rframework\App\Core\Http\Request;

class HomeController extends Query
{
    public function index()
    {
        $users = $this->query('SELECT * FROM User')->execQuery()->getAll();
        return template('index', ['title' => 'Home | Page', 'users' => $users]);
    }

    public function post(Request $request): void
    {
        echo $request->nama;
    }

    public function api()
    {
        $data = $this->query('SELECT * FROM User')->execQuery()->getAll();
        return response()->json(['data' => $data]);
    }

    public function putRequest(Request $request, int $id)
    {
        return response(200)->json([
            'data' => $request,
            'parameter' => $id
        ]);
    }
}
