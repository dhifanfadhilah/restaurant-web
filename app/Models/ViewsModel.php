<?php namespace App\Models;
use CodeIgniter\Database\BaseBuilder;

class ViewsModel
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function getDinein()
    {
    
        $builder = $this->db->table('dinein');        
        $query = $builder->get();
        return $query; 
    }
    
    public function joinDinein()
    {
        
        $builder = $this->db->table('transaction');
        $builder->select('*');
        $builder->join('products','products.title = transaction.product');
        $query = $builder->get();
        return $query;
    }

}