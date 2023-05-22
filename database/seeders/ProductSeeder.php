<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products =[
            ['product_code'=>'1','product_name'=>'product-1-1','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','section_id'=>'1','store_amount'=> 1000, 'sale_price'=>400, 'purchase_price'=>300],
            ['product_code'=>'2','product_name'=>'product-2-1','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','section_id'=>'1','store_amount'=> 1000 , 'sale_price'=>400,'purchase_price'=>300],
            ['product_code'=>'3','product_name'=>'product-3-1','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','section_id'=>'1','store_amount'=> 1000 , 'sale_price'=>400,'purchase_price'=>300],
            ['product_code'=>'4','product_name'=>'product-4-1','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','section_id'=>'1','store_amount'=> 1000 , 'sale_price'=>60,'purchase_price'=>34],

            ['product_code'=>'5','product_name'=>'product-1-2','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','section_id'=>'2','store_amount'=> 1000 ,'sale_price'=>60,'purchase_price'=>34],
            ['product_code'=>'6','product_name'=>'product-2-2','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','section_id'=>'2','store_amount'=> 1000 ,'sale_price'=>60,'purchase_price'=>54],
            ['product_code'=>'7','product_name'=>'product-3-2','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','section_id'=>'2','store_amount'=> 1000 ,'sale_price'=>80,'purchase_price'=>75],
            ['product_code'=>'8','product_name'=>'product-4-2','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','section_id'=>'2','store_amount'=> 1000 ,'sale_price'=>400,'purchase_price'=>334],

            ['product_code'=>'9','product_name'=>'product-1-3','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','section_id'=>'3','store_amount'=> 1000 ,'sale_price'=>600,'purchase_price'=>300],
            ['product_code'=>'10','product_name'=>'product-2-3','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','section_id'=>'3','store_amount'=> 1000 ,'sale_price'=>60,'purchase_price'=>54],
            ['product_code'=>'11','product_name'=>'product-3-3','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','section_id'=>'3','store_amount'=> 1000 ,'sale_price'=>60,'purchase_price'=>33],
            ['product_code'=>'12','product_name'=>'product-4-3','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','section_id'=>'3','store_amount'=> 1000 ,'sale_price'=>60,'purchase_price'=>22],

            ['product_code'=>'13','product_name'=>'product-1-4','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','section_id'=>'3','store_amount'=> 1000 ,'sale_price'=>70,'purchase_price'=>66],
            ['product_code'=>'14','product_name'=>'product-2-4','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','section_id'=>'3','store_amount'=> 1000 ,'sale_price'=>900,'purchase_price'=>876],
            ['product_code'=>'15','product_name'=>'product-3-4','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','section_id'=>'3','store_amount'=> 1000 ,'sale_price'=>600,'purchase_price'=>543],
            ['product_code'=>'16','product_name'=>'product-4-4','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','section_id'=>'3','store_amount'=> 1000 ,'sale_price'=>600,'purchase_price'=>344],



        ];

        foreach( $products as $product){
            Product::create([
                'product_name'=> $product['product_name'],
                'product_code'=> $product['product_code'],
                'description'=>$product['description'],
                'section_id'=>$product['section_id'],
                'store_amount'=>$product['store_amount'],
                'purchase_price'=>$product['purchase_price'],
                'sale_price'=>$product['sale_price'],
            ]);
        }
    }
}
