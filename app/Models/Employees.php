<?php

declare (strict_types = 1);

namespace App\Models;

use PDO;

class Employees extends BaseModel
{
    public static function all()
    {
        return self::getConnection()
            ->query('SELECT * FROM employees WHERE role = 0')
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

    public static function login(array $data)
    {
        $user = self::getConnection()->prepare('SELECT * FROM employees WHERE username = :username AND password= :password ');
        $user->execute($data);

        return $user->fetch(PDO::FETCH_ASSOC);
    }

    public static function allPointage()
    {
        return self::getConnection()
            ->query('SELECT id_p,heure_arriver,heure_descente,nom,prenom FROM pointage
            INNER JOIN employees ON pointage.id_emp = employees.id WHERE role = 0')
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function search(string $username)
    {
        $employees = self::getConnection()
            ->prepare('SELECT * FROM employees WHERE username LIKE ?');
        $employees->execute([$username]);

        return $employees->fetch();
    }

    public static function point($id)
    {
        $search = self::getConnection()
            ->prepare('SELECT etat  FROM pointage WHERE id_emp = ?');
        $search->execute([$id]);
        $result = $search->fetch();
        if ($result) {
            if ($result['etat'] == 0) {

                return self::getConnection()
                    ->prepare('UPDATE pointage SET etat = ? , heure_descente = ? WHERE id_emp = ?')
                    ->execute(['1', date('H:i:s'), $id]);
            }

            return false;
        } else {

            return self::getConnection()
                ->prepare('INSERT INTO pointage (heure_arriver,date_today,id_emp) VALUES (?,?,?)')
                ->execute([date('H:i:s'), date('Y-m-d'), $id]);
        }

        return false;
    }
}
