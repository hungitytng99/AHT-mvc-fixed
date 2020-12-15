<?php

namespace MVC\Controllers;

use MVC\Core\Controller;
use MVC\Models\TaskModel;
use MVC\Models\TaskResponsitory;

class TasksController extends Controller
{
    private $taskResponsity;

    public function __construct()
    {
        $this->taskResponsity = new TaskResponsitory();
    }
    function index()
    {
        $d['tasks'] = $this->taskResponsity->getAll();
        $this->set($d);
        $this->render("index");
    }

    function create()
    {
        if (isset($_POST["title"])) {
            $this->taskResponsity = new TaskResponsitory();
            $taskModel = new TaskModel();
            $taskModel->setTitle($_POST["title"]);
            $taskModel->setDescription($_POST["description"]);
            if ($this->taskResponsity->add($taskModel)) {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->render("create");
    }

    function edit($id)
    {
        $this->taskResponsity = new TaskResponsitory();
        $d["task"] = $this->taskResponsity->get($id);
        

        if (isset($_POST["title"])) {
            $taskModel = new TaskModel();
            $taskModel->setId($id);
            $taskModel->setTitle($_POST["title"]);
            $taskModel->setDescription($_POST["description"]);
            if ($this->taskResponsity->add($taskModel)) {
                header("Location: " . WEBROOT . "tasks/index");
                
            }
        }
        $this->set($d);
        $this->render("edit");
    }

    function delete($id)
    {
        $this->taskResponsity = new TaskResponsitory();
        $taskModel = new TaskModel();
        $taskModel->setId($id);
        if ($this->taskResponsity->delete($taskModel)) {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }
}
