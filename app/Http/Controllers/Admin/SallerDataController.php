<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeesCategory;
use App\Models\FeesFine;
use Toastr;
use DB;
use Exception;

class SallerDataController extends Controller
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
            $this->route = 'admin.saller-data';
            $this->view = 'admin.saller_data';
            $this->path = 'fees-fine';
            $this->access = 'fees-fine';
            $this->table_name = 'saller_data';
            $this->theme = 'bakery';            
            $this->theme = $current_theme->slug;
            $this->theme_id = $current_theme->id;
            $this->storage_path = '/storage/photos/'.$this->theme.'/saller_data/';                 
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
        $data['data'] = DB::table($this->table_name)
                        ->orderBy('saller_data.id','desc')
                        ->where('saller_data.theme',$this->theme_id)
                        ->first();
        $data['title'] = 'Saller Page Data';
        return view($this->view.'.index',$data);     
    }
 
    public function update(Request $request, $id)
    {
            $request->validate([
                'title'=>'required',
                'description'=>'required',
            ]);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {           
            $imageName = $this->storage_path.$request->photo->getClientOriginalName();            
            $request->photo->move(public_path($this->storage_path), $imageName);
        }else{
            $imageName = $request->hidden_photo;
        } 

        $status = DB::table($this->table_name)->where('id',$id)
         ->update([
            'title'=>$request->title,
            'description'=>$request->description,          
            'photo'=>$imageName,
            'status'=>$request->status,
            'theme'=>$this->theme_id,
        ]);

        if ($status) {          
            Toastr::success('Data Updated Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }      
        return redirect()->route($this->route.'.index');
    }

}
