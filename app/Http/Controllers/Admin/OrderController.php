<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Toastr;
use DB;
use Exception;

class OrderController extends Controller
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

            $this->title = trans_choice('module_fees_fine', 1);
            $this->route = 'admin.orders';
            $this->view = 'admin.orders';
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
    public function index(Request $request)
    {
        $data['route'] = $this->route;        
        $data['title'] = 'Orders';
        $data['theme'] = $this->theme_id;
        $data['selected_order'] = 'all';
        if (!empty($request->order_status) && $request->order_status != 'all') {
            $data['selected_order'] = $request->order_status;
            $data['orders'] = DB::table($this->table_name)->orderBy('id','desc')->where('theme',$this->theme_id)->where('order_status',$request->order_status)->get();
        }else{
            $data['selected_order'] = 'all';
            $data['orders'] = DB::table($this->table_name)->orderBy('id','desc')->where('theme',$this->theme_id)->get();
        }
        return view($this->view.'.index',$data);     
    }

    public function delivered_orderes()
    {
        $data['route'] = $this->route;
        $data['orders'] = DB::table($this->table_name)->orderBy('id','desc')->where('theme',$this->theme_id)->where('order_status','delivered')->get();
        $data['title'] = 'Orders';
        $data['theme'] = $this->theme_id;
        $data['selected_order'] = 'all';
        return view($this->view.'.index',$data);     
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Category';
        $data['route'] = $this->route;
        return view($this->view.'.create',$data);     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'left_photo'=>'required',
            'center_photo'=>'required',
            'right_photo'=>'required',
        ]);

        if ($request->hasFile('left_photo') && $request->file('left_photo')->isValid()) {            
            $left_photo = $this->storage_path.$request->left_photo->getClientOriginalName();            
            $request->left_photo->move(public_path($this->storage_path), $left_photo);
        }else{
            $left_photo = '';
        } 

        if ($request->hasFile('center_photo') && $request->file('center_photo')->isValid()) {            
            $center_photo = $this->storage_path.$request->center_photo->getClientOriginalName();            
            $request->center_photo->move(public_path($this->storage_path), $center_photo);
        }else{
            $center_photo = '';
        } 

        if ($request->hasFile('right_photo') && $request->file('right_photo')->isValid()) {            
            $right_photo = $this->storage_path.$request->right_photo->getClientOriginalName();            
            $request->right_photo->move(public_path($this->storage_path), $right_photo);
        }else{
            $right_photo = '';
        } 
        
        $status = DB::table($this->table_name)
         ->insert([
            'left_title'=>$request->left_title,
            'left_sub_title'=>$request->left_sub_title,
            'left_photo'=>$left_photo,
            'center_title'=>$request->center_title,
            'center_sub_title'=>$request->center_sub_title,
            'center_photo'=>$center_photo,
            'right_title'=>$request->right_title,
            'right_sub_title'=>$request->right_sub_title,
            'right_photo'=>$right_photo,
            'status'=>$request->status,
        ]);

        if ($status) {
            Toastr::success('Data Added Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }      
        return redirect()->route($this->route.'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FeesFine  $feesFine
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['title'] = 'View order';
        $data['route'] = $this->route;
        $data['theme'] = $this->theme_id;

        if (DB::table('orders')->where('status','active')->where('id',$id)->exists()) {
            $data['order'] = DB::table('orders')
                            ->select('orders.*',
                            'users.first_name','users.last_name'
                            ,'user_addresses.house_no'
                            ,'users.email','users.phone'
                            ,'user_addresses.area','user_addresses.landmark'
                            ,'user_addresses.pin_code','user_addresses.address','user_addresses.town_city'
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
            return view($this->view.'.show', $data);
        }else{
            return redirect()->back();
        }  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeesFine  $feesFine
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['data'] = DB::table($this->table_name)->where('id',$id)->first();
        $data['title'] = 'Edit Category';
        $data['route'] = $this->route;
        return view($this->view.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FeesFine  $feesFine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $status = DB::table($this->table_name)->where('id',$id)->where('theme',$this->theme_id)
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

    public function order_process(Request $request, $id)
    {
        $status = DB::table($this->table_name)->where('id',$id)->where('theme',$this->theme_id)
         ->update([
            'order_status'=>'process',
            'courier_service_name'=>$request->courier_service_name,
            'tracking_id'=>$request->tracking_id,
            'expected_time'=>$request->expected_time,
        ]);

        if ($status) {
            Toastr::success('Data Updated Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeesFine  $feesFine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    { 

        if (! $id || $id == '') {
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
            return redirect()->back();
        }
        
        $status = DB::table($this->table_name)->where('id',$id)->where('theme',$this->theme_id)->delete();
        if ($status) {
            Toastr::success('Data Deleted Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }        
        return redirect()->route($this->route.'.index');
    }

    public function print_order($id)
    {
        $data['settings'] = DB::table('settings')->where('theme',$this->theme_id)->first();        
        $data['title'] = 'Print Data';
        $data['route'] = $this->route;
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
        return view($this->view.'.print', $data);
    }
}
