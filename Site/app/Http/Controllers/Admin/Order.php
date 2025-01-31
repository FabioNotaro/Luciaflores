<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderTemporary;

class Order extends Controller{
    
    public function index(){

        $args = [];
        $order = new OrderTemporary();
        $paymentStatus = [
            '1' => 'Aguardando Pagamento',
            '2' => 'Pagamento Confirmado'
        ];

        $orders = $order->get();

        $args['orders'] = $orders;
        $args['paymentStatus'] = $paymentStatus;

        return view('admin', ['pagina' => 'order', 'args' => $args]);

    }

    public function store(Request $request){

        $dataOrders = $request->except('_token');
        
        $orderNumberBase = 000001;
        
        $order = new OrderTemporary();

        $orderNumber = $order->max('order_number');
        $orderNumber = !$orderNumber ? $orderNumberBase : $orderNumber + 1;
        $dataOrders['order_number'] = $orderNumber;

        if($order->insert($dataOrders)){
            return redirect('admin/order')->send();
        }else{
            dd('ERROR');
        };

        
        
    }

}
