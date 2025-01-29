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
                'name' => 'Carlos',
                'product' => 'Buque de 12 Rosas com Trigo',
                'receiver' => 'Andrea',
                'value' => '110,00',
                'status' => 'Aguardando Pagamento'
            ],
            [
                'id' => '02',
                'name' => 'Marcos',
                'product' => 'Buque de 6 girassóis',
                'receiver' => 'Paula',
                'value' => '70,00',
                'status' => 'Pagamento Confirmado'
            ],
            [
                'id' => '03',
                'name' => 'Julio',
                'product' => 'Buque Van Gohg',
                'receiver' => 'Carla',
                'value' => '135,00',
                'status' => 'Aguardando Pagamento'
            ],
            [
                'id' => '04',
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

}
