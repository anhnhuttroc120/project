<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('category')->insert([
       	['name'=>'ĐẦM CÔNG SỞ','slug'=>'dam-cong-so','parent_id'=>0],
       	['name'=>'ĐẦM DẠO PHỐ-DỰ TIỆC','slug'=>'dam-dao-pho-du-tiec','parent_id'=>0],
       	['name'=>'ÁO SƠ MI','slug'=>'ao-so-mi','parent_id'=>1],
       	['name'=>'ĐỒ BỘ','slug'=>'do-bo','parent_id'=>3],


       ]);
    }
}
