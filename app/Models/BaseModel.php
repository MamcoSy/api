<?php

declare(strict_types=1);

namespace App\Models;

use PDO;

abstract class BaseModel
{
    public static function getConnection()
    {
        try
        {
            $databaseConnection = new PDO(
                'mysql:host=127.0.0.1;dbname=gsp;port=3306',
                'root',
                '',
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        }
        catch (\Throwable $th)
        {
            throw $th;
        }

        return $databaseConnection;
    }
}
