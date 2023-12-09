<?php namespace App\Models;
use CodeIgniter\Model;

    class OrderModel Extends Model{
        protected $primaryKey = 'id';
        protected $table = 'transaction';
        protected $allowedFields = ['full_name','email','product','total_pax','price','type','status','payment','reserve_date','order_date'];

        public function getTransaction($id= null){
            if(!$id){
               return $this->findAll(); 
            }

            return $this->asArray()
                        ->where(['id' => $id])
                        ->first();
        }
    }
