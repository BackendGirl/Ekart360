<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeesCategory;
use App\Models\FeesFine;
use Toastr;
use DB;

class GallerysubcategoryController extends Controller
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
        $this->route = 'admin.gallery_sub_category';
        $this->view = 'admin.fees-fine';
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
        $gallery_sub_category = DB::table('gallery_sub_category')
                                ->select('gallery_sub_category.*','gallery_category.name')
                                ->join('gallery_category','gallery_category.id','gallery_sub_category.cat_id')
                                ->orderBy('gallery_sub_category.id','desc')
                                ->get();

        $data['title'] = 'Gallery Sub Category';
        $data['gallery'] = $gallery_sub_category;
        $data['route'] = $this->route;
        return view('admin.gallery_sub_category.index',$data);     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Gallery Sub Category';
        $data['categories'] = DB::table('gallery_category')->where('status','active')->orderBy('name')->get();
        $data['route'] = 'admin.gallery-sub-category'; 
        return view('admin.gallery_sub_category.create', $data);
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
            'title' => 'required',
            'category' => 'required',
            'photo' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            $imageName = '/uploads/gallery_sub_category/'.$request->photo->getClientOriginalName();            
            $request->photo->move(public_path('uploads/gallery_sub_category'), $imageName);
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
            return redirect()->back();
        }
        
        $status = DB::table('gallery_sub_category')
         ->insert([
            'title'=>$request->title,
            'photo'=>$imageName,
            'cat_id'=>$request->category,
            'status'=>$request->status
        ]);

        if ($status) {
            Toastr::success('Data Added Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again or upload image properly !!!', __('msg_error'));
        }      
        return redirect()->route('admin.gallery-sub-category.index');
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
        $data['data'] = DB::table('gallery_sub_category')->where('id',$id)->first();
        $data['title'] = 'Edit Gallery Sub Category';
        $data['categories'] = DB::table('gallery_category')->where('status','active')->orderBy('name')->get();
        $data['route'] = 'admin.gallery-sub-category'; 
        return view('admin.gallery_sub_category.edit', $data);
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
            'title' => 'required',
            'category' => 'required'
        ]);

        if ($request->hasFile('photo')) {
            $imageName = '/uploads/gallery_sub_category/'.$request->photo->getClientOriginalName();            
            $request->photo->move(public_path('uploads/gallery_sub_category'), $imageName);
        }elseif($request->hidden_img){
            $imageName = $request->hidden_img;            
        }else{
            Toastr::error('Oops something wents wrong, please try again or upload image properly !!!', __('msg_error'));
            return redirect()->back();
        }

        $status = DB::table('gallery_sub_category')->where('id',$id)
         ->update([
            'title'=>$request->title,
            'photo'=>$imageName,
            'cat_id'=>$request->category,
            'status'=>$request->status
        ]);

        if ($status) {
            Toastr::success('Data Updated Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }        
        return redirect()->route('admin.gallery-sub-category.index');
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

        $status = DB::table('gallery_sub_category')->where('id',$id)->delete();
        if ($status) {
            Toastr::success('Data Deleted Successfully', __('msg_success'));
        }else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }        
        return redirect()->route('admin.gallery-sub-category.index');
    }
}
