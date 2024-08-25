<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Carbon\Carbon;
use Session;
use DB;
use URL;
use Hash;
use Crypt;
use Toastr;
use Redirect;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
class UserController extends Controller
{   
    public function __construct()
    {
        // Module Data
        try {
            $current_theme = DB::table('themes')->where('current_theme',1)->first();
            if(!$current_theme){
                throw new Exception("505, Server Error");
                die;
            }
            $settings = DB::table('settings')->first(); 
            $this->site_name = $settings->title;            
            $this->theme = $current_theme->slug;
            $this->theme_id = $current_theme->id;
            $this->storage_path = '/storage/photos/'.$this->theme.'/users/';

            $this->expiry_date = strtotime(date('d-m-Y'));

       } catch (\Throwable $th) {
          throw new Exception("505, Server Error");
         die;
       }


        // $this->middleware('permission:'.$this->access.'-view|'.$this->access.'-create|'.$this->access.'-edit|'.$this->access.'-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:'.$this->access.'-create', ['only' => ['create','store']]);
        // $this->middleware('permission:'.$this->access.'-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:'.$this->access.'-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request){ 
        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        $data['title'] = 'Dashboard | '. $settings->meta_title;           
        $data['breadcrumb_title'] = 'My Dashboard';  
        $data['theme']  = $this->theme_id;    
        $data['route']  = 'user.user_dashboard';    
        $data['provinces'] = DB::table('provinces')->where('status',1)->orderBy('title','asc')->get();

        $user_id = Auth()->user()->id;

        $data['total_orders'] = DB::table('orders')->where('status','active')->where('user_id',$user_id)->where('theme',$this->theme_id)->count();
        $data['total_pending_orders'] = DB::table('orders')->where('status','active')->where('order_status','new')->where('theme',$this->theme_id)->where('user_id',$user_id)->count();
        $data['orders'] = DB::table('orders')->where('theme',$this->theme_id)->where('user_id',$user_id)->orderBy('id','desc')->get();

        $total_wishlist_count = 0;
        if(session()->get('wishlist')){
            $wishlist = session()->get('wishlist');
            // dd($wishlist);
            foreach ($wishlist as $key => $value) {
                foreach($value as $value2){
                    $total_wishlist_count ++;
                }               
                
            }         
        }

           //header-data-start
           $data['product_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->get();                                            
           $data['product_categories_footer'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->limit(4)->get();                                            
           $data['daily_staples'] = DB::table('products')->where('status','active')->where('is_daily_staples',1)->where('theme',$this->theme_id)->limit(6)->get();
           $data['top_save_products'] = DB::table('products')
                                           ->where('products.status','active')
                                           ->where('products.theme',$this->theme_id)
                                           ->orderBy('product_price.price','asc')
                                           ->join('product_price','product_price.product_id','products.id')
                                           ->limit(6)->get();  
           $data['recently_added_products'] = DB::table('products')->where('status','active')->orderBy('id','desc')->where('theme',$this->theme_id)->limit(6)->get();     
           $data['all_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->orderBy('title')->get();
           $data['deals'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('deal_of_the_day', 1)->get();           
           $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('date','>=',$this->expiry_date)->get();           
           //header-data-end

        $data['total_wishlist_count'] = $total_wishlist_count;
        
        $data['user_addresses'] = DB::table('user_addresses')
                                    ->select('user_addresses.*','provinces.title as state_title')
                                    ->where('user_addresses.status','active')
                                    ->where('user_addresses.user_id',$user_id)
                                    ->where('user_addresses.theme',$this->theme_id)
                                    ->join('provinces','provinces.id','user_addresses.state')
                                    ->orderBy('user_addresses.id','desc')->get(); 
                                    
                                    $cart_count = 0;
                                    $wishlist_count = 0;
                                    $total_cart_price = 0;
                         
                                    if(session()->get('wishlist')){            
                                     foreach(session()->get('wishlist') as $wishlist_key=>$value){
                                         if($wishlist_key == $this->theme_id){
                                             foreach ($value as $value2) {
                                                 foreach ($value2 as $value3) {
                                                     $wishlist_count++;
                                                 }
                                             }
                                         }
                                     }
                                     }
                                 
                                     if(session()->get('cart')){
                                         foreach(session()->get('cart') as $cart_key=>$value){
                                             if ($cart_key == $this->theme_id) {
                                                 foreach ($value as $key => $value2) {
                                                     foreach ($value2 as $value3) {
                                                         $cart_count++;
                                                     }
                                                 }
                                             }
                                         }
                                     }
                                  
                                     if(session()->get('cart')){                    
                                             foreach (session()->get('cart') as $key => $value) {
                                                if ($key == $this->theme_id) {
                                                 foreach($value as $value2){                            
                                                     foreach ($value2 as $value3) {
                                                         $total_cart_price += $value3['price']*$value3['quantity'];
                                                     }
                                                 }     
                                                }          
                                                 
                                             }         
                                         }
                         
                                         $data['cart_count'] = $cart_count;
                                         $data['wishlist_count'] = $wishlist_count;
                                         $data['total_cart_price'] = $total_cart_price;                                    
        
        return view('frontend.pages.user.dashboard',$data);
    }
   
    public function add_user_address(Request $req){
        $this->validate($req,[
            'name'=>'string|required',
            'phone'=>'numeric|required|digits:10',
            'house_no'=>'required',
            'area'=>'required',
            'landmark'=>'required',
            'pin_code'=>'required',
            'town_city'=>'required',
            'state'=>'required',
        ]);

        $user_id = Auth()->user()->id;
                        
        $status = DB::table('user_addresses')
        ->insert([
            'name'=>$req->get('name'),
            'phone'=>$req->get('phone'),
            'house_no'=>$req->get('house_no'),
            'area'=>$req->get('area'),
            'landmark'=>$req->get('landmark'),
            'pin_code'=>$req->get('pin_code'),
            'town_city'=>$req->get('town_city'),
            'state'=>$req->get('state'),
            'address_type'=>$req->get('address_type'),
            'user_id'=>$user_id,
            'theme'=>$this->theme_id,
        ]); 
            
        if($status){
            Toastr::success('Your address added successfully !!!', __('msg_success'));
        }
        else{
            Toastr::error('Please try again !!!', __('msg_error'));
        }
        return redirect()->back();
    }

    public function update_user_address(Request $req){
        $this->validate($req,[
            'name'=>'string|required',
            'phone'=>'numeric|required|digits:10',
            'house_no'=>'required',
            'area'=>'required',
            'landmark'=>'required',
            'pin_code'=>'required',
            'town_city'=>'required',
            'state'=>'required',
        ]);

                        
        $status = DB::table('user_addresses')->where('id',$req->address_id)->where('theme',$this->theme_id)
        ->update([
            'name'=>$req->get('name'),
            'phone'=>$req->get('phone'),
            'house_no'=>$req->get('house_no'),
            'area'=>$req->get('area'),
            'landmark'=>$req->get('landmark'),
            'pin_code'=>$req->get('pin_code'),
            'town_city'=>$req->get('town_city'),
            'state'=>$req->get('state'),
            'address_type'=>$req->get('address_type'),
        ]); 
            
        if($status){
            Toastr::success('Your address updated successfully !!!', __('msg_success'));
        }
        else{
            Toastr::error('Please try again !!!', __('msg_error'));
        }
        return redirect()->back();
    }

    public function remove_user_address($id = null){
        if ($id == null) {
            Toastr::error('Please try again !!!', __('msg_error'));
            return redirect()->back();
        }
        $status = DB::table('user_addresses')->where('id',$id)->where('theme',$this->theme_id)->delete(); 
        if($status){
            Toastr::success('Your address successfully deleted !!!', __('msg_success'));
        }
        else{
            Toastr::error('Please try again !!!', __('msg_error'));
        }       
        return redirect()->back();
    }

    public function update_profile(Request $req){
        $this->validate($req,[
            'name'=>'string|required',
            'phone'=>'numeric|required|digits:10',
            'email'=>'required|email',
        ]);

        $user_id = Auth()->user()->id;

        if ($req->old_password) {
            if(!Auth::attempt(['email' => $req->email, 'password' => $req->old_password])){ 
                Toastr::success('Your old password did not match to our records, please try again !!!', __('msg_success'));
                return redirect()->back();
            }else{
                $this->validate($req,[
                    'password'=>'required',
                ]);
        
            }
        }

        if ($req->hasFile('photo') && $req->file('photo')->isValid()) {           
            $imageName = $this->storage_path.$req->photo->getClientOriginalName();            
            $req->photo->move(public_path($this->storage_path), $imageName);
        }else{
            $imageName = $req->hidden_photo;
        } 
     
            try {
                $status = DB::table('users')->where('id',$user_id)->where('theme',$this->theme_id)
                ->update([
                    'first_name'=>$req->get('name'),
                    'phone'=>$req->get('phone'),
                    'email'=>$req->get('email'),
                    'photo'=>$imageName,
                    'password'=>Hash::make($req->password),
                    'password_text'=>Crypt::encryptString($req->password),
                ]); 
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
   
            
        if($status){
            Toastr::success('Your address updated successfully !!!', __('msg_success'));
        }
        else{
            Toastr::error('Please try again !!!', __('msg_error'));
        }
        return redirect()->back();
    }
    
    public function show($id)
    {
       
        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        $data['title'] = 'Dashboard | '. $settings->meta_title;           
        $data['breadcrumb_title'] = 'My Dashboard';  
        $data['theme']  = $this->theme_id;    
        $data['route']  = 'user.user_dashboard'; 
        
           //header-data-start
           $data['product_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->get();                                            
           $data['product_categories_footer'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->limit(4)->get();                                            
           $data['daily_staples'] = DB::table('products')->where('status','active')->where('is_daily_staples',1)->where('theme',$this->theme_id)->limit(6)->get();
           $data['top_save_products'] = DB::table('products')
                                           ->where('products.status','active')
                                           ->where('products.theme',$this->theme_id)
                                           ->orderBy('product_price.price','asc')
                                           ->join('product_price','product_price.product_id','products.id')
                                           ->limit(6)->get();  
           $data['recently_added_products'] = DB::table('products')->where('status','active')->orderBy('id','desc')->limit(6)->get();     
           $data['all_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->orderBy('title')->get();
           $data['deals'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('deal_of_the_day', 1)->get();           
           $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('date','>=',$this->expiry_date)->get();           
           //header-data-end

        if (DB::table('orders')->where('status','active')->where('id',$id)->exists()) {
            $data['order'] = DB::table('orders')
                            ->select('orders.*',
                            'users.first_name','users.last_name',
                            'user_addresses.house_no'
                            ,'users.email','users.phone'
                            ,'user_addresses.area','user_addresses.landmark'
                            ,'user_addresses.pin_code','user_addresses.town_city'
                            ,'user_addresses.state','user_addresses.address_type'
                            ,DB::raw('COALESCE(provinces.title, "") as province_title')
                            )
                            ->where('orders.status','active')
                            ->where('orders.id',$id)
                            ->where('orders.theme',$this->theme_id)
                            // ->where('user_addresses.default_address',1)
                            ->join('user_addresses','user_addresses.id','orders.user_address')
                            ->join('users','users.id','orders.user_id')
                            ->leftJoin('provinces','provinces.id','user_addresses.state')
                            ->first();

                            // dd($data['order']);
                            // die;
        return view('frontend.pages.user.show',$data);
        }else{
            return redirect()->back();
        }  
    }

    public function print_order($id)
    {
        $data['settings'] = DB::table('settings')->where('theme',$this->theme_id)->first();        
        $data['title'] = 'Print Data';
        $data['theme'] = $this->theme_id;

        $data['order'] = DB::table('orders')
                    ->select('orders.*','users.first_name','users.last_name','user_addresses.house_no','users.email','users.phone'
                    ,'user_addresses.area','user_addresses.landmark'
                    ,'user_addresses.pin_code','user_addresses.town_city'
                    ,'user_addresses.state','user_addresses.address_type'
                    ,'provinces.title')
                    ->where('orders.status','active')
                    ->where('orders.id',$id)
                    ->where('orders.theme',$this->theme_id)
                    // ->where('user_addresses.default_address',1)
                    ->join('user_addresses','user_addresses.id','orders.user_address')
                    ->join('users','users.id','orders.user_id')
                    ->join('provinces','provinces.id','user_addresses.state')
                    ->first();
                    
        // dd($data['order']);
        return view('frontend.pages.user.print',$data);
    }

    public function cancelorder($id){
        $data['settings'] = DB::table('settings')->where('theme',$this->theme_id)->first();
        $data['title'] = 'Print Data';
        $data['theme'] = $this->theme_id;  

        $order=DB::table('orders')->where('status','active') ->where('orders.id',$id)->update([
            'order_status'=>"canceled"
        ]);

        return view('frontend.pages.user.cancelorder',$data);
    }
}