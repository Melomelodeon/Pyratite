<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class StudentsController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->call->model('StudentsModel');
    }
    function get_all($q = 1)
    {
        $data = $this->StudentsModel->all();
        $this->call->view('ui/get_all', ['users' => $data]);
    }
    function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'last_name' => $_POST['last_name'],
                'first_name' => $_POST['first_name'],
                'email' => $_POST['email']
            ];
            $this->StudentsModel->insert($data);
            redirect('users');
        }
        $this->call->view('ui/create');
    }
    function update($id)
    {
        $contents = $this->StudentsModel->find($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'last_name' => $_POST['last_name'],
                'first_name' => $_POST['first_name'],
                'email' => $_POST['email']
            ];
            $this->StudentsModel->update($id, $data);
            redirect('users');
        }
        $this->call->view('ui/update', ['user' => $contents]);
    }
    function delete($id)
    {
        $this->StudentsModel->soft_delete($id);
        redirect('users');
    }
}
