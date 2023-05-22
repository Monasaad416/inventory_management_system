<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $password = Hash::make('12345678');
            $suppliers =[['name'=>'Supp-1','phone' => '+12273334543','address' =>'address - 1', 'password' => $password],
                        ['name'=>'Supp-2','phone' => '+12222234567','address' =>'address - 2', 'password' => $password],
                        ['name'=>'Supp-3','phone' => '+1220229876','address' =>'address - 3', 'password' => $password],
                        ['name'=>'Supp-4','phone' => '+1622225432','address' =>'address - 4', 'password' => $password],
                        ['name'=>'Supp-5','phone' => '+172234533543','address' =>'address - 1', 'password' => $password],
                        ['name'=>'Supp-6','phone' => '+1222344664567','address' =>'address - 2', 'password' => $password],
                        ['name'=>'Supp-7','phone' => '+102296687446','address' =>'address - 3', 'password' => $password],
                        ['name'=>'Supp-8','phone' => '+612254783332','address' =>'address - 4', 'password' => $password],
                    ];
            foreach( $suppliers as $supplier){
                $supplier = User::create([
                    'name'=> $supplier['name'],
                    'phone'=>$supplier['phone'],
                    'address'=>$supplier['address'],
                    'password'=>$supplier['password'],
                    'roles_name' => ["supplier"],
                ]);
                $supplier->assignRole(["supplier"]);
            }
    }
}
