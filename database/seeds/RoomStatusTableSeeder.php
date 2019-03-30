<?php

use Illuminate\Database\Seeder;
use App\RoomStatus;
class RoomStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoomStatus::insert([['name'=>'Public'],['name'=>'Private']]);
    }
}
