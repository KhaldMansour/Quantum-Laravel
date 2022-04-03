<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
        [
            'title' => Str::random(10),
            'stock' => rand(2,50),
            'price' => rand(2,50),
            'is_active' => rand(0,1),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ],
        [
            'title' => Str::random(10),
            'stock' => rand(2,50),
            'price' => rand(2,50),
            'is_active' => rand(0,1),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ],    [
            'title' => Str::random(10),
            'stock' => rand(2,50),
            'price' => rand(2,50),
            'is_active' => rand(0,1),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ],    [
            'title' => Str::random(10),
            'stock' => rand(2,50),
            'price' => rand(2,50),
            'is_active' => rand(0,1),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ],    [
            'title' => Str::random(10),
            'stock' => rand(2,50),
            'price' => rand(2,50),
            'is_active' => rand(0,1),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ],    [
            'title' => Str::random(10),
            'stock' => rand(2,50),
            'price' => rand(2,50),
            'is_active' => rand(0,1),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ],    [
            'title' => Str::random(10),
            'stock' => rand(2,50),
            'price' => rand(2,50),
            'is_active' => rand(0,1),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ],    [
            'title' => Str::random(10),
            'stock' => rand(2,50),
            'price' => rand(2,50),
            'is_active' => rand(0,1),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ],    [
            'title' => Str::random(10),
            'stock' => rand(2,50),
            'price' => rand(2,50),
            'is_active' => rand(0,1),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ],    [
            'title' => Str::random(10),
            'stock' => rand(2,50),
            'price' => rand(2,50),
            'is_active' => rand(0,1),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ],
        ]);

        for ($x = 1; $x <= 10; $x++) {
            DB::table('category_product')->insert([
                'product_id' => $x,
                'category_id' => rand(1,3),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }
}
