<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeesCategory;
use App\Models\FeesFine;
use Toastr;
use DB;
use Exception;

class GalleryController extends Controller
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
        $this->route = 'admin.gallery';
        $this->view = 'admin.gallery';
        $this->path = 'fees-fine';
        $this->access = 'fees-fine';


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
        $data['gallery'] = DB::table('gallery')
                            ->select('gallery.*','gallery_sub_category.title as sub_cat_title','gallery_category.name')
                            ->join('gallery_sub_category','gallery_sub_category.id','gallery.sub_cat_id')                            
                            ->join('gallery_category','gallery_category.id','gallery_sub_category.cat_id')
                            ->orderBy('gallery.id','desc')                            
                            ->get();

        $data['title'] = 'Gallery';
        $data['route'] = $this->route;

        $data['banner_title'] = 'Banner';
        $data['table_name'] = 'other';
        $data['banner_field_name'] = 'gallery_banner';

        $data['data'] = DB::table('other')->first();
        

        return view('admin.gallery.index',$data);     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = DB::table('gallery_sub_category')->where('status','active')->orderBy('title','asc')->get();
        $data['title'] = 'Add Gallery';
        $data['categories'] = $category;
        $data['route'] = $this->route;
        return view('admin.gallery.create', $data);
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
            'category' => 'required',
            'photo' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            $imageName = '/uploads/gallery/'.$request->photo->getClientOriginalName();            
            $request->photo->move(public_path('uploads/gallery'), $imageName);
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
            return redirect()->back();
        }
        
        $status = DB::table('gallery')
         ->insert([
            'photo'=>$imageName,
            'sub_cat_id'=>$request->category,
            'status'=>$request->status
        ]);

        if ($status) {
            Toastr::success('Data Added Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }        
        return redirect()->route('admin.gallery.index');
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
        $profile = DB::table('gallery')->where('id',$id)->first();
        $category = DB::table('gallery_sub_category')->where('status','active')->orderBy('title','asc')->get();
        $data['categories'] = $category;
        $data['title'] = 'Edit Gallery';
        $data['data'] = $profile;
        $data['route'] = $this->route;
        return view('admin.gallery.edit', $data);
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
            'category' => 'required'
        ]);

        if ($request->hasFile('photo')) {
            $imageName = '/uploads/gallery/'.$request->photo->getClientOriginalName();            
            $request->photo->move(public_path('uploads/gallery'), $imageName);
        }elseif($request->hidden_img){
            $imageName = $request->hidden_img;            
        }else{
            Toastr::error('Oops something wents wrong, please try again or upload image properly !!!', __('msg_error'));
            return redirect()->back();
        }

        $status = DB::table('gallery')->where('id',$id)
         ->update([
            'photo'=>$imageName,
            'sub_cat_id'=>$request->category,
            'status'=>$request->status
        ]);

        if ($status) {
            Toastr::success('Data Updated Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }        
        return redirect()->route('admin.gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeesFine  $feesFine
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    { 

        if (! $request->hidden_id || $request->hidden_id == '') {
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
            return redirect()->back();
        }

        $id = $request->hidden_id;
        
        $status = DB::table('gallery')->where('id',$id)->delete();
        if ($status) {
            Toastr::success('Data Deleted Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }        
        return redirect()->route('admin.gallery.index');
    }
}
