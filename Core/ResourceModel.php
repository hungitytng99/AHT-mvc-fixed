<?php

namespace MVC\Core;

use MVC\Config\Database;
use PDO;

class ResourceModel implements ResourceModelInterface
{
    protected $table;
    protected $id;
    protected $model;


    public function __init($table, $id, $model)
    {
        $this->table = $table;
        $this->id = $id;
        $this->model = $model;
    }

    public function get($id = null)
    {
        if (is_null($id)) {
            $sql = "SELECT * FROM " . $this->table;
            $req = Database::getBdd()->prepare($sql);
            $req->execute();
            return $req->fetchAll(PDO::FETCH_OBJ);
        } else {
            $sql = "SELECT * FROM " . $this->table . " WHERE id =" . $id;
            $req = Database::getBdd()->prepare($sql);
            $req->execute();
            return $req->fetch();
        }
    }

    public function save($model)
    {
        $data = $model->getProperties();
        $keyData = array_keys($data);
        unset($keyData[0]);
        if (is_null($data['id'])) {
            unset($data['id']);
            $data['created_at'] = date('Y-m-d H:i:s');

            $tableColumnComma = implode(", ", $keyData);
            $tableColumnDots = ":" . implode(", :", $keyData);
            $sql = "INSERT INTO " .  $this->table .  "(" . $tableColumnComma . ") VALUES (" . $tableColumnDots . ")";
        } else {
            $data['updated_at'] = date('Y-m-d H:i:s');
            unset($data['created_at']);
            $keyData = array_keys($data);
            unset($keyData[0]);

            $setStatement = "";
            foreach ($keyData as $key) {
                $setStatement .= $key . " = :" . $key;
                if (end($keyData) !== $key) $setStatement .= ", ";
            }
            $sql = "UPDATE " . $this->table . " SET " . $setStatement . " WHERE id = :id";
        }
        $req = Database::getBdd()->prepare($sql);
        return $req->execute($data);
    }

    public function delete($model)
    {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE id = ?';
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$model->getId()]);
    }
}
