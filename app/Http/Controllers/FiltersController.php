<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FiltersController extends Controller
{
    public function co2(Request $request)
    {

        $parameters = $request->all();
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        if (count($parameters) === 0)
            return DB::select('
            SELECT sum(round((products.co2 * order_products.quantity))) as co2tot
            FROM products join order_products on products.id = order_products.id_product
        ');

        $fieldsPermits = [
            'destination_order',
            'nome',
            'data_Ordine'

        ];

        $conds = [];

        foreach ($parameters as $paramName => $paramValue) {
            if (in_array($paramName, $fieldsPermits))
                $conds[] = "( {$paramName} = '{$paramValue}' )"; // da implementare controllo per SQL injection ma ci pensiamo dopo
        }

        // var_dump($startDate);
       if($startDate !== null && $endDate !== null)
        $conds[] = "( orders.data_Ordine between '{$request->start_date}' AND '{$request->end_date}' )"; // da implementare controllo per SQL injection ma ci pensiamo dopo


        // $sql = '
        //     SELECT sum(round((products.co2 * order_products.quantity))) as co2tot
        //     FROM products join order_products on products.id = order_products.id_product
        //     WHERE ' . join(' AND ', $conds);

        $sql = "
            SELECT SUM(round((products.co2 * order_products.quantity))) AS co2
                FROM
                orders
                    JOIN
                order_products ON orders.id = order_products.id_order
                    JOIN
                products ON order_products.id_product = products.id
                WHERE  " .  join(' AND ', $conds);
                // var_dump($sql);
        // . ' ORDER BY order_products.id_order, order_products.id_product';


        // $sqlDate = DB::select("
        // SELECT sum(round((products.co2 * order_products.quantity))) as co2tot
        // FROM products
        // JOIN order_products on products.id = order_products.id_product
        // JOIN orders on order_products.id_order = orders.id
        // WHERE orders.data_Ordine between '{$request->start_date}' and '{$request->end_date}'
        // ");
        // var_dump($sql);

        return DB::select($sql);
    }


    // public function forcountry()
    // {
    //     return DB::select('
    //         SELECT orders.destination_order, sum(round((products.co2 * order_products.quantity))) as co2tot
    //         FROM products
    //         JOIN order_products on products.id = order_products.id_product
    //         JOIN orders on order_products.id_order = orders.Id
    //         GROUP BY orders.destination_order
    //     ');
    // }

    // public function forproduct()
    // {
    //     return DB::select('
    //         SELECT products.nome, sum(round((products.co2 * order_products.quantity))) as co2tot
    //         FROM products
    //         JOIN order_products on products.id = order_products.id_product
    //         GROUP BY products.nome
    //     ');
    // }

    // public function fortemp(Request $request)
    // {
    //     return DB::select("
    //         SELECT sum(round((products.co2 * order_products.quantity))) as co2tot
    //         FROM products
    //         JOIN order_products on products.id = order_products.id_product
    //         JOIN orders on order_products.id_order = orders.id
    //         WHERE orders.data_Ordine between '{$request->start_date}' and '{$request->end_date}'
    //     ");
    // }
}
