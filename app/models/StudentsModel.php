<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

/**
 * Model: StudentsModel
 * 
 * Automatically generated via CLI.
 */
class StudentsModel extends Model
{
    protected $table = '';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    function readDb()
    {
        return $this->db->table('lava_lust_test')->get_all();
    }

    function insertIntoDb()
    {
        $this->db->table('lava_lust_test')->insert([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com'
        ]);
    }

}