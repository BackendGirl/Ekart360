<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostalExchange;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Complain;
use App\Models\PhoneLog;
use App\Models\Visitor;
use App\Models\Expense;
use App\Models\Enquiry;
use App\Models\Payroll;
use App\Models\Student;
use App\Models\Income;
use App\Models\Book;
use DB;
use App\Models\Fee;
use Carbon\Carbon;
use App\User;
use Exception;

class DashboardController extends Controller
{
   /**
   * Create a new controller instance.
   *
   * @return void
   */
   public function __construct()
   {
      // Module Data
      try {
        $current_theme = DB::table('themes')->where('current_theme',1)->first();
        if(!$current_theme){
            throw new Exception("505, Server Error");
            die;
        }

        $this->title = trans_choice('module_dashboard', 1);
        $this->route = 'admin.dashboard';
        $this->view = 'admin';
        $this->path = 'fees-fine';
        $this->access = 'fees-fine';
        $this->table_name = 'orders';
        $this->theme = 'bakery';                   
        $this->theme = $current_theme->slug;
        $this->theme_id = $current_theme->id;
        $this->storage_path = '/storage/photos/'.$this->theme.'/orders/';   
   } catch (\Throwable $th) {
      throw new Exception("505, Server Error");
     die;
   }
   }

   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
     //
     $data['title'] = $this->title;
     $data['route'] = 'calendar';

     $data['users'] = DB::table('users')->where('is_admin',0)->count();
     $data['products'] = DB::table('products')->where('theme',$this->theme_id)->count();
     $data['product_categories'] = DB::table('product_category')->where('theme',$this->theme_id)->count();
     $data['blogs'] = DB::table('blogs')->where('theme',$this->theme_id)->count();
     $data['blog_categories'] = DB::table('blog_category')->where('theme',$this->theme_id)->count();
     $data['orders'] = DB::table('orders')->where('theme',$this->theme_id)->count();
     $data['venders'] = DB::table('saller')->where('theme',$this->theme_id)->count();
     $data['customer_reviews'] = DB::table('customer_reviews')->where('theme',$this->theme_id)->count();
     $data['contacts'] = DB::table('contact')->where('theme',$this->theme_id)->count();
     $data['offers'] = DB::table('offers')->where('theme',$this->theme_id)->count();
     $data['notifications'] = DB::table('header_notifications')->where('theme',$this->theme_id)->count();
     $data['testimonials'] = DB::table('testimonials')->where('theme',$this->theme_id)->count();
     

     $data['settings'] = DB::table('settings')->where('theme',$this->theme_id)->first();

      return view($this->view.'.index', $data);
   }
}
