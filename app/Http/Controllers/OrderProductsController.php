<?php

namespace App\Http\Controllers;

use App\Models\OrderProducts;
use Illuminate\Http\Request;

class OrderProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OrderProducts::all();
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
     */
    public function store(Request $request)
    {
        return OrderProducts::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderProducts  $orderProducts
     * @return \Illuminate\Http\Response
     */
    public function show(OrderProducts $orderProducts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderProducts  $orderProducts
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderProducts $orderProducts)
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
        $orderP = OrderProducts::find($id);
        $orderP->update($request->all());
        return $orderP;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return OrderProducts::destroy($id);
    }
}
