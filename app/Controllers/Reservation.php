<?php

namespace App\Controllers;
use App\Models\MenuModel;
use App\Models\OrderModel;

class Reservation extends BaseController
{
    public function index()
    {
    

        $model = new MenuModel();
        $data['products'] = $model->getProducts();
        $notification['msg']  = [];
        return view('lib/header', $data,$notification)
            . view('reservation')
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
        $emails = $this->request->getVar('email');
        $fname = $this->request->getVar('fname');
        $rdate = $this->request->getVar('reservedate');
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
            . view('reservation',$notification)
            . view('lib/footer');
        }else if($title == '0'){
        $notification['msg'] = ['danger','You Didnt choose a product'];
            return view('lib/header', $data)
            . view('reservation',$notification)
            . view('lib/footer');
        }else if($payment == '0'){
        $notification['msg'] = ['danger','You Didnt choose Payment Method'];
            return view('lib/header', $data)
            . view('reservation',$notification)
            . view('lib/footer');
        }else{
        $dprice = $data_table['price'];
        $total_price = $dprice*$pax;
        $type = 'Dinein';
        $status = 'Waiting';
        if ($payment == 'Cashier') {
            $howtopay = 'Payment will be billed on the cashier.';
        } else {
            $howtopay = 'Please finished your payment by to our BCA 2861271389 A/n Mays Restaurant';
        }
        $email = \Config\Services::email();
        $config["protocol"] = "smtp";
        $config["SMTPHost"]  = "smtp.zoho.com";
        $config["SMTPUser"]  = "amegaputra@zohomail.com"; 
        $config["SMTPPass"]  = "akmal4503"; 
        $config["SMTPPort"]  = 465;
        $config["SMTPCrypto"] = "ssl";
        $email->initialize($config);       
        $email->setFrom('amegaputra@zohomail.com', 'Casa De Aminda');
        $email->setTo($emails);
        $email->setSubject('Thank U for Your Reservations');
        $email->setMessage('Hi, Here is the Reservation info.
                             Reservation Date '.$rdate.'
                             Set menu '.$title.' 
                             Total Pax '.$pax.' 
                             Total Bill Rp'.$total_price.'
                             '.$howtopay.'
                             Thank u For your reservations'
                             );
        if($email->send()){
        $model_transactions->save([
                'full_name' => $fname,
                'email' => $emails,
                'product' => $title,
                'total_pax' => $pax,
                'price' => $total_price,
                'type' => $type,
                'status' => $status,
                'payment' => $payment,
                'reserve_date' => $this->request->getVar('reservedate'),
                'order_date' => date('Y-m-d H:i:s')
        ]);
        $notification['msg'] = ['success','Transactions Success<br>Please check your Email<br>
        Your Bill : Rp'.$total_price ];
        return view('lib/header', $data)
        . view('reservation',$notification)
        . view('lib/footer');
    } else {
        $debug = $email->printDebugger();
        $notification['msg'] = ['danger','Mail Not Sent, Your Transactions'.$debug];
        return view('lib/header', $data)
        . view('reservation',$notification)
        . view('lib/footer');
    }
    }
} else {
    $notification['msg'] = ['danger','You Didnt choose the right Product'];
    return view('lib/header', $data)
    . view('reservation',$notification)
    . view('lib/footer');
}
} 

}
