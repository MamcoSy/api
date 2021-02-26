<?php

declare (strict_types = 1);

namespace App\Controllers;

use App\Models\Employees;
use MamcoSy\Http\Response;

class HomeController
{
    protected array $defaultHeaders = [
        'Access-Control-Allow-Origin'  => '*',
        'Content-Type'                 => 'application/json; charset=utf-8',
        'Access-Control-Max-Age'       => '3600',
        'Access-Control-Allow-Headers' => 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With',
    ];

    public function index()
    {
        return new Response(200, 'api', $this->defaultHeaders);
    }

    public function getAllEmployees()
    {
        $response = new Response(
            200,
            json_encode(Employees::all()),
            $this->defaultHeaders
        );
        $response->headers->set('Access-Control-Allow-Methods', 'GET');

        return $response;
    }

    public function findEmployee(int $id)
    {
        $response = new Response(
            200,
            json_encode(Employees::find($id)),
            $this->defaultHeaders
        );
        $response->headers->set('Access-Control-Allow-Methods', 'GET');

        return $response;
    }

    public function deleteEmployee(int $id)
    {
        Employees::delete($id);
        $response = new Response(
            201,
            json_encode(['message' => 'Employee deleted']),
            $this->defaultHeaders
        );
        $response->headers->set('Access-Control-Allow-Methods', 'GET');

        return $response;
    }

    public function updateEmployee(int $id)
    {
        $donnes = file_get_contents('php://input');
        $donnes = json_decode($donnes, true);
        Employees::update($id, $donnes);
        $response = new Response(
            201,
            json_encode(['message' => 'Employee updated']),
            $this->defaultHeaders
        );
        $response->headers->set('Access-Control-Allow-Methods', 'GET');

        return $response;
    }

    public function login()
    {
        $donnes = @file_get_contents('php://input');
        $donnes = json_decode($donnes);
        var_dump($donnes);
        die();
        $user = Employees::login($donnes['username'], $donnes['password']);
        if ($user) {
            return new Response(
                201,
                json_encode($user),
                $this->defaultHeaders
            );
        } else {
            return new Response(
                401,
                json_encode(['message' => 'Invalid Request']),
                $this->defaultHeaders
            );
        }
    }
}
