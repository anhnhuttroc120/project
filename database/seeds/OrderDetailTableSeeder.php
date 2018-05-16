<?php

use Illuminate\Database\Seeder;

class OrderDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	DB::table('order_detail')->insert([
       		['quantity'=>1,'order_id'=>5,'products_id'=>1,'total'=>'150000'],
       		['quantity'=>2,'order_id'=>6,'products_id'=>2,'total'=>'400000'],
       		['quantity'=>1,'order_id'=>7,'products_id'=>3,'total'=>'300000'],
       		['quantity'=>2,'order_id'=>7,'products_id'=>1,'total'=>'300000'],
       		['quantity'=>1,'order_id'=>8,'products_id'=>3,'total'=>'300000'],
       		['quantity'=>2,'order_id'=>5,'products_id'=>2,'total'=>'400000'],
       		['quantity'=>1,'order_id'=>6,'products_id'=>1,'total'=>'150000'],
       		['quantity'=>2,'order_id'=>7,'products_id'=>1,'total'=>'300000'],
       		['quantity'=>1,'order_id'=>5,'products_id'=>1,'total'=>'150000'],
       		['quantity'=>2,'order_id'=>6,'products_id'=>1,'total'=>'300000'],
       	]);
    }
}
