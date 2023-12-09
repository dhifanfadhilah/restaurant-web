<?php namespace App\Models;
use CodeIgniter\Model;

    class AdminModel Extends Model{
        protected $table = 'user';
        protected $allowedFields = ['username','password'];

        public function getUsers($id= null){
            if(!$id){
               return $this->findAll(); 
            }

            return $this->asArray()
                        ->where(['id' => $id])
                        ->first();
        }
    }
