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
    }

    function selectFunction($ulrParam)
    {
        switch ($ulrParam) {
            case 'create':
                $this->call->view('StudentsViewPage');
                break;
        }
    }

    function get_all()
    {
    }

    function create()
    {
    }

    function update()
    {
    }

    function delete()
    {
    }
}