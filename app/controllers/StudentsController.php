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
            case 'create':
                $this->create();
                break;
            case 'update':
                $this->updateTable($urlParamId);
                break;
            case 'delete':
                $this->delete($urlParamId);
                break;
            case 'restore':
                $this->restore($urlParamId);
                break;
            case 'read_deleted':
                $this->viewDeleted();
                break;
        }
    }

    function get_all()
    {

        $data = $this->StudentsModel->all(true);
    
        $filteredData = array_filter($data, function ($row) {
            return empty($row['deleted_at']); 
        });

        if (!empty($filteredData)) {
            echo "<table border='1' cellpadding='6' cellspacing='0' style='border-collapse: collapse;'>";

            // Table Headers
            echo "<thead><tr>";
            foreach ($filteredData[0] as $column => $value) {
                if ($column !== 'deleted_at') {
                    echo "<th>" . htmlspecialchars($column) . "</th>";
                }
            }
            echo "</tr></thead>";

            // Table Rows
            echo "<tbody>";
            foreach ($filteredData as $row) {
                echo "<tr>";
                foreach ($row as $column => $value) {
                    if ($column !== 'deleted_at') {
                        echo "<td>" . htmlspecialchars($value) . "</td>";
                    }
                }
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>No active records found in lava_lust_test.</p>";
        }


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

    function viewDeleted()
    {
        echo "<pre>";
        var_dump($this->StudentsModel->all(true));
        echo "</pre>";
    }
}