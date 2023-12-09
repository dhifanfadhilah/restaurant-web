<?php namespace App\Models;
use CodeIgniter\Model;

    class MenuModel Extends Model{
        protected $table = 'products';

        public function getProducts($title= null){
            if(!$title){
               return $this->findAll(); 
            }

            return $this->asArray()
                        ->where(['title' => $title])
                        ->first();
        }
    }
