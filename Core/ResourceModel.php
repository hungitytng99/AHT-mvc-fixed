<?php

namespace MVC\Core;

use MVC\Models\TaskModel;
use MVC\Config\Database;

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

    public function save($model)
    {
        // $IModel = new TaskModel();
        // $IModel->setId(1);
        // $IModel->setTitle("Title333");
        // $IModel->setDescription("Description");
        // $this->table = "tasks";
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
            foreach($keyData as $key){
                $setStatement .= $key ." = :" .$key;
                if(end($keyData) !== $key) $setStatement .= ", "; 
            }
            $sql = "UPDATE " . $this->table . " SET " . $setStatement . " WHERE id = :id";  
        }
       
        $req = Database::getBdd()->prepare($sql);
        return $req->execute($data);
    }

    public function delete($model)
    {
    }
}
