<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

/**
 * Controller: StudentsController
 * 
 * Automatically generated via CLI.
 */
class StudentsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('StudentsModel');
    }

    function selectFunction($ulrParam)
    {
        switch ($ulrParam) {
            case 'read':
                $this->get_all();
                break;
            case 'write':
                $this->create();
                break;
        }
    }

    function get_all()
    {
        echo "<pre>";
        var_dump($this->StudentsModel->readDb());
        echo "</pre>";
    }

    function create()
    {
        $this->StudentsModel->insertIntoDb();
    }

    function update()
    {
        $this->call->view('welcome_page');
    }

    function delete()
    {
        $this->call->view('welcome_page');
    }
}