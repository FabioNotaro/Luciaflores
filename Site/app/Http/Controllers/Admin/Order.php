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
        $paymentType = [
            '1' => 'Dinheiro',
            '2' => 'Pix',
            '3' => 'Cartão de Débito',
            '4' => 'Cartão de Crédito',
            '5' => 'Link de Pagamento'
        ];

        $orders = $order->get();

        $args['orders']        = $orders;
        $args['paymentStatus'] = $paymentStatus;
        $args['paymentType']   = $paymentType;

        return view('admin', ['pagina' => 'order', 'args' => $args]);

    }

    public function store(Request $request){

        $dataOrders = $request->except('_token');
        
        $orderNumberBase = 000001;
        
        $order = new OrderTemporary();

        $orderNumber = $order->max('order_number');
        $orderNumber = !$orderNumber ? $orderNumberBase : $orderNumber + 1;
        $dataOrders['order_number'] = str_pad($orderNumber, 6, '0', STR_PAD_LEFT);

        if($order->insert($dataOrders)){
            return redirect('admin/order')->send();
        }else{
            dd('ERROR');
        };

        
        
    }

}
