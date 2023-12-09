<?php
namespace App\Controllers;
use App\Models\AdminModel;
use App\Models\OrderModel;
use App\Models\ViewsModel;

class Admin extends BaseController
{
    public function index()
    {
        $session[] = session();
        $notification['msg']  = ['success','Welcome '];
        return view('./lib/header-admin',$session)
            . view('admin/index', $notification)
            . view('./lib/footer');
    }
function signup()
    {
             //include helper form
             helper(['form']);
             //set rules validation form
             $rules = [
                 'username'          => 'required|max_length[255]',
                 'password'      => 'required|max_length[255]'
             ];
              
             if($this->validate($rules)){
                 $model = new AdminModel();
                 $data = [
                     'username'     => $this->request->getVar('username'),
                     'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                     'created_at' => date('Y-m-d H:i:s')
                 ];
                 $model->save($data);
                 $notification['msg'] = ['success','Registration Success'];
                 return view('./lib/header-admin', $notification)
                 . view('admin/register')
                 . view('./lib/footer');
             }else{
                $notification['msg'] = ['danger','Registration failed'];
                return view('./lib/header-admin', $notification)
                . view('admin/register')
                . view('./lib/footer');
             }
              
         }
function login()
    {
        $session = session();
        $model = new AdminModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->where('username', $username)->first();
        if(isset($username)){
        if($data){
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $ses_data = [
                    'id'       => $data['id'],
                    'username'     => $data['username'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                $notification['msg'] = ['success','Welcome '.$data['username']];
                return view('./lib/header-admin', $notification)
                . view('admin/index')
                . view('./lib/footer');
            }else{
                $notification['msg'] = ['danger','Wrong Password'];
                return view('./lib/header-login', $notification)
                . view('admin/auth')
                . view('./lib/footer');
            }
        }else{
            $notification['msg'] = ['danger','Username Not Found'];
            return view('./lib/header-login', $notification)
            . view('admin/auth')
            . view('./lib/footer');
        }
    } else {
        return view('./lib/header-login')
        . view('admin/auth')
        . view('./lib/footer');
    }
    }
function logout()
    {
        $session = session();
        $session->destroy();
        return view('./lib/header-login')
            . view('admin/auth')
            . view('./lib/footer');
    }

function join(){
        $db = \Config\Database::connect();
      
}
// Get All Transactions
public function getTransactions()
{
        $model = new OrderModel();
        $data = $model->findAll();
        return json_encode($data);
}
// Get All Transactions
public function getViewDinein()
{
        $model = new ViewsModel();
        $all_data = $model->getDinein();
        return json_encode($all_data->getResult());
}
// get join product
public function getJoinDinein()
{
        $model = new ViewsModel();
        $all_data = $model->joinDinein();
        return json_encode($all_data->getResult());
}
// Update Transactions
public function update($id = null){
    $method = $this->request->getMethod(true);
    $model = new OrderModel();
    // Insert data to database if method "PUT"
    if($method == 'PUT'){
        $json = $this->request->getJSON();
        $data = [
            'status' => $json->status
        ];
        $model->update($id, $data);
    }else{
        // Call View "Edit Transactions" if method "GET"
        $notification['msg'] = ['success','Success Edit Id:'.$id];
        $data['data'] = $model->find($id);
        return view('./lib/header-admin', $data)
        . view('admin/edit', $notification)
        . view('./lib/footer');
    } 
}
function success(){
    $notification['msg'] = ['success','Success Edit Status'];
    return view('./lib/header-admin', $notification)
    . view('admin/index')
    . view('./lib/footer');
}
function Dinein(){
    return view('./lib/header-admin')
    . view('admin/Dinein')
    . view('./lib/footer');
}
function PDinein(){
    return view('./lib/header-admin')
    . view('admin/Dinein-photo')
    . view('./lib/footer');
}
// Delete Transactions
public function delete($id = null){
    $model = new OrderModel();
    $model->delete($id);
    $notification['msg'] = ['success','Success Deleted Id:'.$id];
    return view('./lib/header-admin', $notification)
    . view('admin/index')
    . view('./lib/footer');
}
    
}
