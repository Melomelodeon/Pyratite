<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

/**
 * Model: StudentsModel
 * 
 * Automatically generated via CLI.
 */
class StudentsModel extends Model
{
    protected $table = 'lava_lust_test';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    protected $has_soft_delete = true;
    protected $soft_delete_column = 'deleted_at';
}