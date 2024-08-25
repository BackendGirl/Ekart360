<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Carbon\Carbon;
use Session;
use DB;
use URL;
use Hash;
use Toastr;
use Crypt;
use Redirect;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
class VenderController extends Controller
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
            $this->storage_path = '/storage/photos/'.$this->theme.'/products/';
            $this->storage_path_saller = '/storage/photos/'.$this->theme.'/seller/';            

            $this->expiry_date = strtotime(date('d-m-Y'));

       } catch (\Throwable $th) {
          throw new Exception("505, Server Error");
         die;
       }

       $this->route = 'vender.vender_dashboard';
       $this->view = 'frontend.pages.vender';

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
        $data['route']  = $this->route;    

        $vender_id = session()->get('vender');

        $data['categories']=DB::table('product_category')->where('theme',$this->theme_id)->where('status','active')->get();
        $data['products'] = DB::table('products')
                        ->select('product_category.title as category_title','products.*')
                        ->orderBy('id','desc')
                        ->where('products.theme',$this->theme_id)
                        ->where('products.vender',$vender_id)
                        ->join('product_category','product_category.id','products.category')
                        ->paginate(10);

        $data['trending_products'] = DB::table('products')
                        ->select('product_category.title as category_title','products.*')
                        ->orderBy('id','desc')
                        ->where('products.theme',$this->theme_id)
                        ->where('products.vender',$vender_id)
                        ->join('product_category','product_category.id','products.category')
                        ->limit(5)
                        ->get();                        

        $data['orders'] = DB::table('orders')->orderBy('id','desc')->where('theme',$this->theme_id)->where('vender',$vender_id)->paginate(10);
        
        $data['recent_orders'] = DB::table('orders')->orderBy('id','desc')->where('theme',$this->theme_id)->where('vender',$vender_id)->limit(5)->get();
        $data['orders_pending'] = DB::table('orders')->orderBy('id','desc')->where('theme',$this->theme_id)->where('vender',$vender_id)->where('order_status','new')->count();
       
        $data['vender_data'] = DB::table('saller')->where('id',$vender_id)->where('theme',$this->theme_id)->first();

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

                                       
        return view($this->view.'.dashboard',$data);
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'category'=>'required',
            'photo'=>'required',
            'description'=>'required',
        ]);

        $vender_id = session()->get('vender');

        $data=$request->all();
        $slug=Str::slug($request->title);
        $slug = $slug.'-'.date('ymdis').'-'.rand(0,999);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {           
            $imageName = $this->storage_path.'p'.date('m-s').'.'.$request->photo->getClientOriginalExtension();            
            $request->photo->move(public_path($this->storage_path), $imageName);
        }else{
            $imageName = null;
        } 

        if ($request->sub_photos) {
             $sub_photos = [];
            foreach ($request->sub_photos as $key => $value) { 
                    $sub_photos2 = $this->storage_path.$value->getClientOriginalName();            
                    array_push($sub_photos,$sub_photos2);
                    $value->move(public_path($this->storage_path), $sub_photos2);
            }  
        }else{
            $sub_photos = null;
        }
       
        $status = DB::table('products')
         ->insert([
            'title'=>$request->title,
            'slug'=>$slug,
            'category'=>$request->category,
            'rating'=>$request->rating,
            'description'=>$request->description,
            'additional_info'=>$request->additional_info,
            'care_instruction'=>$request->care_instruction,
            'photo'=>$imageName,
            'sub_photos'=>json_encode($sub_photos),
            'status'=>$request->status,
            'theme'=>$this->theme_id,
            'vender'=>$vender_id,
        ]);

        if ($status) {
            $last = DB::table('products')->latest()->first();
            foreach ($data['price'] as $key => $value) {
                DB::table('product_price')
                ->insert([
                'price'=>$request->price[$key],
                'mrp'=>$request->mrp[$key],
                'quantity'=>$request->weight[$key],
                'product_id'=>$last->id,
                'theme'=>$this->theme_id,
                ]); 
            }

            if ($products_count = DB::table('product_category')->where('id',$request->category)->where('products','>',0)->first()) {
                $products = $products_count->products + 1;
            }else{
                $products = 1;
            }

            DB::table('product_category')->where('id',$request->category)
            ->update([
                'products'=>$products,
            ]);
                
            Toastr::success('Product Added Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }      
        return redirect()->route($this->route);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'category'=>'required',
            'description'=>'required',
        ]);

        $data=$request->all();
        $slug=Str::slug($request->title);
        $slug = $slug.'-'.date('ymdis').'-'.rand(0,999);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {           
            $imageName = $this->storage_path.'p'.date('m-s').'.'.$request->photo->getClientOriginalExtension();            
            $request->photo->move(public_path($this->storage_path), $imageName);
        }else{
            $imageName = $request->hidden_photo;
        } 

        if ($request->sub_photos) {
             $sub_photos = [];
            foreach ($request->sub_photos as $key => $value) { 
                    $sub_photos2 = $this->storage_path.$value->getClientOriginalName();            
                    array_push($sub_photos,$sub_photos2);
                    $value->move(public_path($this->storage_path), $sub_photos2);
            }
            $sub_photos =  json_encode($sub_photos); 
        }else{
            $sub_photos = $request->hidden_sub_photos;
        }
       
        $status = DB::table('products')->where('id',$id)
         ->update([
            'title'=>$request->title,
            'slug'=>$slug,
            'category'=>$request->category,
            'rating'=>$request->rating,
            'description'=>$request->description,
            'additional_info'=>$request->additional_info,
            'care_instruction'=>$request->care_instruction,
            'photo'=>$imageName,
            'sub_photos'=>$sub_photos,
            'status'=>$request->status,
        ]);

        if ($status) {
            DB::table('product_price')->where('product_id',$id)->delete();
            foreach ($data['price'] as $key => $value) {
                DB::table('product_price')
                ->insert([
                'price'=>$request->price[$key],
                'mrp'=>$request->mrp[$key],
                'quantity'=>$request->weight[$key],
                'product_id'=>$id,
                'theme'=>$this->theme_id,
                ]); 
            }

            $cat1 = DB::table('products')->where('category',$request->category)->count();
            $cat2 = DB::table('products')->where('category',$request->old_category)->count();

            DB::table('product_category')->where('id',$request->category)->update(['products'=>$cat1]);
            DB::table('product_category')->where('id',$request->old_category)->update(['products'=>$cat2]);

            Toastr::success('Product Updated Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }      
        return redirect()->route($this->route);
    }

    public function destroy(Request $request,$id)
    { 

        if (! $id || $id == '') {
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
            return redirect()->back();
        }
        
        $status2 = DB::table('products')->where('theme',$this->theme_id)->where('id',$id);;
        $product_category = $status2->first();
        $status = $status2->delete();
        if ($status) {
            DB::table('product_price')->where('theme',$this->theme_id)->where('product_id',$id)->delete();

            if ($products_count = DB::table('product_category')->where('theme',$this->theme_id)->where('id',$product_category->category)->where('products','>',0)->first()) {
                $products = $products_count->products - 1;
            }else{
                $products = 0;
            }

            DB::table('product_category')->where('id',$product_category->category)
            ->update([
                'products'=>$products,
            ]);

            Toastr::success('Data Deleted Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }        
        return redirect()->route($this->route);
    }

    public function show($id)
    {
        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        $data['title'] = 'Order History';           
        $data['breadcrumb_title'] = 'Order History';  
        $data['theme']  = $this->theme_id;    
        $data['route']  = $this->route;    

        $vender_id = session()->get('vender');

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
         //header-data-end

        if (DB::table('orders')->where('status','active')->where('id',$id)->exists()) {
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
                            // die;
            return view($this->view.'.show', $data);
        }else{
            return redirect()->back();
        }  
    }

    public function order_update(Request $request, $id)
    {
        $status = DB::table('orders')->where('id',$id)->where('theme',$this->theme_id)
         ->update([
            'order_status'=>$request->order_status,
        ]);

        if ($status) {
            Toastr::success('Data Updated Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }        
        return redirect()->back();
    }

    public function profile_update(Request $request, $id)
    {
        $request->validate([
            'company_name'=>'string|required',
            'email'=>'email|required',
            'phone'=>'numeric|required|digits:10',
            'country'=>'required',
            'year_established'=>'required',
            'category'=>'required',
            'address'=>'required',
            'city'=>'required',
            'zip'=>'required'
        ]);

        if ($request->hasFile('photo')) {           
            $imageName = $this->storage_path_saller.$request->photo->getClientOriginalName();            
            $request->photo->move(public_path($this->storage_path_saller), $imageName);
        }else{
            $imageName = $request->hidden_photo;
        } 

        $a = DB::table('saller')->where('id',$id)->first();

        if ($request->password) {
            if (empty($request->old_password)) {
                $request->validate([
                    'old_password'=>'required',
                ]);        
            }
            if(Hash::check($request->old_password,$a->password)){
                $password = Hash::make($request->password);
                $password_text = Crypt::encryptString($request->password);
            }
            else{
                Toastr::error('Old password in incorrect !!!', __('msg_error'));
                return redirect()->back();
            }
        }else{           
            $password = Hash::make($a->password);
            $password_text = Crypt::encryptString($a->password);
        }
      
        $status = DB::table('saller')->where('id',$id)
        ->update([
            'company_name'=>$request->get('company_name'),
            'email'=>$request->get('email'),
            'phone'=>$request->get('phone'),
            'country'=>$request->get('country'),
            'year_established'=>$request->get('year_established'),
            'category'=>$request->get('category'),
            'address'=>$request->get('address'),
            'city'=>$request->get('city'),
            'zip'=>$request->get('zip'),
            'password'=>$password,
            'password_text'=>$password_text,
            'photo'=>$imageName,
        ]); 

        if ($status) {
            Toastr::success('Profile Updated Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }      
        return redirect()->route($this->route);
    }

    public function account_deactivate(Request $request, $id)
    {
        $request->validate([
            'concern'=>'required'
        ]);

        if ($request->concern == 'activate') {
            $status = 'approved';
        }else{
            $status = 'deactivate';
        }
  
        $status = DB::table('saller')->where('id',$id)
        ->update([
            'deactivation_note'=>$request->get('concern'),
            'status'=> $status,
        ]); 

        if ($status) {
            Toastr::success('Profile Updated Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }      
        return redirect()->route($this->route);
    }

    public function account_delete(Request $request, $id)
    {
        $request->validate([
            'usable'=>'required'
        ]);

        $status = 'deleted';

        $status = DB::table('saller')->where('id',$id)
        ->update([
            'deletion_note'=>$request->get('usable'),
            'status'=>$status,
        ]); 

        if ($status) {
            Toastr::success('Profile Updated Successfully', __('msg_success'));
            Session::forget('vender');
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }      
        return redirect()->route($this->route);
    }

    public function logout(){
        Session::forget('vender');
        Toastr::success('You have been successfully logged out', __('msg_success'));
        return redirect()->route('vender_login');
    }
    
}