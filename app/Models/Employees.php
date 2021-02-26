<?php

declare (strict_types = 1);

namespace App\Models;

use PDO;

class Employees extends BaseModel
{
    public static function all()
    {
        return self::getConnection()
            ->query('SELECT * FROM employees')
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(int $id)
    {
        return self::getConnection()
            ->query('SELECT * FROM employees WHERE id = ' . $id)
            ->fetch(PDO::FETCH_ASSOC);
    }

    public static function delete(int $id)
    {
        return self::getConnection()
            ->query('DELETE FROM employees WHERE id = ' . $id)
            ->execute();
    }

    public static function update(int $id, array $fields)
    {
        $parameters = [];
        foreach ($fields as $key => $value) {
            $parameters[] = "{$key} = {$value}";
        }
        $updateValues = implode(', ', $parameters);

        return self::getConnection()
            ->query('UPDATE employees SET ' . $updateValues . ' WHERE id = ' . $id)
            ->execute();
    }

    public static function login(string $username, string $password)
    {
        $user = self::getConnection()->prepare('SELECT * FROM users WHERE username =? AND password=?');
        $user->execute([$username, $password]);

        return $user->fetch(PDO::FETCH_ASSOC);
    }
}
