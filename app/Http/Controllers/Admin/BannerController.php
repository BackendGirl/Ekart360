<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Toastr;
use DB;
use Exception;

class BannerController extends Controller
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
            $this->route = 'admin.banner';            
            $this->path = 'fees-fine';
            $this->access = 'fees-fine';
            $this->table_name = 'banners';
            $this->theme = $current_theme->slug;
            $this->theme_id = $current_theme->id;
            $this->view = 'admin.banner.'.$this->theme;
            $this->storage_path = '/storage/photos/'.$this->theme.'/banner/';
    

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
        $data['route'] = $this->route;
        $data['data'] = DB::table($this->table_name)->where('theme',$this->theme_id)->orderBy('id','desc')->get();
        $data['title'] = 'Banner';
        return view($this->view.'.index',$data);     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Banner';
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
        if ($this->theme_id == 1) {
            $request->validate([
                'left_photo'=>'required',
                'center_photo'=>'required',
                'right_photo'=>'required',
            ]);
            $left_title = $request->left_title;
            $left_sub_title = $request->left_sub_title;
            $center_title = $request->center_title;
            $center_sub_title = $request->center_sub_title;
            $right_title = $request->right_title;
            $right_sub_title = $request->right_sub_title;
        }
        elseif($this->theme_id == 2 || $this->theme_id == 4) {
            $request->validate([
                'main_photo'=>'required',
                'side_photo'=>'required',
            ]);
            $left_title = null;
            $left_sub_title = null;
            $center_title = $request->main_title;
            $center_sub_title = $request->main_sub_title;
            $right_title = $request->side_title;
            $right_sub_title = $request->side_sub_title;
        }
        elseif($this->theme_id == 3) {
            $request->validate([
                'photo'=>'required',
            ]);
            $left_title = null;
            $left_sub_title = null;
            $center_title = $request->title;
            $center_sub_title = $request->sub_title;
            $right_title = null;
            $right_sub_title = null;
        }

        if ($request->hasFile('left_photo') && $request->file('left_photo')->isValid()) {            
            $left_photo = $this->storage_path.$request->left_photo->getClientOriginalName();            
            $request->left_photo->move(public_path($this->storage_path), $left_photo);
        }else{
            $left_photo = '';
        } 

        if ($request->hasFile('center_photo') && $request->file('center_photo')->isValid()) {            
            $center_photo = $this->storage_path.$request->center_photo->getClientOriginalName();            
            $request->center_photo->move(public_path($this->storage_path), $center_photo);
        }
        elseif ($request->hasFile('main_photo') && $request->file('main_photo')->isValid()) {            
            $center_photo = $this->storage_path.$request->main_photo->getClientOriginalName();            
            $request->main_photo->move(public_path($this->storage_path), $center_photo);
        }
        elseif ($request->hasFile('photo') && $request->file('photo')->isValid()) {            
            $center_photo = $this->storage_path.$request->photo->getClientOriginalName();            
            $request->photo->move(public_path($this->storage_path), $center_photo);
        }
        else{
            $center_photo = '';
        } 

        if ($request->hasFile('right_photo') && $request->file('right_photo')->isValid()) {            
            $right_photo = $this->storage_path.$request->right_photo->getClientOriginalName();            
            $request->right_photo->move(public_path($this->storage_path), $right_photo);
        }
        elseif ($request->hasFile('side_photo') && $request->file('side_photo')->isValid()) {            
            $right_photo = $this->storage_path.$request->side_photo->getClientOriginalName();            
            $request->side_photo->move(public_path($this->storage_path), $right_photo);
        }
        else{
            $right_photo = '';
        } 

        $status = DB::table($this->table_name)
         ->insert([
            'left_title'=>$left_title,
            'left_sub_title'=>$left_sub_title,
            'left_photo'=>$left_photo,
            'center_title'=>$center_title,
            'center_sub_title'=>$center_sub_title,
            'center_photo'=>$center_photo,
            'right_title'=>$right_title,
            'right_sub_title'=>$right_sub_title,
            'right_photo'=>$right_photo,
            'status'=>$request->status,
            'theme'=>$this->theme_id,
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
    public function show(FeesFine $feesFine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeesFine  $feesFine
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['data'] = DB::table($this->table_name)->where('theme',$this->theme_id)->where('id',$id)->first();
        $data['title'] = 'Edit Banner';
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
        if ($this->theme_id == 1) {
            $left_title = $request->left_title;
            $left_sub_title = $request->left_sub_title;
            $center_title = $request->center_title;
            $center_sub_title = $request->center_sub_title;
            $right_title = $request->right_title;
            $right_sub_title = $request->right_sub_title;
        }
        elseif($this->theme_id == 2 || $this->theme_id == 4) {
            $left_title = null;
            $left_sub_title = null;
            $center_title = $request->main_title;
            $center_sub_title = $request->main_sub_title;
            $right_title = $request->side_title;
            $right_sub_title = $request->side_sub_title;
        }
        elseif($this->theme_id == 3) {
            $left_title = null;
            $left_sub_title = null;
            $center_title = $request->title;
            $center_sub_title = $request->sub_title;
            $right_title = null;
            $right_sub_title = null;
        }

        if ($request->hasFile('left_photo') && $request->file('left_photo')->isValid()) {            
            $left_photo = $this->storage_path.$request->left_photo->getClientOriginalName();            
            $request->left_photo->move(public_path($this->storage_path), $left_photo);
        }else{
            $left_photo = $request->hidden_left_photo;
        } 

        if ($request->hasFile('center_photo') && $request->file('center_photo')->isValid()) {            
            $center_photo = $this->storage_path.$request->center_photo->getClientOriginalName();            
            $request->center_photo->move(public_path($this->storage_path), $center_photo);
        }
        elseif ($request->hasFile('main_photo') && $request->file('main_photo')->isValid()) {            
            $center_photo = $this->storage_path.$request->main_photo->getClientOriginalName();            
            $request->main_photo->move(public_path($this->storage_path), $center_photo);
        }
        elseif ($request->hasFile('photo') && $request->file('photo')->isValid()) {            
            $center_photo = $this->storage_path.$request->photo->getClientOriginalName();            
            $request->photo->move(public_path($this->storage_path), $center_photo);
        }
        else{
            $center_photo = $request->hidden_center_photo;
        } 

        if ($request->hasFile('right_photo') && $request->file('right_photo')->isValid()) {            
            $right_photo = $this->storage_path.$request->right_photo->getClientOriginalName();            
            $request->right_photo->move(public_path($this->storage_path), $right_photo);
        }
        elseif ($request->hasFile('side_photo') && $request->file('side_photo')->isValid()) {            
            $right_photo = $this->storage_path.$request->side_photo->getClientOriginalName();            
            $request->side_photo->move(public_path($this->storage_path), $right_photo);
        }
        else{
            $right_photo = $request->hidden_right_photo;
        } 

        
        $status = DB::table($this->table_name)->where('id',$id)
         ->update([
            'left_title'=>$left_title,
            'left_sub_title'=>$left_sub_title,
            'left_photo'=>$left_photo,
            'center_title'=>$center_title,
            'center_sub_title'=>$center_sub_title,
            'center_photo'=>$center_photo,
            'right_title'=>$right_title,
            'right_sub_title'=>$right_sub_title,
            'right_photo'=>$right_photo,
            'status'=>$request->status,
        ]);

        if ($status) {
            Toastr::success('Data Updated Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }        
        return redirect()->route($this->route.'.index');
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
}
