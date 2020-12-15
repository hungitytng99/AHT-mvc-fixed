<?php
namespace MVC\Models;

use MVC\Core\ResourceModel;

class TaskResourceModel extends ResourceModel{
    public function __construct(){
        parent::__init("tasks", "id", new TaskModel());
    }
}
