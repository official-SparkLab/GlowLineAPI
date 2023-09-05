<?php

use App\Http\Controllers\All_Products_Controller;
use App\Http\Controllers\Bank_Details_Controller;
use App\Http\Controllers\Cashbook_Controller;
use App\Http\Controllers\Company_Details_Controller;
use App\Http\Controllers\Customer_Controller;
use App\Http\Controllers\Employee_Advance_Payment_Controller;
use App\Http\Controllers\Employee_Attendence_Controller;
use App\Http\Controllers\Employee_Details_Controller;
use App\Http\Controllers\Employee_Payment_Controller;
use App\Http\Controllers\Expense_Controller;
use App\Http\Controllers\Sale_Details_Controller;
use App\Http\Controllers\Sales_Product_Controller;
use App\Http\Controllers\Supplier_Controller;
use App\Models\Sales_Product_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Cashbook API .................
Route::post('/addCashbook',[Cashbook_Controller::class,'addCashbookDetails']);

Route::get('/fetchCashbook',[Cashbook_Controller::class,'fetchAllCashbook']);

Route::get('/fetchCashbook/{cb_id}',[Cashbook_Controller::class,'fetchById']);

Route::put('/deleteCashbook/{cb_id}',[Cashbook_Controller::class,'deleteCashBook']);

Route::put('/addCashbook/{cb_id}',[Cashbook_Controller::class,'updateCashbook']);   


// Expense Master Api

Route::post('/addExpense',[Expense_Controller::class,'addExpenseDetails']);

Route::get('/fetchExpense',[Expense_Controller::class,'fetchAllExpense']);

Route::get('/fetchExpense/{exp_id}',[Expense_Controller::class,'fetchById']);

Route::put('/deleteExpense/{exp_id}',[Expense_Controller::class,'deleteExpense']);

Route::put('/addExpense/{exp_id}',[Expense_Controller::class,'updateExpense']);   


// Supplier API

Route::post('/addSupplier',[Supplier_Controller::class,'addSupplier']);

Route::get('/fetchSupplier',[Supplier_Controller::class,'fetchAllSupplier']);

Route::get('/fetchSupplier/{sup_id}',[Supplier_Controller::class,'fetchById']);

Route::get('/fetchSupplierByName/{sup_name}',[Supplier_Controller::class,'fetchByName']);

Route::put('/deleteSupplier/{sup_id}',[Supplier_Controller::class,'deleteSupplier']);

Route::put('/addSupplier/{sup_id}',[Supplier_Controller::class,'updatesupplier']);   


// Customer API
Route::post('/addCustomer',[Customer_Controller::class,'addCustomer']);

Route::get('/fetchCustomer',[Customer_Controller::class,'fetchAllCustomer']);

Route::get('/fetchCustomer/{cust_id}',[Customer_Controller::class,'fetchById']);

Route::put('/deleteCustomer/{cust_id}',[Customer_Controller::class,'deleteCustomer']);

Route::put('/addCustomer/{cust_id}',[Customer_Controller::class,'updateCustomer']);  


//Employee Details Api

Route::post('/addEmployee',[Employee_Details_Controller::class,'addEmployee']);

Route::get('/fetchEmployee',[Employee_Details_Controller::class,'fetchAllEmployee']);

Route::get('/fetchEmployee/{emp_id}',[Employee_Details_Controller::class,'fetchById']);

Route::put('/deleteEmployee/{emp_id}',[Employee_Details_Controller::class,'deleteEmployee']);

Route::put('/addEmployee/{emp_id}',[Employee_Details_Controller::class,'updateCustomer']);  


// Employee Payment Api

Route::post('/addEmployeePayment',[Employee_Payment_Controller::class,'addEmployeePayment']);

Route::get('/fetchEmployeePayment',[Employee_Payment_Controller::class,'fetchAllEmployeePayment']);

Route::get('/fetchEmployeePayment/{emp_id}',[Employee_Payment_Controller::class,'fetchById']);

Route::put('/deleteEmployeePayment/{emp_id}',[Employee_Payment_Controller::class,'deleteEmployeePayment']);

Route::put('/addEmployeePayment/{emp_id}',[Employee_Payment_Controller::class,'updateCustomerPayment']);  

// Employee Advance Payment Api

Route::post('/addEmployeeAdvPayment',[Employee_Advance_Payment_Controller::class,'addEmployeeAdvPayment']);

Route::get('/fetchEmployeeAdvPayment',[Employee_Advance_Payment_Controller::class,'fetchAllEmployeeAdvPayment']);

Route::get('/fetchEmployeeAdvPayment/{emp_id}',[Employee_Advance_Payment_Controller::class,'fetchById']);

Route::put('/deleteEmployeeAdvPayment/{emp_id}',[Employee_Advance_Payment_Controller::class,'deleteEmployeeAdvPayment']);

Route::put('/addEmployeeAdvPayment/{emp_id}',[Employee_Advance_Payment_Controller::class,'updateCustomerAdvPayment']);  

// Employee Attendence Api

Route::post('/addEmployeeAttendence',[Employee_Attendence_Controller::class,'addEmployeeAttendence']);

Route::get('/fetchEmployeeAttendence',[Employee_Attendence_Controller::class,'fetchAllEmployeeAttendence']);

Route::get('/fetchEmployeeAttendence/{emp_id}',[Employee_Attendence_Controller::class,'fetchById']);

Route::put('/deleteEmployeeAttendence/{emp_id}',[Employee_Attendence_Controller::class,'deleteEmployeeAttendence']);

Route::put('/addEmployeeAttendence/{emp_id}',[Employee_Attendence_Controller::class,'updateCustomerAttendence']);  



// Company API .................
Route::post('/addCompany',[Company_Details_Controller::class,'addCompanyDetails']);

Route::get('/fetchCompany',[Company_Details_Controller::class,'fetchAllCompany']);

Route::get('/fetchCompany/{com_id}',[Company_Details_Controller::class,'fetchById']);

Route::put('/deleteCompany/{com_id}',[Company_Details_Controller::class,'deleteCompany']);

Route::put('/addCompany/{com_id}',[Company_Details_Controller::class,'updateCompany']);   


// Bankdetails API .................
Route::post('/addBankDetails',[Bank_Details_Controller::class,'addBankDetails']);

Route::get('/fetchBankDetails',[Bank_Details_Controller::class,'fetchAllBankDetails']);

Route::get('/fetchBankDetailsy/{bank_id}',[Bank_Details_Controller::class,'fetchById']);

Route::put('/deleteBankDetails/{bank_id}',[Bank_Details_Controller::class,'deleteBankDetails']);

Route::put('/addBankDetails/{bank_id}',[Bank_Details_Controller::class,'updateBankDetails']); 

// Product Details Api

Route::post('/addProduct',[All_Products_Controller::class,'addProduct']);

Route::get('/fetchProducts',[All_Products_Controller::class,'fetchAllProducts']);

Route::get('/fetchProductsForSale',[All_Products_Controller::class,'fetchProductForSale']);

Route::get('/fetchProductsForPurchase',[All_Products_Controller::class,'fetchProductForPurchase']);



Route::get('/fetchProduct/{p_id}',[All_Products_Controller::class,'fetchById']);

Route::put('/deleteProducts/{p_id}',[All_Products_Controller::class,'deleteProduct']);

Route::put('/addProduct/{p_id}',[All_Products_Controller::class,'updateProduct']); 

// Sale Details Api

Route::post('/addSale',[Sale_Details_Controller::class,'addSaleEntry']);

Route::get('/fetchSale',[Sale_Details_Controller::class,'fetchAllProducts']);
Route::get('/fetchSale/{invoice_no}',[Sale_Details_Controller::class,'fetchById'] )
    ->where('invoice_no', '.*');


// Sale Product Api

Route::post('/addSaleProduct',[Sales_Product_Controller::class,'addProduct']);

Route::get('/fetchSaleProduct',[Sales_Product_Controller::class,'fetchAllProducts']);

Route::get('/fetchSaleProduct/{invoice_no}',[Sales_Product_Controller::class,'fetchById']) ->where('invoice_no', '.*');;