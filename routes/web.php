<?php

use Database\Seeders\ProductSeeder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FounderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ShareholderController;
use App\Http\Controllers\ClientInvoiceController;
use App\Http\Controllers\FounderAccountController;
use App\Http\Controllers\SupplierExpenseController;
use App\Http\Controllers\SupplierInvoiceController;
use App\Http\Controllers\ShareholderAccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
Route::get('/', function () {
       return view('auth.selection');
 })->name('selection');

//  Route::get('/login/{type}',[HomeController::class,'loginForm'])->name('login.show');
Route::get('/dashboard',[HomeController::class,'index'])->middleware(['auth'])->name('dashboard');
Route::get('/client/dashboard',[HomeController::class,'clientIndex'])->middleware(['auth'])->name('client.dashboard');
Route::get('/shareholder/dashboard',[HomeController::class,'shareholderIndex'])->middleware(['auth'])->name('shareholder.dashboard');
Route::get('/supplier/dashboard',[HomeController::class,'SupplierIndex'])->middleware(['auth'])->name('supplier.dashboard');

Route::get('/calculator',[HomeController::class,'calculator'])->middleware(['auth'])->name('calculator');

Route::middleware(['auth'])->group(function () {
    Route::get('getSuppliersBySection/{supplier_id}',[SupplierInvoiceController::class,'getSuppliersBySection']);
    Route::get('getProdsBySection/{section_id}',[SupplierInvoiceController::class,'getProdsBySection']);
    Route::get('getProdsBySection/{id}',[ClientInvoiceController::class,'getProdsBySection']);
    Route::get('getClientsBySection/{id}',[ClientInvoiceController::class,'getClientsBySection']);
    Route::get('getShareholdersByFounder/{id}',[ShareholderAccountController::class,'getShareholdersByFounder']);

    Route::resources([
        'roles' => RoleController::class,
        'suppliers-invoices' => SupplierInvoiceController::class,
        'clients-invoices' => ClientInvoiceController::class,
        'suppliers' => SupplierController::class,
        'stores' => StoreController::class,
        'sections' => SectionController::class,
        'products' => ProductController::class,
        'clients' => ClientController::class,
        'shareholders' => ShareholderController::class,
        'founders' => FounderController::class,
        'suppliers_expenses' => SupplierExpenseController::class,
        'founders_accounts' => FounderAccountController::class,
        'shareholders_accounts' => ShareholderAccountController::class,
    ]);

    Route::get('/suppliers-invoices/unpaid',[SupplierInvoiceController::class,'unpaid'])->name('suppliers-invoices.unpaid');
    Route::get('/suppliers-invoices/paid',[SupplierInvoiceController::class,'paid'])->name('suppliers-invoices.paid');

    Route::get('/suppliers-invoice-item/edit/{pivotId}',[SupplierInvoiceController::class,'editItem'])->name('suppliers-invoice-item.edit');

    Route::post('/suppliers-invoice-item/update',[SupplierInvoiceController::class,'updateItem'])->name('suppliers-invoice-item.update');

    // Route::post('/suppliers-invoice-item/return',[SupplierInvoiceController::class,'returnItem'])->name('suppliers-invoices-item.return');

    //return all qty of invoice item
    Route::get('/suppliers-invoice-item/return-view/{item_id}',[SupplierInvoiceController::class,'returnItemView'])->name('suppliers-invoices-item.return.view');
    Route::post('/suppliers-invoice-item/return',[SupplierInvoiceController::class,'returnItem'])->name('suppliers-invoices-item.return');
     //return part of qty of invoice item
    Route::get('/suppliers-invoice-item/return-part-view/{item_id}',[SupplierInvoiceController::class,'returnPartOfItemView'])->name('suppliers-invoices-item.return.part.view');
    Route::post('/suppliers-invoice-item/return-part',[SupplierInvoiceController::class,'returnPartOfItem'])->name('suppliers-invoices-item.return.part');
   //return all invoice items
    //Route::get('/suppliers-invoice/return-view/{invoice_id}',[SupplierInvoiceController::class,'returnInvoiceView'])->name('suppliers-invoice.return.view');
    Route::post('/suppliers-invoice/return',[SupplierInvoiceController::class,'returnInvoice'])->name('suppliers-invoice.return');


    //partially paid invoice
    Route::post('/suppliers-invoice/partially-paid',[SupplierInvoiceController::class,'partiallyPaidInvoice'])->name('suppliers-invoice.partially-paid');

    //client paid invoice
    Route::post('/clients-invoice/partially-paid',[ClientInvoiceController::class,'partiallyPaidInvoice'])->name('clients-invoice.partially-paid');
    //suppliers balance sheet
    Route::get('/suppliers/balance-sheet/{id}',[SupplierController::class,'balanceSheet'])->name('suppliers.balance-sheet');
    Route::post('/suppliers/balance-sheet/search',[SupplierController::class,'balanceSheetSearch'])->name('suppliers.balance-sheet.search');
    Route::get('/supplier/invoice/print/{invoice_id}',[SupplierInvoiceController::class,'printInvoice'])->name('print-invoice');
    Route::get('/client/invoice/print/{invoice_id}',[ClientInvoiceController::class,'printInvoice'])->name('print-client-invoice');

    //clients balance sheet
    Route::get('/clients/balance-sheet/{id}',[ClientController::class,'balanceSheet'])->name('clients.balance-sheet');
    Route::post('/clients/balance-sheet/search',[ClientController::class,'balanceSheetSearch'])->name('clients.balance-sheet.search');


    //founders balance sheet
    Route::get('/founders/balance-sheet/{id}',[FounderController::class,'balanceSheet'])->name('founders.balance-sheet');
    Route::post('/founders/balance-sheet/search',[FounderController::class,'balanceSheetSearch'])->name('founders.balance-sheet.search');


    //shareholders balance sheet
    Route::get('/shareholders/balance-sheet/{id}',[ShareholderController::class,'balanceSheet'])->name('shareholders.balance-sheet');
    Route::post('/shareholders/balance-sheet/search',[ShareholderController::class,'balanceSheetSearch'])->name('shareholders.balance-sheet.search');


    Route::get('/clients-invoices/unpaid',[ClientInvoiceController::class,'unpaid'])->name('clients-invoices.unpaid');
    Route::get('/clients-invoices/paid',[ClientInvoiceController::class,'paid'])->name('clients-invoices.paid');

    Route::get('/clients-invoice-item/edit/{pivotId}',[ClientInvoiceController::class,'editItem'])->name('clients-invoice-item.edit');


    Route::post('/clients-invoice-item/update',[ClientInvoiceController::class,'updateItem'])->name('clients-invoice-item.update');

    // Route::post('/clients-invoice-item/return',[ClientInvoiceController::class,'returnItem'])->name('clients-invoices-item.return');

    //return all qty of invoice item
    Route::get('/clients-invoice-item/return-view/{item_id}',[ClientInvoiceController::class,'returnItemView'])->name('clients-invoices-item.return.view');
    Route::post('/clients-invoice-item/return',[ClientInvoiceController::class,'returnItem'])->name('clients-invoices-item.return');
     //return part of qty of invoice item
    Route::get('/clients-invoice-item/return-part-view/{item_id}',[ClientInvoiceController::class,'returnPartOfItemView'])->name('clients-invoices-item.return.part.view');
    Route::post('/clients-invoice-item/return-part',[ClientInvoiceController::class,'returnPartOfItem'])->name('clients-invoices-item.return.part');
   //return all invoice items
    //Route::get('/clients-invoice/return-view/{invoice_id}',[ClientInvoiceController::class,'returnInvoiceView'])->name('clients-invoice.return.view');
    Route::post('/clients-invoice/return',[ClientInvoiceController::class,'returnInvoice'])->name('clients-invoice.return');

    Route::get('/clients-invoices/unpaid',[ClientInvoiceController::class,'unpaid'])->name('clients-invoices.unpaid');
    Route::get('/clients-invoices/paid',[ClientInvoiceController::class,'paid'])->name('clients-invoices.paid');
    Route::get('/clients-invoices/archived',[ClientInvoiceController::class,'archived'])->name('clients-invoices.archived');


    //livewire
    Route::view('/outcome','livewire.show_outcome')->name('outcome.livewire');
    Route::view('/income','livewire.show_income')->name('income.livewire');
    Route::view('/financial','livewire.show_financial')->name('financial.livewire');
    Route::view('/clients/account-statemene','livewire.show_statement')->name('show.statement.livewire');


    Route::get('/profile/edit/{id}',[ProfileController::class,'editProfile'])->name('profile.edit');
    Route::post('/profile/update/{id}',[ProfileController::class,'updateProfile'])->name('profile.update');




//     Route::post('calculate-sala-price', function(Request $request) {
//         foreach($request->input('product_ids') as $key=> $product_id){
//             $price = Product::where('id',$product->id)->first()->sale_price;
//             $qty =

//         }

//     $discount = $request->input('discount');

//     $totalPrice = $price - ($price * $discount / 100);

//     return response()->json(['totalPrice' => $totalPrice]);
// }); $price = $request->input('price');


});

require __DIR__.'/user_auth.php';
require __DIR__.'/client_auth.php';
require __DIR__.'/supplier_auth.php';
require __DIR__.'/founder_auth.php';
require __DIR__.'/shareholder_auth.php';


