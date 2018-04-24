<?php

use Illuminate\Database\Seeder;

class UserTaBleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
       	['username'=>'huongnam9','email'=>'namdosatdn@gmail.com','password'=>bcrypt('123456'),'status'=>1,'created_by'=>'Nguyễn Hương Nam','fullname'=>'Nguyễn Hương Nam','picture'=>'nam.jpg','is_admin'=>1,'phone'=>'01263692989','address'=>'Đà Nẵng','maActive'=>''],
       	
       	['username'=>'dung','email'=>'tmndung@gmail.com','password'=>bcrypt('123456'),'status'=>1,'created_by'=>'Nguyễn Hương Nam','fullname'=>'Nguyễn Ngọc Dũng','picture'=>'dung.jpg','is_admin'=>0,'phone'=>'01263692989','address'=>'Đà Nẵng','maActive'=>''],
       	['username'=>'minhvuong','email'=>'minhvuong1503@gmail.com','password'=>bcrypt('123456'),'status'=>1,'created_by'=>'Nguyễn Hương Nam','fullname'=>'Nguyễn Minh Vương','picture'=>'vuong.jpg','is_admin'=>0,'phone'=>'01263692989','address'=>'Đà Nẵng','maActive'=>'']
     


       ]);
    }
}
