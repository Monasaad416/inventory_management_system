<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'dashboard',
            'store_payment_voucher',
           'supplier_payment_voucher',
           'clients_receipt_voucher',
           'total_voucher',
           'review',

           'clients_invoices_list',
           'add_clients_invoices',
           'edit_clients_invoices',
           'delete_clients_invoices',
           'show_clients_invoices',
           'print_clients_invoices',

           'suppliers_invoices_list',
           'add_suppliers_invoices',
           'edit_suppliers_invoices',
           'delete_suppliers_invoices',
           'show_suppliers_invoices',
           'print_suppliers_invoices',

           'roles_list',
           'add_roles',
           'edit_roles',
           'delete_roles',

           'founders_list',
           'add_founders',
           'edit_founders',
           'delete_founders',

           'shareholders_list',
           'add_shareholders',
           'edit_shareholders',
           'delete_shareholders',

           'suppliers_list',
           'add_suppliers',
           'edit_suppliers',
           'delete_suppliers',

           'clients_list',
           'add_clients',
           'edit_clients',
           'delete_clients',

           'financial',

           'section_list',
           'add_section',
           'edit_section',
           'delete_section',

           'products_list',
           'add_products',
           'edit_products',
           'delete_products',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
