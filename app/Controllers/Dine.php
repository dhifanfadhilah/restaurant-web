<?php

namespace App\Controllers;
use App\Models\MenuModel;
use App\Models\OrderModel;

class Dine extends BaseController
{

    public function index()
    {
        $model = new MenuModel();
        $data['products'] = $model->getProducts();
        $notification['msg']  = [];
        return view('lib/header', $data, $notification)
            . view('dine-in')
            . view('lib/footer');
    }

    function create(){
        helper('form');
        $model = new MenuModel();
        $model_transactions = new OrderModel();
        $data['products'] = $model->getProducts();
        $title = $this->request->getVar('sets');
        $pax = $this->request->getVar('guests');
        $payment = $this->request->getVar('payment');
        $data_table = $model->where('title', $title)->first();
        if($data_table){
        if(!$this->validate([
                'fname' => 'required|max_length[255]',
                'email' => 'required|max_length[255]',
                'guests' => 'required|max_length[255]',
                'sets' => 'required|max_length[255]',
                'payment' => 'required|max_length[255]'
            ])){
        $notification['msg'] = ['danger','Form not fully fullfied'];
            return view('lib/header', $data)
            . view('dine-in',$notification)
            . view('lib/footer');
        }else if($title == '0'){
        $notification['msg'] = ['danger','You Didnt choose a product'];
            return view('lib/header', $data)
            . view('dine-in',$notification)
            . view('lib/footer');
        }else if($payment == '0'){
        $notification['msg'] = ['danger','You Didnt choose Payment Method'];
            return view('lib/header', $data)
            . view('dine-in',$notification)
            . view('lib/footer');
        }else if($payment !== 'Cashier'){
            $notification['msg'] = ['danger','You Didnt choose the right Payment Method'];
                return view('lib/header', $data)
                . view('dine-in',$notification)
                . view('lib/footer');
        }else{
        $dprice = $data_table['price'];
        $total_price = $dprice*$pax;
        $type = 'Dinein';
        $status = 'Waiting';
        $model_transactions->save([
                'full_name' => $this->request->getVar('fname'),
                'email' => $this->request->getVar('email'),
                'product' => $title,
                'total_pax' => $pax,
                'price' => $total_price,
                'type' => $type,
                'status' => $status,
                'payment' => $payment,
                'reserve_date' => date('Y-m-d H:i:s'),
                'order_date' => date('Y-m-d H:i:s')
        ]);
        $notification['msg'] = ['success','Transactions Success<br>Please wait to be seated by our waiter<br>
        Your Bill : Rp'.$total_price ];
        return view('lib/header', $data)
        . view('dine-in',$notification)
        . view('lib/footer');
    }
} else {
    $notification['msg'] = ['danger','You Didnt choose the right Product'];
    return view('lib/header', $data)
    . view('dine-in',$notification)
    . view('lib/footer');
}
} 
}