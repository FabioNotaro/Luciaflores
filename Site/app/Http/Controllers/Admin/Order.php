<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Order extends Controller{
    
    public function index(Request $request){

        $args = [];

        $orders = [
            [
                'id' => '01',
                'order_number' => '000001',
                'name' => 'Carlos',
                'product' => 'Buque de 12 Rosas com Trigo',
                'receiver' => 'Andrea',
                'value' => '110,00',
                'status' => 'Aguardando Pagamento'
            ],
            [
                'id' => '02',
                'order_number' => '000002',
                'name' => 'Marcos',
                'product' => 'Buque de 6 girassóis',
                'receiver' => 'Paula',
                'value' => '70,00',
                'status' => 'Pagamento Confirmado'
            ],
            [
                'id' => '03',
                'order_number' => '000003',
                'name' => 'Julio',
                'product' => 'Buque Van Gohg',
                'receiver' => 'Carla',
                'value' => '135,00',
                'status' => 'Aguardando Pagamento'
            ],
            [
                'id' => '04',
                'order_number' => '000004',
                'name' => 'Alessandro',
                'product' => 'Mini Buque de Rosas',
                'receiver' => 'Bianca',
                'value' => '35,00',
                'status' => 'Cancelado'
            ],
        ];

        $args['orders'] = $orders;

        return view('admin', ['pagina' => 'order', 'args' => $args]);

    }

    public function store(Request $request){
        dd($request);
    }

}
