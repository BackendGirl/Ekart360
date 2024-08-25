<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeesCategory;
use App\Models\FeesFine;
use Toastr;
use DB;
use Exception;

class ProductReviewsController extends Controller
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
            $this->theme = $current_theme->slug;
            $this->theme_id = $current_theme->id; 
       } catch (\Throwable $th) {
          throw new Exception("505, Server Error");
         die;
       }


        // $this->middleware('permission:'.$this->access.'-view|'.$this->access.'-create|'.$this->access.'-edit|'.$this->access.'-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:'.$this->access.'-create', ['only' => ['create','store']]);
        // $this->middleware('permission:'.$this->access.'-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:'.$this->access.'-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['route'] = 'admin.product-reviews';
        $profile = DB::table('customer_reviews')
                ->select('customer_reviews.*','users.first_name','users.photo')
                ->orderBy('customer_reviews.id','desc')
                ->where('customer_reviews.theme',$this->theme_id)
                ->join('users','users.id','customer_reviews.user_id')
                ->get();
        $data['title'] = 'Customer Reviews';
        $data['profile'] = $profile;

        return view('admin.product_reviews.index', $data);
    }
 
    public function destroy(Request $request)
    { 

        if (! $request->hidden_id || $request->hidden_id == '') {
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
            return redirect()->back();
        }

        $id = $request->hidden_id;
        

        $status = DB::table('customer_reviews')->where('id',$id)->where('theme',$this->theme_id)->delete();
        if ($status) {
            Toastr::success('Data Deleted Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }        
        return redirect()->route('admin.product-reviews.index');
    }

}
