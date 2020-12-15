<?php
namespace MVC\Models;

use MVC\Config\Database;

class TaskResponsitory{
    protected $taskResourceModel;

    public function __construct()
    {
        $this->taskResourceModel = new TaskResourceModel();
    }

    public function add($model){
        return $this->taskResourceModel->save($model);
    }

    public function get($id){
        return $this->taskResourceModel->get($id);

    }

    public function delete($model){
        return $this->taskResourceModel->delete($model);
    }

    public function getAll(){
        return $this->taskResourceModel->get();
    }
}
