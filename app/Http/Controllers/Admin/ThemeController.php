<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Toastr;
use DB;
use Exception;

class ThemeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('module_fees_fine', 1);
        $this->route = 'admin.themes';
        $this->view = 'admin.themes';
        $this->path = 'fees-fine';
        $this->access = 'fees-fine';
        $this->table_name = 'themes';
        $this->theme = 'bakery';
        $this->storage_path = '/storage/photos/'.$this->theme.'/themes/';


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
        $data['themes'] = DB::table($this->table_name)->orderBy('id','desc')->get();
        $data['title'] = 'Site Themes';
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
        $request->validate([
            'current_theme'=>'required',
        ]);

        $request->current_theme;

        $status = DB::table($this->table_name)->where('id',$request->current_theme)
            ->update([
            'current_theme'=>1
        ]);
   
        if ($status) {
            DB::table($this->table_name)->where('id','!=',$request->current_theme)
                ->update([
                'current_theme'=>0
            ]);

            Toastr::success('Theme updated successfully', __('msg_success'));
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
        $data['data'] = DB::table($this->table_name)->where('id',$id)->first();
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
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {            
            $photo = $this->storage_path.$request->photo->getClientOriginalName();            
            $request->photo->move(public_path($this->storage_path), $photo);
        }else{
            $photo = $request->hidden_photo;
        }
        $status = DB::table($this->table_name)->where('id',$id)
         ->update([
            'title'=>$request->title,
            'sub_title'=>$request->sub_title,
            'photo'=>$photo,
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
        
        $status = DB::table($this->table_name)->where('id',$id)->delete();
        if ($status) {
            Toastr::success('Data Deleted Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }        
        return redirect()->route($this->route.'.index');
    }
}
