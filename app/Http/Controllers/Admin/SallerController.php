<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeesCategory;
use App\Models\FeesFine;
use Toastr;
use DB;
use Exception;

class SallerController extends Controller
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
            $this->route = 'admin.saller';
            $this->view = 'admin.saller';
            $this->path = 'fees-fine';
            $this->access = 'fees-fine';
            $this->table_name = 'saller';       
            $this->theme = $current_theme->slug;
            $this->theme_id = $current_theme->id;
            $this->storage_path = '/storage/photos/'.$this->theme.'/saller/';                 
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
                        ->orderBy('id','desc')
                        ->where('theme',$this->theme_id)
                        ->get();
        $data['title'] = 'Saller';
        return view($this->view.'.index',$data);     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Blog';
        $data['route'] = $this->route;
        $data['categories'] = DB::table('blog_category')->orderBy('title')->get();
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
            'title'=>'required',
            'description'=>'required',
            'date'=>'required',
            'added_by'=>'required',
            'photo'=>'required',
            'category'=>'required',
        ]);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {           
            $imageName = $this->storage_path.$request->photo->getClientOriginalName();            
            $request->photo->move(public_path($this->storage_path), $imageName);
        }else{
            $imageName = null;
        } 

        $status = DB::table( $this->table_name)
         ->insert([
            'title'=>$request->title,
            'description'=>$request->description,          
            'photo'=>$imageName,
            'status'=>$request->status,
            'date'=>$request->date,
            'added_by'=>$request->added_by,
            'category'=>$request->category,
            'theme'=>$this->theme_id,
        ]);

        if ($status) {  
            if ($blog_category = DB::table('blog_category')->where('id',$request->category)->where('saller','>',0)->where('theme',$this->theme_id)->first()) {
                $saller = $blog_category->saller + 1;
            }else{
                $saller = 1;
            }

            DB::table('blog_category')->where('id',$request->category)->where('theme',$this->theme_id)
            ->update([
                'saller'=>$saller,
            ]);      
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
    public function edit(Request $request, $id)
    {
        if (!empty($id) && !empty($request->status)) {
            $status = DB::table($this->table_name)->where('id',$id)
                ->update([
                    'status'=>$request->status,
                ]);
            if ($status) {          
                Toastr::success('Status has been changed successfully', __('msg_success'));
            }else{
                Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
            } 
            return redirect()->back();
        }

        Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        return redirect()->back();
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
            $request->validate([
                'title'=>'required',
                'description'=>'required',
                'date'=>'required',
                'added_by'=>'required',
                'category'=>'required',
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
            'date'=>$request->date,
            'added_by'=>$request->added_by,
            'category'=>$request->category,
        ]);

        if ($status) {          
            $cat1 = DB::table('saller')->where('category',$request->category)->count();
            $cat2 = DB::table('saller')->where('category',$request->old_category)->count();

            DB::table('blog_category')->where('id',$request->category)->where('theme',$this->theme_id)->update(['saller'=>$cat1]);
            DB::table('blog_category')->where('id',$request->old_category)->where('theme',$this->theme_id)->update(['saller'=>$cat2]);

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
        
        $status2 = DB::table($this->table_name)->where('id',$id)->where('theme',$this->theme_id);
        $status = $status2->delete();
        if ($status) {
            Toastr::success('Data Deleted Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }        
        return redirect()->route($this->route.'.index');
    }
}
