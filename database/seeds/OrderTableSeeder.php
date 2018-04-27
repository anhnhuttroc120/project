<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('order')->insert([
    		['quantity'=>1,'status'=>0,'total'=>'10000','users_id'=>1,'address'=>'DN','phone'=>'012312312312','note'=>'new1','date_shipper'=>'2018-01-01'],
    		['quantity'=>2,'status'=>2,'total'=>'10000','users_id'=>1,'address'=>'QN','phone'=>'012312312312','note'=>'new1','date_shipper'=>'2018-02-01'],
    		['quantity'=>3,'status'=>1,'total'=>'10000','users_id'=>1,'address'=>'DN','phone'=>'012312312312','note'=>'new1','date_shipper'=>'2018-03-01'],
    		['quantity'=>4,'status'=>0,'total'=>'10000','users_id'=>1,'address'=>'DN','phone'=>'012312312312','note'=>'new1','date_shipper'=>'2018-04-01'],
    		['quantity'=>5,'status'=>2,'total'=>'10000','users_id'=>1,'address'=>'HP','phone'=>'012312312312','note'=>'new1','date_shipper'=>'2018-05-01'],
    		['quantity'=>6,'status'=>1,'total'=>'10000','users_id'=>1,'address'=>'DN','phone'=>'012312312312','note'=>'new1','date_shipper'=>'2018-06-01'],
    		['quantity'=>7,'status'=>0,'total'=>'10000','users_id'=>1,'address'=>'QB','phone'=>'012312312312','note'=>'new1','date_shipper'=>'2018-07-01'],
    		['quantity'=>8,'status'=>2,'total'=>'10000','users_id'=>1,'address'=>'HN','phone'=>'012312312312','note'=>'new1','date_shipper'=>'2018-08-01'],
    		['quantity'=>9,'status'=>1,'total'=>'10000','users_id'=>1,'address'=>'H','phone'=>'012312312312','note'=>'new1','date_shipper'=>'2018-09-01'],
    		['quantity'=>10,'status'=>0,'total'=>'10000','users_id'=>1,'address'=>'DN','phone'=>'012312312312','note'=>'new1','date_shipper'=>'2018-11-01'],
    	]);
    }
}
