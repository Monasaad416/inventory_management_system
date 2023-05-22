<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('12345678');
        $clients =[['name'=>'client-1','phone' => '+734252543','address' =>'address - 1' , 'password' => $password],
                ['name'=>'client-2','phone' => '+234335567','address' =>'address - 2', 'password' => $password],
                ['name'=>'client-3','phone' => '+09448576','address' =>'address - 3', 'password' => $password],
                ['name'=>'client-4','phone' => '+63354532','address' =>'address - 4', 'password' => $password],
                ['name'=>'client-5','phone' => '+66544542','address' =>'address - 4', 'password' => $password],
                ['name'=>'client-6','phone' => '+222655562','address' =>'address - 4', 'password' => $password],
                ['name'=>'client-7','phone' => '+8766655','address' =>'address - 4', 'password' => $password],

            ];
        foreach( $clients as $client){
            $client = User::create([
                'name'=> $client['name'],
                'phone'=>$client['phone'],
                'address'=>$client['address'],
                'password'=>$client['password'],
                'roles_name' => ["client"],
            ]);


            $client->assignRole(["client"]);

        }
    }
}

