<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Toastr;
use DB;
use Str;
use Exception;

class ProductController extends Controller
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
            $this->route = 'admin.products';
            $this->view = 'admin.products';
            $this->path = 'fees-fine';
            $this->access = 'fees-fine';
            $this->theme = $current_theme->slug;
            $this->theme_id = $current_theme->id;
            $this->storage_path = '/storage/photos/'.$this->theme.'/products/';
    

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
        $data['data'] = DB::table('products')
                        ->select('product_category.title as category_title','products.*')
                        ->orderBy('id','desc')
                        ->where('products.theme',$this->theme_id)
                        ->join('product_category','product_category.id','products.category')
                        ->get();
        $data['title'] = 'Products';
        return view($this->view.'.index',$data);     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Product';
        $data['route'] = $this->route;
        $data['categories']=DB::table('product_category')->where('theme',$this->theme_id)->where('status','active')->get();
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
            'category'=>'required',
            'photo'=>'required',
            'description'=>'required',
        ]);

        $data=$request->all();
        $slug=Str::slug($request->title);
        $slug = $slug.'-'.date('ymdis').'-'.rand(0,999);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {           
            $imageName = $this->storage_path.date('m-s').$request->photo->getClientOriginalName();            
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
        $data['data'] = DB::table('products')->where('id',$id)->where('theme',$this->theme_id)->first();
        $data['title'] = 'Edit Product';
        $data['route'] = $this->route;
        $data['categories']=DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->get();
        $data['product_price'] = DB::table('product_price')->where('product_id',$id)->get();
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
        $request->validate([
            'title'=>'required',
            'category'=>'required',
            'description'=>'required',
        ]);

        $data=$request->all();
        $slug=Str::slug($request->title);
        $slug = $slug.'-'.date('ymdis').'-'.rand(0,999);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {           
            $imageName = $this->storage_path.date('m-s').$request->photo->getClientOriginalName();            
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
        return redirect()->route($this->route.'.index');
    }

    public function deal_of_the_day(Request $request) {

        if (empty($request->product_id)) {
            return response()->json([
                'code' => '404',
                'message' => 'Oops something went wrong please try again.'
            ]);
        }

        $status = DB::table('products')->where('id',$request->product_id)
        ->update([
                'deal_of_the_day'=>$request->value,
            ]);

       if ($status) {
            if ($request->value == 1) {
                return response()->json([
                    'code' => '200',
                    'message' => 'Product added to deal of the day.'
                ]);
            }else{
                return response()->json([
                    'code' => '200',
                    'message' => 'Product removed from deal of the day.'
                ]);
            }
       }else{
              return response()->json([
                    'code' => '400',
                    'message' => 'Oops something went wrong please try again.'
                ]);
       }

    }
}
