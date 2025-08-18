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

    function selectFunction($urlParam, $urlParamId)
    {
        if (is_numeric($urlParamId)) {
            echo "<script>alert('" . htmlspecialchars("Current Id: $urlParamId", ENT_QUOTES) . "');</script>";
        } else {
            echo "<script>alert('Invalid ID: " . $urlParamId . "\\nID set to 0');</script>";
        }

        switch ($urlParam) {
            case 'read':
                $this->get_all();
                break;
            case 'write':
                $this->create();
                break;
            case 'update':
                $this->updateTable($urlParamId);
                break;
            case 'delete':
                $this->delete($urlParamId);
            case 'restore':
                $this->restore($urlParamId);
                break;
        }
    }

    function get_all()
    {
        echo "<pre>";
        var_dump($this->StudentsModel->all(true));
        echo "</pre>";
    }

    function create()
    {
        $this->StudentsModel->insert([
            'last_name' => 'insert_firstname',
            'first_name' => 'insert_lastname',
            'email' => 'test@example.com'
        ]);
        echo "<script>alert('New record added');</script>";
    }

    function updateTable($urlParamId)
    {
        $this->StudentsModel->update($urlParamId, [
            'last_name' => 'update_firstname',
            'first_name' => 'update_lastname',
            'email' => 'test@example.com'
        ]);
        echo "<script>alert('Record updated at $urlParamId');</script>";
    }

    function delete($urlParamId)
    {
        $this->StudentsModel->soft_delete($urlParamId);
        echo "<script>alert('Record deleted at $urlParamId');</script>";
    }

    function restore($urlParamId)
    {
        $this->StudentsModel->restore($urlParamId);
        echo "<script>alert('Record restored at $urlParamId');</script>";
    }
}