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
        $donnes = file_get_contents('php://input');
        $donnes = json_decode($donnes, true);
        $user   = Employees::login(['username' => $donnes['username'], 'password' => sha1($donnes['password'])]);
        if ($user) {
            $_SESSION['user'] = $user;

            return new Response(
                201,
                json_encode($user),
                $this->defaultHeaders
            );
        } else {
            return new Response(
                500,
                json_encode(['message' => 'Nom utilisateur et mot de pass incorrecte']),
                $this->defaultHeaders
            );
        }
    }

    public function pointage()
    {
        $response = new Response(
            200,
            json_encode(Employees::allPointage()),
            $this->defaultHeaders
        );
        $response->headers->set('Access-Control-Allow-Methods', 'GET');

        return $response;

    }

    public function InsertPointage()
    {
        $donnes = file_get_contents('php://input');
        $donnes = json_decode($donnes, true);
        $date   = date('Y-m-d');
        if ($emp = Employees::search($donnes['username'])) {
            if (Employees::point($emp['id'], $date)) {
                $response = new Response(
                    201,
                    json_encode(['Message ' => 'pointer avec success']),
                    $this->defaultHeaders
                );
            } else {
                $response = new Response();
            }
        }
        $response->headers->set('Access-Control-Allow-Methods', 'POST');

        return $response;
    }
}
