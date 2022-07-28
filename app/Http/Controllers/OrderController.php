<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @param  \Illuminate\Http\Request  $request
     */
    public function index(Request $request)
    {

        $parameters = $request->all();

        // se la request è vuota allora non ho filtri quindi estraggo tutto

        if (count($parameters) === 0)
            return Order::all();


        // echo print_r($parameters);
        // exit;

        // array con campi ammessi nella query
        $fieldsPermits = [
            'destination_order',
            'data_Ordine'
        ];

        $tuttiIParametriEsistono = true;
        $conds = [];
        foreach ($parameters as $paramName => $paramValue) {
            if (in_array($paramName, $fieldsPermits)){
                $conds[] = [$paramName, '=', "$paramValue"];
            }else{
                $tuttiIParametriEsistono = false;
                break;
            }

        }

        if($tuttiIParametriEsistono){
            return Order::where($conds)->get();
        }else{
            return [];
        }

        

        // echo print_r($conds, true);

       
        // return [];

        

        // $orders = Order::where

        // se ho destionation_order faccio filtro per quello

        // return $request['destionation_order'];

        // return Order::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * [
     * {
     *    "dataOrdine": "24/07/2022",
     *    "paeseDestinazione": "Italy",
     *   "ordini": [
     *      {
     *         "idProdotto": 1,
     *        "quantity": 5
     *   },
     *  {
     *     "idProdotto": 2,
     *    "quantity": 3
     *  }
     * ]
     * }
     *]
     */
    public function store(Request $request)
    {

        // echo print_r($request->all()[0]['dataOrdine'], true);
        // exit;

        $data = $request->all()[0];


        // echo $data['dataOrdine'];
        // echo '<br/>';
        // echo (date('Y-m-d', strtotime($data['dataOrdine'])));
        // exit;

        list($d, $m, $y) = explode('/', $data['dataOrdine']);

        $orderFromDB = Order::create([
            'data_Ordine' => $y . '-' . $m . '-' . $d,
            'destination_order' => $data['paeseDestinazione'],
        ]);

        $orderId = $orderFromDB->id;

        // echo print_r($orderId, true);
        // exit;

        $orders = $data['ordini'];


        // echo print_r($orders, true);
        // exit;


        foreach ($orders as $order) {
            // echo print_r($order,true);
            // echo '<br/>';
            $rs = OrderProducts::create([
                'id_order' => $orderId,
                'id_product' => $order['idProdotto'],
                'quantity' => $order['quantity']
            ]);

            // echo print_r($rs, true);
            // echo '<br/>';
        }




        // exit;

        // return Order::create($request->all());

        return json_encode(['res' => 'ok']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->update($request->all());
        return $order;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Order::destroy($id);
    }
}
