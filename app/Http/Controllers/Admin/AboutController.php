<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Toastr;
use DB;
use Str;
use Exception;

class AboutController extends Controller
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
            $this->route = 'admin.about-us';
            $this->view = 'admin.about_us';
            $this->path = 'fees-fine';
            $this->access = 'fees-fine';    
            $this->theme = $current_theme->slug;
            $this->theme_id = $current_theme->id;
            $this->storage_path = '/storage/photos/'.$this->theme.'/about_us/';    

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
        $data['data'] = DB::table('about_us')->where('theme',$this->theme_id)->first();
        $data['title'] = 'About Us';
        return view($this->view.'.index',$data);     
    }

  
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
        ]);
        
        if ($request->photos) {
             $photos = [];
            foreach ($request->photos as $key => $value) { 
                    $photos2 = $this->storage_path.$value->getClientOriginalName();            
                    array_push($photos,$photos2);
                    $value->move(public_path($this->storage_path), $photos2);
            }
            $photos =  json_encode($photos); 
        }else{
            $photos = $request->hidden_photos;
        }
       
        $status = DB::table('about_us')->where('id',$id)->where('theme',$this->theme_id)
         ->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'photos'=>$photos,
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
