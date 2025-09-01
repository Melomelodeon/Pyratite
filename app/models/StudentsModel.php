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

    public function count_all_records()
    {
        $count_sql = "SELECT COUNT(id) as total FROM {$this->table} WHERE {$this->deleted_at} IS NULL";
        $count_result = $this->db->raw($count_sql);
        return $count_result ? $count_result->fetch(PDO::FETCH_ASSOC)['total'] : 0;
    }
    public function get_records_with_pagination($limit_clause)
    {
        $data_sql = "SELECT * FROM {$this->table} WHERE {$this->deleted_at} IS NULL ORDER BY id DESC {$limit_clause}";
        $data_result = $this->db->raw($data_sql);
        return $data_result ? $data_result->fetchAll(PDO::FETCH_ASSOC) : [];
    }

}