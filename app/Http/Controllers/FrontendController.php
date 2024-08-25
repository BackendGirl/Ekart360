<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Session;
use DB;
use URL;
use Hash;
use Crypt;
use Toastr;
use Redirect;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Exception;
use App\Helper;
use Cache;
use App\Mail\ForgotPassword;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Support\Facades\Validator;


class FrontendController extends Controller
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
            $this->review_storage_path = '/storage/photos/'.$this->theme.'/customer_review/';
            $this->storage_path_saller = '/storage/photos/'.$this->theme.'/seller/';            
            $this->storage_path = '/storage/photos/'.$this->theme.'/users/';            

            $this->expiry_date = strtotime(date('d-m-Y'));
            $this->shipping_charges = 50;
            $this->future_delivery_charges = 20;

            // $this->header = 'https://example.com';
            $this->header = '*';

       } catch (\Throwable $th) {
          throw new Exception("505, Server Error");
         die;
       }
    }

    public function index(Request $request){ 
        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        $data['title'] = 'Home | '. $settings->meta_title;  
        $data['theme']  = $this->theme_id;  
        
        $data['offers'] = DB::table('offers')->where('status','active')->where('theme',$this->theme_id)->orderBy('id','desc')->get();
        $data['sale_banners'] = DB::table('sale_banners')->where('status','active')->where('theme',$this->theme_id)->orderBy('id','desc')->get();

        // $data['product_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->get();        
        $data['all_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->orderBy('title')->get();
        $data['product_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->get();     
        $data['product_categories_footer'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->limit(4)->get();                                               
        
        $data['cakes'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('category',3)->get();        
        $data['daily_staples'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('is_daily_staples',1)->limit(6)->get();  

        $data['daily_staples2'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('is_daily_staples',1)->get();  
       
        $data['top_save_products'] = DB::table('products')
                                    ->where('products.status','active')
                                    ->where('products.theme',$this->theme_id)
                                    ->orderBy('product_price.price','desc')
                                    ->join('product_price','product_price.product_id','products.id')
                                    ->limit(6)->get();

        $data['top_save_products2'] = DB::table('products')
                                    ->where('products.status','active')
                                    ->where('products.theme',$this->theme_id)
                                    ->orderBy('product_price.price','desc')
                                    ->join('product_price','product_price.product_id','products.id')
                                    ->limit(16)->get();

        $data['top_salling_products'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->orderBy('title')->limit(3)->get();                                            
        $data['tranding_products'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->orderBy('title','desc')->limit(3)->get();                                            
        $data['recently_added_products2'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->orderBy('id','desc')->limit(3)->get();                                            
        $data['recently_added_products'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->orderBy('id','desc')->limit(6)->get();                                            

        $data['top_rated_products'] = DB::table('products')
                                    ->where('products.status','active')
                                    ->where('products.theme',$this->theme_id)
                                    ->orderBy('product_price.price','desc')
                                    ->join('product_price','product_price.product_id','products.id')
                                    ->limit(3)->get();      
                                    
        $data['banner'] = DB::table('banners')->where('theme',$this->theme_id)->where('status','active')->first(); 
        
        //theme-2-start
        $data['vagitable_and_fruits'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('category', 16)->limit(16)->get();        
        $data['milk_and_dairies'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('category',21)->limit(16)->get();  
        $data['blogs'] = DB::table('blogs')->where('blogs.theme',$this->theme_id)->where('blogs.status','active')->select('blog_category.title as category_title','blogs.*')->join('blog_category','blog_category.id','blogs.category')->orderBy('blogs.id','desc')->limit(10)->get();
        //theme-2-end

        //theme-3-start
         $data['fruits_and_vagitables'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('category', 33)->get();           
         $data['breakfast_and_dairy'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('category', 34)->get();           
         $data['chemist'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('category', 28)->get();           
         $data['drinks'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('category', 35)->get();           
         $data['grocery'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('category', 36)->get();           
         $data['personal_care'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('category', 37)->get();           
         $data['kitchen_and_dining'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('category', 38)->get();           
        //theme-3-end

         //theme-4-start
         $data['food_cupboards'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('category', 39)->get();                    
         $data['top_save_today'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->orderBy('id')->get();           
         $data['best_seller1'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->orderBy('id','desc')->limit(4)->get();           
         $data['best_seller2'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->orderBy('id','desc')->offset(4)->limit(4)->get();           
         $data['best_seller3'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->orderBy('id','desc')->offset(8)->limit(4)->get();           
         $data['best_seller4'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->orderBy('id','desc')->offset(12)->limit(4)->get();           
         $data['trending_products'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->orderBy('id','desc')->limit(3)->get();           
         $data['product_categories2'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->limit(10)->get();     
        //theme-4-end        
        $data['deals'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('deal_of_the_day', 1)->get();           

        $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();           
        $data['top_salling_items'] = DB::table('products')
                                ->where('products.status','active')
                                ->orderBy('product_price.price','desc')
                                ->where('products.theme',$this->theme_id)
                                ->join('product_price','product_price.product_id','products.id')
                                ->limit(16)->get();                                   
        if ($this->theme_id == 2) {
            return view('frontend.index.organic',$data);
        }elseif ($this->theme_id == 3) {
            return view('frontend.index.classic_shop',$data);
        }elseif ($this->theme_id == 4) {
            return view('frontend.index.furniture',$data);
        }else{
            return view('frontend.index.backery',$data);
        }
    }

    public function gallery(){
        $settings=DB::table('settings')->first();
        $category = DB::table('gallery_category')->where('status','active')->orderBy('name','asc')->get();

        $data2 = DB::table('other')->first();
        if ($data2->gallery_banner && $data2->gallery_banner != '') {
            $banner_src = $data2->gallery_banner;
        }

        return view('frontend.pages.gallery',['settings'=>$settings,'gallery_category'=>$category,'banner_src'=>$banner_src]);        
    }

    public function gallery_specific($id=null,$cat_id=null){
        $settings=DB::table('settings')->first();

        if ($id == null || $id == '' || $cat_id == null || $cat_id == '') {
            return redirect()->back();
        }

        $gallery_sub_category = DB::table('gallery_sub_category')->where('status','active')->orderBy('title','asc')->get();

        $gallery_category = DB::table('gallery_category')->where('status','active')->where('id',$cat_id)->first();

        $data2 = DB::table('other')->first();
        if ($data2->gallery_banner && $data2->gallery_banner != '') {
            $banner_src = $data2->gallery_banner;
        }
        

        return view('frontend.pages.gallery_specific',['settings'=>$settings,'gallery_sub_category'=>$gallery_sub_category,'banner_src'=>$banner_src,'id'=>$id,'category'=>$gallery_category->name]);        
    }

    public function checkout_detail(Request $request, $id){

        if ($id != '') {
            $user = DB::table('orders')->where('id',$id)->get();
            $total=0;
            foreach ($user as $key => $value) {
                $total += $value->total_amount;                
            }      
            $total_amount = $total;

            $total2=0;
            foreach ($user as $key => $value) {
                $total2 += $value->sub_total;                
            }      
            $sub_total = $total2;  
            Toastr::error('Your product successfully placed in order !!!', __('msg_error'));
            return view('frontend.pages.checkout-detail')->with('user',$user)->with('total_amount',$total_amount)->with('sub_total',$sub_total);
        }else{
            return redirect()->route('home');
        }
    }   

        public function print_bill(){
            if (Auth()->user()->id) {
                $user = DB::table('orders')->where('user_id',Auth()->user()->id)->get();
                $total=0;
                    foreach ($user as $key => $value) {
                        $total += $value->total_amount;
                        
                    }      
                    $total_amount = $total;
        
                    $total2=0;
                    foreach ($user as $key => $value) {
                        $total2 += $value->sub_total;
                        
                    }      
                    $sub_total = $total2;  
                return view('frontend.pages.print_bill')->with('user',$user)->with('total_amount',$total_amount)->with('sub_total',$sub_total);
            }else{
                return redirect()->route('home');
            }
    }

    public function products(Request $request, $id = null){
        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        $data['title'] = 'Product | '. $settings->meta_title;   
        $data['theme']  = $this->theme_id;

        $category_title = DB::table('product_category')->where('id',$id)->where('theme',$this->theme_id)->first();
        $data['breadcrumb_title'] = $category_title->title;     

        if (!$id) {
            Toastr::error('Oops something went wrong, please try again !!!', __('msg_error'));
            return redirect()->back();
        }

        $data['products'] = $product = DB::table('products')
                                    ->select('product_category.title as category_title','products.*')
                                    ->where('category',$id)
                                    ->where('products.theme',$this->theme_id)
                                    ->join('product_category','product_category.id','products.category')
                                    ->paginate(16);        
        $data['categories'] = $product = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->get();                                              
        $data['product_banners'] = $product = DB::table('product_banners')->where('status','active')->where('theme',$this->theme_id)->orderBy('id','desc')->get(); 

        //header-data-start
        $data['product_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->get();                                            
        $data['daily_staples'] = DB::table('products')->where('status','active')->where('is_daily_staples',1)->where('theme',$this->theme_id)->limit(6)->get();
        $data['top_save_products'] = DB::table('products')
                                        ->where('products.status','active')
                                        ->where('products.theme',$this->theme_id)
                                        ->orderBy('product_price.price','asc')
                                        ->join('product_price','product_price.product_id','products.id')
                                        ->limit(6)->get();  
        $data['recently_added_products'] = DB::table('products')->where('status','active')->orderBy('id','desc')->where('theme',$this->theme_id)->limit(6)->get();     
        $data['product_categories_footer'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->limit(4)->get();                                            
        $data['all_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->orderBy('title')->get();

        $data['deals'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('deal_of_the_day', 1)->get();           
        $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();                   

        //header-data-end

        return view('frontend.pages.products',$data);

    }

    public function products_detail(Request $request, $slug = null){
        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        $data['title'] = 'Product Detail | '. $settings->meta_title;  
        $data['theme']  = $this->theme_id;           

        if (!$slug) {
            Toastr::error('Oops something went wrong, please try again !!!', __('msg_error'));
            return redirect()->back();
        }

        $data['product'] = $product = DB::table('products')
                                    ->where('products.slug',$slug)
                                    ->where('products.theme',$this->theme_id)
                                    ->select('product_category.title as category_title','products.*')
                                    ->join('product_category','product_category.id','products.category')->first();

                                    // dd($data['product']);
                                    
        $data['product_prices'] = $product_prices = DB::table('product_price')->where('product_id',$product->id)->where('theme',$this->theme_id)->get();        
        $data['tranding_products'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->orderBy('title','desc')->limit(6)->get();                                                   
        $data['related_products'] = DB::table('products')->where('status','active')->orderBy('id','desc')->where('theme',$this->theme_id)->where('category',$product->category)->limit(10)->get();                                                   
        $data['customer_reviews'] = DB::table('customer_reviews')
                                    ->select('customer_reviews.*','users.first_name','users.photo')
                                    ->where('customer_reviews.status','approved')
                                    ->orderBy('customer_reviews.id','desc')
                                    ->where('customer_reviews.theme',$this->theme_id)
                                    ->join('users','users.id','customer_reviews.user_id')
                                    ->get();   

        $five = $data['customer_reviews']->where('rating',5);
        $four = $data['customer_reviews']->where('rating',4);
        $three = $data['customer_reviews']->where('rating',3);
        $two = $data['customer_reviews']->where('rating',2);
        $one = $data['customer_reviews']->where('rating',1);

   try {
    $data['rating_five'] = intval(round((count($five) / count($data['customer_reviews'])) * 100));
    $data['rating_four'] = intval(round((count($four) / count($data['customer_reviews'])) * 100));
    $data['rating_three'] = intval(round((count($three) / count($data['customer_reviews'])) * 100));
    $data['rating_two'] = intval(round((count($two) / count($data['customer_reviews'])) * 100));
    $data['rating_one'] = intval(round((count($one) / count($data['customer_reviews'])) * 100));  
    $rating_sum = $data['customer_reviews']->sum('rating');
    $data['rating_sum'] = number_format(($rating_sum / count($data['customer_reviews'])) , 1);
   } catch (\Throwable $th) {
    $data['rating_five'] = 0;
    $data['rating_four'] = 0;
    $data['rating_three'] = 0;
    $data['rating_two'] = 0;
    $data['rating_one'] = 0;  
    $data['rating_sum'] = 0;
   }
                                            
        $multi_photos = [];

        if ($product->sub_photos != null && $product->sub_photos !='') {
            foreach (explode(',', $product->sub_photos) as $key=>$subphotos) {
                $catid = trim($subphotos,'[]"');
                if ($catid != '' && strlen($catid) > 1) {
                    $arr = str_replace("\\", '', $catid);
                    array_push($multi_photos,$arr);
                }
            }
        }
        
        $data['multi_photos'] = $multi_photos;

        $data['breadcrumb_title'] = $product->category_title;   

        $discounted_price = (($product_prices[0]->mrp - $product_prices[0]->price) / $product_prices[0]->mrp * 100);

        $data['discount'] = round($discounted_price);

        //header-data-start
        $data['product_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->get();                                            
        $data['daily_staples'] = DB::table('products')->where('status','active')->where('is_daily_staples',1)->where('theme',$this->theme_id)->limit(6)->get();
        $data['top_save_products'] = DB::table('products')
                                        ->where('products.status','active')
                                        ->where('products.theme',$this->theme_id)
                                        ->orderBy('product_price.price','asc')
                                        ->join('product_price','product_price.product_id','products.id')
                                        ->limit(6)->get();  
        $data['recently_added_products'] = DB::table('products')->where('status','active')->orderBy('id','desc')->where('theme',$this->theme_id)->limit(6)->get();     
        $data['product_categories_footer'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->limit(4)->get();                                            
        $data['all_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->orderBy('title')->get();
        $data['deals'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('deal_of_the_day', 1)->get();           
$data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();                   //header-data-end
       
        return view('frontend.pages.products_detail',$data);

    }

    public function cart(){
        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        $data['title'] = 'Cart | '. $settings->meta_title;   
        $data['breadcrumb_title'] = 'Cart';  
        $data['theme']  = $this->theme_id;

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
   $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();                      //header-data-end

        return view('frontend.pages.cart',$data);
    }
    
    public function wishlist(){
        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        $data['title'] = 'Wishlist | '. $settings->meta_title;   
        $data['breadcrumb_title'] = 'Wishlist';   
        $data['theme']  = $this->theme_id;

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
   $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();                      //header-data-end

        return view('frontend.pages.wishlist',$data);
    }

    public function about_us(){
        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        $data['about_us'] = $about_us = DB::table('about_us')->where('theme',$this->theme_id)->first();
        $data['title'] = 'About Us | '. $settings->meta_title;   
        $data['breadcrumb_title'] = 'About Us';   
        $data['theme']  = $this->theme_id;

        $photos_count = 0;
        if ($about_us->photos != null && $about_us->photos !='') {
            foreach (explode(',', $about_us->photos) as $key=>$subphotos) {
                $catid = trim($subphotos,'[]"');
                if($catid != '' && strlen($catid) > 1){
                    $photos_count++;
                }
            }
        }
        $data['photos_count'] = $photos_count;

        $data['blogs'] = DB::table('blogs')->where('blogs.theme',$this->theme_id)->where('blogs.status','active')->select('blog_category.title as category_title','blogs.*')->join('blog_category','blog_category.id','blogs.category')->orderBy('blogs.id','desc')->limit(10)->get();
        $data['team_members'] = DB::table('team_members')->where('theme',$this->theme_id)->where('status','active')->get();
        $data['testimonials'] = DB::table('testimonials')->where('theme',$this->theme_id)->where('status','active')->get();

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
   $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();                      //header-data-end
         
        return view('frontend.pages.about_us',$data);
    }

    public function blog_detail(Request $request, $id = null){
        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        $data['title'] = 'Blog Detail | '. $settings->meta_title; 
        $data['breadcrumb_title'] = 'Blog Details';     
        $data['theme']  = $this->theme_id;

        if (!$id) {
            Toastr::error('Oops something went wrong, please try again !!!', __('msg_error'));
            return redirect()->back();
        }

        $data['blog'] = $product = DB::table('blogs')->where('theme',$this->theme_id)->where('id',$id)->first();
        $data['recent_blogs'] = $product = DB::table('blogs')->where('status','active')->where('theme',$this->theme_id)->orderBy('id','desc')->limit(4)->get();
        $data['categories'] = $product = DB::table('blog_category')->where('theme',$this->theme_id)->where('status','active')->where('blogs','>',0)->get();
        $data['tranding_products'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->orderBy('title','desc')->limit(3)->get(); 

        //header-data-start
        $data['product_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->get();                                            
        $data['daily_staples'] = DB::table('products')->where('status','active')->where('is_daily_staples',1)->where('theme',$this->theme_id)->limit(6)->get();
        $data['top_save_products'] = DB::table('products')
                                        ->where('products.status','active')
                                        ->where('products.theme',$this->theme_id)
                                        ->orderBy('product_price.price','asc')
                                        ->join('product_price','product_price.product_id','products.id')
                                        ->limit(6)->get();  
        $data['recently_added_products'] = DB::table('products')->where('status','active')->orderBy('id','desc')->where('theme',$this->theme_id)->limit(6)->get();     
        $data['product_categories_footer'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->limit(4)->get();                                            
        $data['all_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->orderBy('title')->get();
        $data['deals'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('deal_of_the_day', 1)->get();           
    $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();                   //header-data-end       

            return view('frontend.pages.blog_detail',$data);
        }

        public function blogs(Request $request,$id=null){
            $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
            $data['title'] = 'Blogs | '. $settings->meta_title; 
            $data['breadcrumb_title'] = 'Blogs';  
            $data['theme']  = $this->theme_id;   

            if ($id) {
                $data['blogs'] = $product = DB::table('blogs')->where('category',$id)->where('theme',$this->theme_id)->where('status','active')->paginate(12);
            }else{
                $data['blogs'] = $product = DB::table('blogs')->where('theme',$this->theme_id)->where('status','active')->paginate(12);
            }

            $data['recent_blogs'] = $product = DB::table('blogs')->where('theme',$this->theme_id)->where('status','active')->orderBy('id','desc')->limit(4)->get();
            $data['categories'] = $product = DB::table('blog_category')->where('theme',$this->theme_id)->where('status','active')->where('blogs','>',0)->get();
            $data['tranding_products'] = DB::table('products')->where('theme',$this->theme_id)->where('status','active')->orderBy('title','desc')->limit(3)->get(); 

            //header-data-start
            $data['product_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->get();                                            
            $data['daily_staples'] = DB::table('products')->where('status','active')->where('is_daily_staples',1)->where('theme',$this->theme_id)->limit(6)->get();
            $data['top_save_products'] = DB::table('products')
                                            ->where('products.status','active')
                                            ->where('products.theme',$this->theme_id)
                                            ->orderBy('product_price.price','asc')
                                            ->join('product_price','product_price.product_id','products.id')
                                            ->limit(6)->get();  
            $data['recently_added_products'] = DB::table('products')->where('status','active')->orderBy('id','desc')->where('theme',$this->theme_id)->limit(6)->get();     
            $data['product_categories_footer'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->limit(4)->get();                                            
            $data['all_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->orderBy('title')->get();
            $data['deals'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('deal_of_the_day', 1)->get();           
    $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();                   //header-data-end
        
            return view('frontend.pages.blogs',$data);
        }

        public function contact(){
            $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
            $data['title'] = 'Contact | '. $settings->meta_title; 
            $data['breadcrumb_title'] = 'Contact';     
            $data['theme']  = $this->theme_id;

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
    $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();                   //header-data-end

        return view('frontend.pages.contact',$data);
    }

    public function contact_store(Request $req){
        $this->validate($req,[
            'first_name'=>'string|required',
            'last_name'=>'string|required',
            'email'=>'email|required',
            'phone'=>'numeric|required|digits:10',
            'message'=>'required',
        ]);
                        
        $status = DB::table('contact')
        ->insert([
            'first_name'=>$req->get('first_name'),
            'last_name'=>$req->get('last_name'),
            'email'=>$req->get('email'),
            'phone'=>$req->get('phone'),
            'message'=>$req->get('message'),
        ]); 
            
        if($status){
            Toastr::success('Your Request Has Been Submitted Successfully', __('msg_success'));
        }
        else{
            Toastr::error('Please try again !!!', __('msg_error'));
        }
        return redirect()->back();
    }   

    public function login(){
        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        $data['title'] = 'Login | '. $settings->meta_title; 
        $data['breadcrumb_title'] = 'Login';    
        $data['theme']  = $this->theme_id;

        // $data['data']= str_replace(' ', '%20', asset('uploads/setting/' . $settings->logo_path));
        // $data['email'] = 'shukla@gmail.com';
        // return view('emails.password',$data);

        
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
           $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();                      //header-data-end

            return view('frontend.pages.login.login',$data);
        }

        public function login_submit(Request $request){
            $this->validate($request,[
                'email'=>'email|required',          
                // 'password'=>'required|min:6',           
                'password'=>'required',        
            ]);

            $data= $request->all();
            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']],$request->remember)){
                Session::put('user',$data['email']);
                Toastr::success('Successfully login', __('msg_success'));

                if ((strpos($request->last_url, 'products-details') !== false) || ($request->last_url == route('cart')) || ($request->last_url == route('checkout'))) {
                    return redirect()->route('checkout');
                }
                if(auth()->user()->is_admin == 1){
                    return redirect()->route('admin.dashboard.index');
                }
                return redirect()->route('user.user_dashboard');
            }
            else{
                Toastr::error('Invalid email or password please try again !!!', __('msg_error'));
                return redirect()->back();
            }

            // $data= $request->all();
            // if ($data['forgot_password']=='yes') {
            //     $user_email = DB::table('users')->where('email',$data['email'])->where('role','user')->first();
            //     if ($user_email!==null) {
            //         if ($data['email']===$user_email->email) {
            //             $num_str = sprintf("%06d", mt_rand(1, 999999)); 
            //             DB::table('users')->where('id',$user_email->id)->where('role','user')->update([
            //                 'password'=>hash::make($num_str)
            //             ]);
            //             return redirect()->back();
            //         }else{
            //             request()->session()->flash('success','Password sent to '.$data['email']);
            //             return redirect()->back();
            //         }                
            //     }else{
            //         request()->session()->flash('success','Password sent to '.$data['email']);
            //         return redirect()->back();
            //     }            
            // }else{
            //     if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'],'status'=>'active'])){
            //         Session::put('user',$data['email']);
            //         request()->session()->flash('success','Successfully login');
            //         return redirect()->route('index');
            //     }
            //     else{
            //         request()->session()->flash('error','Invalid email or password please try again!');
            //         return redirect()->back();
            //     }
            // }
        }

        public function vender_login(){
            $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
            $data['title'] = 'Login | '. $settings->meta_title; 
            $data['breadcrumb_title'] = 'Login';    
            $data['theme']  = $this->theme_id;
            
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
    $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();                      //header-data-end

            return view('frontend.pages.login.vender_login',$data);
        }

        public function vender_login_submit(Request $request){
            $this->validate($request,[
                'email'=>'email|required',                 
                'password'=>'required',        
            ]);
            
            if($user = DB::table('saller')->where('email',$request->email)->first()){
                if (Hash::check($request->password, $user->password)) {
                    Session::put('vender',$user->id);
                    Toastr::success('Successfully login', __('msg_success'));
                    return redirect()->route('vender.vender_dashboard');
                }  
                Toastr::error('Invalid email or password please try again !!!', __('msg_error'));
                return redirect()->back();                     
            }
            else{
                Toastr::error('Invalid email or password please try again !!!', __('msg_error'));
                return redirect()->back();
            }
        }

        public function register(){
            $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
            $data['title'] = 'register | '. $settings->meta_title; 
            $data['breadcrumb_title'] = 'register';   
            $data['theme']  = $this->theme_id;  

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
    $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();                      //header-data-end

        return view('frontend.pages.login.register',$data);
    }

    public function register_submit(Request $request){
        $this->validate($request,[
            'name'=>'string|required|min:2',
            'email'=>'email|required|unique:users,email',
            'phone'=>'numeric|required|digits:10',
            'password'=>'required|min:6',           
        ]);
        $data=$request->all();
        // dd($data);
        $check=$this->create($data);
        Session::put('user',$data['email']);
        if($check){
            Auth::attempt(['email' => $data['email'], 'password' => $data['password'],'status'=>'active']);
            Toastr::success('Successfully registered', __('msg_success'));

            if ((strpos($request->last_url, 'products-details') !== false) || ($request->last_url == route('cart')) || ($request->last_url == route('checkout')) || ($request->last_url == route('login'))) {
                return redirect()->route('checkout');
            }

            return redirect()->route('index');
        }
        else{
            Toastr::error('Error please try again !!!', __('msg_error'));
            return back();
        }
    }
    
    public function create(array $data){
        return User::create([
            'first_name'=>$data['name'],
            'email'=>$data['email'],
            'phone'=>$data['phone'],
            'password'=>Hash::make($data['password']),
            'password_text'=>Crypt::encryptString($data['password']),
            'status'=>'active'
            ]);
    }

    public function logout(){
        Session::forget('user');
        Auth::logout();
        Toastr::success('Logout successfully', __('msg_success'));
        return back();
    }

    public function forgot_password(){
        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        $data['title'] = 'Forgot Password | '. $settings->meta_title; 
        $data['breadcrumb_title'] = 'Forgot Password';     
        $data['theme']  = $this->theme_id;

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
 $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();                    //header-data-end

        return view('frontend.pages.login.forgot_password',$data);
    }

    public function forgot_password_submit(Request $request){
        $this->validate($request,[
            'email'=>'email|required',      
        ]);
        
        if (DB::table('users')->where('email',$request->email)->exists()) {
            $current_theme = DB::table('themes')->where('current_theme',1)->first();
            $settings = DB::table('settings')->where('theme',$current_theme->id)->first();

            $user_email = DB::table('users')->where('email',$request->email)->first();

            Mail::to('pratapamit361@gmail.com')->send(new ForgotPassword($settings,$user_email->email));
            
            Toastr::success('We have sent your password to your email address !!!', __('msg_success'));
        }else{
            Toastr::error('Provided email does not match with our records, please try again !!!', __('msg_error'));
        }

        return redirect()->back();
    }

    public function add_password(Request $request){
        $this->validate($request,[
            'password'=>'required',      
        ]);
        
        if (DB::table('users')->where('email',$request->email)->exists()) {

            $user_email = DB::table('users')->where('email',$request->email)->first();

            $status = DB::table('users')->where('email',$request->email)
            ->update([
                'password' => Hash::make($request->password),
                'password_text' => Crypt::encryptString($request->password),
            ]);

            if ($status) {
                return response()->json(['success' => 'Your password successfully updated !!!'], 201);
            }else{
                return response()->json(['error' => 'Oops something went wrong, please try again !!!'], 503);
            }            
        }else{
            return response()->json(['error' => 'Provided email does not match with our records, please try again !!!'], 503);
        }

        return redirect()->back();
    }

    public function checkout(Request $request){

        if (! (Auth()->user() && Auth()->user()->id)) {
            return redirect()->route('login');
        }

        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        $data['title'] = 'Checkout | '. $settings->meta_title; 
        $data['breadcrumb_title'] = 'Checkout';  
        $data['theme']  = $this->theme_id; 
        
        $sub_total = 0;
        $user_id = Auth()->user()->id;
        $addresses = false;

        if (Auth()->user() && Auth()->user()->id) {
            if (DB::table('user_addresses')->where('user_id',$user_id)->exists()) {
                $addresses = true;
            }
        }

        $data['addresses'] = $addresses;

        if ($request->checkout == 'from_wishlist') {
            $buy = 'from_wishlist';
            if(session()->get('wishlist')){
                $wishlist = session()->get('wishlist');
                session()->put('checkout_products',$wishlist);     
            }
            $sub_total = Helper::totalWishlistPrice();
            $total_products = Helper::wishlistCount();
        }
        else{
            $buy = 'from_cart';
            if(session()->get('cart')){
                $cart = session()->get('cart');
                session()->put('checkout_products',$cart);     
            }
            $sub_total = Helper::totalCartPrice();
            $total_products = Helper::cartCount();
        }

        $tax = ($sub_total * 18 / 100);
        $shipping = $this->shipping_charges;

        $data['sub_total'] = $sub_total;
        $data['shipping'] = $shipping;
        $data['tax'] = $tax;
        $data['total'] = $sub_total + $shipping + $tax;
        $data['total_products'] = $total_products;

        $data['future_delivery_charge'] = $this->future_delivery_charges;

        $data['buy'] = $buy;

        $data['user_addresses'] = DB::table('user_addresses')
                                ->select('user_addresses.*','provinces.title as state_title')
                                ->where('user_addresses.status','active')
                                ->where('user_addresses.user_id',$user_id)
                                ->join('provinces','provinces.id','user_addresses.state')
                                ->orderBy('user_addresses.id','desc')->get(); 

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
        $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();                   //header-data-end  
                
                return view('frontend.pages.checkout',$data);
            }

            public function checkout2(Request $request){

                if (! (Auth()->user() && Auth()->user()->id)) {
                    return redirect()->route('login');
                }

                $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
                $data['title'] = 'Checkout | '. $settings->meta_title; 
                $data['breadcrumb_title'] = 'Checkout';  
                $data['theme']  = $this->theme_id; 
                
                $sub_total = 0;
                $addresses = false;
                $user_id = Auth()->user()->id;

                if (Auth()->user() && Auth()->user()->id) {
                    if (DB::table('user_addresses')->where('user_id',$user_id)->exists()) {
                        $addresses = true;
                    }
                }

                $data['addresses'] = $addresses;

                    $buy = 'direct_buy';
                    if(session()->get('buy_product')){
                        $cart = session()->get('buy_product');
                        session()->put('checkout_products',$cart);     
                    }
                    $sub_total = Helper::totalBuyPrice();
                    $total_products = Helper::buyCount();
                

                $tax = ($sub_total * 18 / 100);
                $shipping = $this->shipping_charges;

                $data['sub_total'] = $sub_total;
                $data['shipping'] = $shipping;
                $data['tax'] = $tax;
                $data['total'] = $sub_total + $shipping + $tax;
                $data['total_products'] = $total_products;

                $data['future_delivery_charge'] = $this->future_delivery_charges;

                $data['buy'] = $buy;

                $data['user_addresses'] = DB::table('user_addresses')
                                        ->select('user_addresses.*','provinces.title as state_title')
                                        ->where('user_addresses.status','active')
                                        ->where('user_addresses.user_id',$user_id)
                                        ->join('provinces','provinces.id','user_addresses.state')
                                        ->orderBy('user_addresses.id','desc')->get(); 

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
        $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();                   //header-data-end  
                
        return view('frontend.pages.checkout',$data);
    }

    public function fallback(Request $request){

        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        $data['title'] = '404 Page Not Found | '. $settings->meta_title; 
        $data['breadcrumb_title'] = '404 Page Not Found'; 
        $data['theme']  = $this->theme_id;    
        
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
 $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();                    //header-data-end

         return view('frontend.pages.error_page',$data);
    }

     // PDF generate
     public function generate_pdf(Request $request,$id){
        // $order = DB::table('orders')
        //                     ->select('orders.*','users.first_name','users.last_name','user_addresses.house_no','users.email','users.phone'
        //                     ,'user_addresses.area','user_addresses.landmark'
        //                     ,'user_addresses.pin_code','user_addresses.town_city'
        //                     ,'user_addresses.state','user_addresses.address_type'
        //                     ,'provinces.title')
        //                     ->where('orders.status','active')
        //                     ->where('orders.id',$id)
        //                     ->where('user_addresses.default_address',1)
        //                     ->join('user_addresses','user_addresses.user_id','orders.user_id')
        //                     ->join('users','users.id','orders.user_id')
        //                     ->join('provinces','provinces.id','user_addresses.state')
        //                     ->first();


        // $file_name='amit.pdf';        
        // $pdf=PDF::loadview('frontend.pages.generate_pdf');
        // return $pdf->download($file_name);

        // $file_name=$order->order_number.'-'.$order->first_name.'.pdf';        
        // $pdf=PDF::loadview('frontend.pages.generate_pdf',compact('order'));
        // return $pdf->download($file_name);

        
        $data = [
            'id' => $id,  // Assuming you want to pass the $id to the view
            // Add any other data you want to pass here
        ];
    
        // Load the view with the data
        $pdf = PDF::loadView('frontend.pages.generate_pdf', $data);

        return $pdf->stream(); 
    }

    public function save_customer_review(Request $request){
        $request->validate([
            // 'review_title'=>'required',
            'review_message'=>'required',
            'rating'=>'required',
        ]);

        if(empty(auth()->user()) && empty(auth()->user()->id)){
            Toastr::error('Please login or register first !!!', __('msg_error'));
            return back();
        }

        $user_id = Auth()->user()->id;

        $review_title = $request->review_title;
        $review_message = $request->review_message;
        $rating = $request->rating;

        $status = DB::table('customer_reviews')
        ->insert([
            'title'=>$request->review_title ?$request->review_title:"title",
            'message'=>$request->review_message,
            'rating'=>$request->rating,
            'user_id'=>$user_id,
            'product_id'=>$request->product_id,
            'theme'=>$this->theme_id,
        ]);

   if ($status) {
       Toastr::success('Your review submitted successfully', __('msg_success'));
    }else{
        Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
    }  

    return back();
         
    }

    public function order(Request $request)
    {
        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        $this->validate($request,[
            'delivery_option'=>'required',
            'payment_option'=>'required',
        ]);

        if (empty($request->user_address)) {
            $this->validate($request,[
                'address'=>'required',
                'pin_code'=>'required',
            ]);
        }

        if ($request->user_address) {
            $user_address = $request->user_address;
        }else{
            $last_insertd_address_id = DB::table('user_addresses')
            ->insertGetId([
                'address'=>$request->address,
                'pin_code'=>$request->pin_code,
                'name'=>Auth()->user()->first_name,
                'phone'=>Auth()->user()->phone,
                'user_id'=>Auth()->user()->id,
            ]);
            $user_address = $last_insertd_address_id;
        }        
      
        $payment_method = $request->payment_option;
        $tax = $sub_total = $total_amount = 0;
        $shipping_charges = $this->shipping_charges;

        if ($request->delivery_option == 'future_delivery') {
            $this->validate($request,[
                'future_delivery_date'=>'required',
            ]);
        }

        if (!empty($request->future_delivery_date)) {
            $future_delivery_date = $request->future_delivery_date;
            $future_delivery_charges = $this->future_delivery_charges;
        }else{
            $future_delivery_date = null;
            $future_delivery_charges = 0;
        }

        if(empty(auth()->user()->id)){
            Toastr::error('Please login or register first !!!', __('msg_error'));
            return back();
        }

        $user_id = auth()->user()->id;
        $user_detail = DB::table('users')->where('id',$user_id)->first();

        if (empty($user_detail)) {
            Toastr::error('Oops something went wrong, please try again !!!', __('msg_error'));
            return back();
        }

        if ($request->buy=='direct_buy') {
            if(empty(session()->get('buy_product'))){
                Toastr::error('Choose any product to buy !!!', __('msg_error'));
                return back();
            }else{
                $main_array = session()->get('buy_product');
                $buy_through = 'Direct Buy'; 
            }
        }elseif($request->buy=='from_wishlist') {
            if(empty(session()->get('wishlist'))){
                Toastr::error('Choose any product to buy !!!', __('msg_error'));
                return back();
            }else{   
                $main_array = session()->get('wishlist');
                $buy_through = 'Through Wishlist'; 
            }
        }else{
            if(empty(session()->get('cart'))){
                Toastr::error('Cart is Empty !!!', __('msg_error'));
                return back();
            }else{    
                $main_array = session()->get('cart');
                $buy_through = 'Through Cart'; 
            }
        }
       

        $splitSubArrays = [];

        foreach ($main_array as $mainKey => $subArray) {
            foreach ($subArray as $subKey => $data) {
                $newSubArray = [
                    $subKey => $data,
                ];
                $splitSubArrays[][$this->theme_id] = $newSubArray;
            }
        }

        $final_total_amount = 0;
        foreach ($splitSubArrays as $key => $value) {
            $product_detail = json_encode($value);
            $shipping_charges = $this->shipping_charges;

            $sub_total = 0;
            $total_products = 0;            
                if($value){                    
                    foreach ($value as $main_array_key => $main_array_value) {
                    if ($main_array_key == $this->theme_id) {
                        foreach($main_array_value as $main_array_value2){   
                            foreach ($main_array_value2 as $main_array_value3) {
                                $sub_total += $main_array_value3['price'] * $main_array_value3['quantity'];
                                $total_products++;
                            }
                        }     
                    }          
                        
                    }         
                }
                $tax = ($sub_total * 18 / 100);

                foreach ($value as $vender_key => $vender_value) {
                    foreach ($vender_value as $vender_key2 => $vender_value2) {
                        $vender_info = DB::table('products')->find($vender_key2);                        
                    }   
                }
                if ($vender_info->vender) {
                    $vender = $vender_info->vender;
                }else{
                    $vender = 'Admin';
                }

                $total_amount = $sub_total + $shipping_charges + $tax + $future_delivery_charges;
                $final_total_amount += $total_amount;

                $last_order_id = DB::table('orders')->orderBy('id','desc')->latest()->first();  

                if ($last_order_id) {
                    $last_order_number =  str_replace($this->site_name."-","",$last_order_id->order_number);
                    $last_order_data = $this->site_name.'-'.($last_order_number+1);
                }else{
                    $last_order_data = $this->site_name.'-'.(10000);
                }
                try {
                    // DB::beginTransaction();

                    $status = DB::table('orders')->insertGetId([                        
                        'user_id'=>auth()->user()->id,
                        'order_number'=>$last_order_data,                      
                        'total_amount'=>$total_amount,
                        'sub_total'=>$sub_total,            
                        'tax'=>$tax,            
                        'shipping_charges'=>$shipping_charges,  
                        'total_products'=>$total_products,  
                        'payment_method'=>$payment_method,
                        'delivery_type'=>$request->delivery_option,
                        'future_delivery_date'=>$future_delivery_date,
                        'product_detail'=>$product_detail, 
                        'buy_through'=>$buy_through,
                        'future_delivery_charges'=>$future_delivery_charges,  
                        'theme'=>$this->theme_id,  
                        'vender'=>$vender,  
                        'user_address'=>$user_address 
                    ]);
                    // DB::commit();
                } catch (\Throwable $th) {
                    Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
                    return back();
                }
        }

        if ($request->payment_method == 'gateway') {
            $last = DB::table('orders')->where('user_id',auth()->user()->id)->latest()->first();  
            if ($last) {
                $amount = $final_total_amount;        
                $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                $payment = $api->order->create(array('receipt'=>'123', 'amount'=>$amount * 100, 'currency'=>'INR'));
                $paymentId = $payment['id'];                
                $order_data['payment_id']=$paymentId;                        
                Session::put('payment_id',$paymentId);
                Session::put('amount',$amount);                      
            if (Session::has('amount')) {
                echo ' <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                          <form action="'.route("pay").'" method="POST">
                            <script src="https://checkout.razorpay.com/v1/checkout.js"
                            data-key="'.env("RAZORPAY_KEY").'"         
                            data-amount="'.Session::get("amount").'"
                            data-currency="INR"
                            data-order_id="'.Session::get("payment_id").'"
                                data-buttontext="Pay with Razorpay"
                                data-name="'.$settings->title.'"    
                                data-description="'.$settings->title.'" 
                                data-image="'.URL::to('public/'.$settings->logo_path).'"  
                                data-prefill.name="'.$user_detail->first_name.' '.$user_detail->last_name.'"
                                data-prefill.email="'.$user_detail->email.'"
                                data-theme.color="#139c65">
                            </script><input type="hidden" custom="Hidden Element" name="hidden">
                            <input type="hidden" value="'.$last->id.'" name="last_id">
                        </form>
                        <script>
                        $(document).ready(function(){
                            $(".razorpay-payment-button").css("display","none");
                            $(".razorpay-payment-button").trigger("click");
                            });
                    </script>';
                    die;
            }else{
                Toastr::error('Oops something went wrong, please try again !!!', __('msg_error')); 
                return redirect()->back();
            }   
            }else{
                Toastr::error('Oops something went wrong, please try again !!!', __('msg_error'));                                    
                return redirect()->back();
            }
        }
        
        if($request->buy == 'from_cart'){ session()->forget('cart'); }            
        if($request->buy == 'from_wishlist'){ session()->forget('wishlist'); }            
        Toastr::success('Your Order Placed Successfully', __('msg_success'));
        // return redirect()->route('user.user_dashboard');
        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        
        return view('frontend.pages.success',$data);
    }

    public function become_seller(){
        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        $data['title'] = 'Become-Saller | '. $settings->meta_title; 
        $data['breadcrumb_title'] = 'Become-Saller';    
        $data['theme']  = $this->theme_id;

        $data['seller_data'] = DB::table('saller_data')->where('theme',$this->theme_id)->first();
        $data['product_category'] = DB::table('product_category')->where('theme',$this->theme_id)->where('status','active')->get();
        
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
   $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();                      //header-data-end

        return view('frontend.pages.become_seller',$data);
    }

    public function become_a_saller(Request $req){
        $this->validate($req,[
            'company_name'=>'string|required',
            'email'=>'email|required',
            'phone'=>'numeric|required|digits:10',
            'country'=>'required',
            'year_established'=>'required',
            'category'=>'required',
            'address'=>'required',
            'city'=>'required',
            'zip'=>'required',
            'password'=>'required',
            'photo'=>'required'
        ]);

        if ($req->hasFile('photo')) {           
            $imageName = $this->storage_path_saller.$req->photo->getClientOriginalName();            
            $req->photo->move(public_path($this->storage_path_saller), $imageName);
        }else{
            $imageName = null;
        } 
                        
        $status = DB::table('saller')
        ->insertGetId([
            'company_name'=>$req->get('company_name'),
            'email'=>$req->get('email'),
            'phone'=>$req->get('phone'),
            'country'=>$req->get('country'),
            'year_established'=>$req->get('year_established'),
            'category'=>$req->get('category'),
            'address'=>$req->get('address'),
            'city'=>$req->get('city'),
            'zip'=>$req->get('zip'),
            'password'=>Hash::make($req->password),
            'password_text'=>Crypt::encryptString($req->password),
            'photo'=>$imageName,
            'theme'=>$this->theme_id,
        ]); 

        if($status){
            Session::put('vender',$status);
            Toastr::success('Your Request Has Been Submitted Successfully', __('msg_success'));
            return redirect()->route('vender.vender_dashboard');
        }
        else{
            Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
        }
        return redirect()->back();
    } 

    public function compare(Request $request, $slug = null){
        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        $data['title'] = 'Compare | '. $settings->meta_title;  
        $data['breadcrumb_title'] = 'Compare';  
        $data['theme']  = $this->theme_id;           

        if (!$slug) {
            Toastr::error('Oops something went wrong, please try again !!!', __('msg_error'));
            return redirect()->back();
        }

        $data['product'] = $product = DB::table('products')
                                    ->where('products.slug',$slug)
                                    ->where('products.theme',$this->theme_id)
                                    ->select('product_category.title as category_title','products.*')
                                    ->join('product_category','product_category.id','products.category')->first();

        $data['products'] = DB::table('products')->where('theme',$this->theme_id)->where('category',$product->category)->where('id','<>',$product->id)->orderBy('id','desc')->limit(3)->get();

        //header-data-start
        $data['product_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->get();                                            
        $data['daily_staples'] = DB::table('products')->where('status','active')->where('is_daily_staples',1)->where('theme',$this->theme_id)->limit(6)->get();
        $data['top_save_products'] = DB::table('products')
                                        ->where('products.status','active')
                                        ->where('products.theme',$this->theme_id)
                                        ->orderBy('product_price.price','asc')
                                        ->join('product_price','product_price.product_id','products.id')
                                        ->limit(6)->get();  
        $data['recently_added_products'] = DB::table('products')->where('status','active')->orderBy('id','desc')->where('theme',$this->theme_id)->limit(6)->get();     
        $data['product_categories_footer'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->limit(4)->get();                                            
        $data['all_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->orderBy('title')->get();
        $data['deals'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('deal_of_the_day', 1)->get();           
        $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();                   //header-data-end
       
        return view('frontend.pages.compare',$data);

    }

    public function search_products(Request $request){
        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        $data['title'] = 'Search Products | '. $settings->meta_title;  
        $data['breadcrumb_title'] = 'Search Products';  
        $data['theme']  = $this->theme_id;   
                
        $data['products'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where(DB::raw('lower(title)'), 'like', '%' . strtolower($request->search) . '%')->get();
        $data['last_search'] = $request->search;

        //header-data-start
        $data['product_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->get();                                            
        $data['daily_staples'] = DB::table('products')->where('status','active')->where('is_daily_staples',1)->where('theme',$this->theme_id)->limit(6)->get();
        $data['top_save_products'] = DB::table('products')
                                        ->where('products.status','active')
                                        ->where('products.theme',$this->theme_id)
                                        ->orderBy('product_price.price','asc')
                                        ->join('product_price','product_price.product_id','products.id')
                                        ->limit(6)->get();  
        $data['recently_added_products'] = DB::table('products')->where('status','active')->orderBy('id','desc')->where('theme',$this->theme_id)->limit(6)->get();     
        $data['product_categories_footer'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->limit(4)->get();                                            
        $data['all_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->orderBy('title')->get();
        $data['deals'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('deal_of_the_day', 1)->get();           
        $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();                   //header-data-end
       
        return view('frontend.pages.search_products',$data);

    }

    public function newsletter(Request $request){
        $request->validate([
            'email' => 'required|email'
        ]);
        
        $status = $request->email;
        if ($status) {
            Toastr::success('We have successfully received you request', __('msg_success'));
         }else{
             Toastr::error('Oops something wents wrong, please try again !!!', __('msg_error'));
         }  
     
         return back();
    }

    public function track_order(Request $request){

        $order_number = $request->order_number;

        if ($status = DB::table('orders')->where('order_number',$order_number)->first()) {
            return 'Your order number is : '.$order_number.'<br>Your order status is : <span class="badge bg-primary">'.$status->order_status.'</span>';          
         }else{
             return 'Tracking ID / Order ID : '.$order_number.' NA. Could not find this order with us. Please check the order number entered.';
         }  
     
         return back();
    }

    public function faq(Request $request){
        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        $data['title'] = 'FAQ | '. $settings->meta_title;  
        $data['breadcrumb_title'] = 'Frequently Asked Questions';  
        $data['theme']  = $this->theme_id;   
                
        $data['faqs'] = DB::table('faq')->where('status','active')->where('theme',$this->theme_id)->orderBy('id','desc')->get();

        //header-data-start
        $data['product_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->get();                                            
        $data['daily_staples'] = DB::table('products')->where('status','active')->where('is_daily_staples',1)->where('theme',$this->theme_id)->limit(6)->get();
        $data['top_save_products'] = DB::table('products')
                                        ->where('products.status','active')
                                        ->where('products.theme',$this->theme_id)
                                        ->orderBy('product_price.price','asc')
                                        ->join('product_price','product_price.product_id','products.id')
                                        ->limit(6)->get();  
        $data['recently_added_products'] = DB::table('products')->where('status','active')->orderBy('id','desc')->where('theme',$this->theme_id)->limit(6)->get();     
        $data['product_categories_footer'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->limit(4)->get();                                            
        $data['all_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->orderBy('title')->get();
        $data['deals'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('deal_of_the_day', 1)->get();           
        $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();                   //header-data-end
       
        return view('frontend.pages.faq',$data);

    }

    public function terms(Request $request){
        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
        $data['title'] = 'FAQ | '. $settings->meta_title;  
        $data['breadcrumb_title'] = 'Terms & Conditions';  
        $data['theme']  = $this->theme_id;   
                
        //header-data-start
        $data['product_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->get();                                            
        $data['daily_staples'] = DB::table('products')->where('status','active')->where('is_daily_staples',1)->where('theme',$this->theme_id)->limit(6)->get();
        $data['top_save_products'] = DB::table('products')
                                        ->where('products.status','active')
                                        ->where('products.theme',$this->theme_id)
                                        ->orderBy('product_price.price','asc')
                                        ->join('product_price','product_price.product_id','products.id')
                                        ->limit(6)->get();  
        $data['recently_added_products'] = DB::table('products')->where('status','active')->orderBy('id','desc')->where('theme',$this->theme_id)->limit(6)->get();     
        $data['product_categories_footer'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->where('products','>',0)->limit(4)->get();                                            
        $data['all_categories'] = DB::table('product_category')->where('status','active')->where('theme',$this->theme_id)->orderBy('title')->get();
        $data['deals'] = DB::table('products')->where('status','active')->where('theme',$this->theme_id)->where('deal_of_the_day', 1)->get();           
        $data['header_notifications'] = DB::table('header_notifications')->where('status','active')->where('theme',$this->theme_id)->where('date','>=',$this->expiry_date)->get();                   //header-data-end
       
        return view('frontend.pages.terms',$data);

    }

    //api    
    public function api_register_submit(Request $request){

        $validator = Validator::make($request->all(), [
            'name'=>'string|required',
            'email'=>'email|required',
            'phone'=>'numeric|required|digits:10',
            'password'=>'required',
        ]);
 
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'data' => $validator->errors(),                
                ])->header('Access-Control-Allow-Origin', $this->header); 
        } 
        else { 
            $status = DB::table('users')
            ->insert([
                'first_name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'password'=>Hash::make($request->password),
                'password_text'=>Crypt::encryptString($request->password),
            ]); 
        }
            
        if($status){
            return response()->json([
                'status' => 201,
                'data' => 'Your request has been submitted successfully',                
                ])->header('Access-Control-Allow-Origin', $this->header); 
        }
        else{
            return response()->json([
                'status' => 503,
                'data' => 'Oops something went wrong, please try again !!!',                
                ])->header('Access-Control-Allow-Origin', $this->header); 
        }
    }  

    public function api_login_submit(Request $request){

        $validator = Validator::make($request->all(), [
            'email'=>'email|required',
            'password'=>'required',
        ]);
 
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'data' => $validator->errors(),                
                ])->header('Access-Control-Allow-Origin', $this->header); 
        } 
        else { 
            $data= $request->all();
            $user = User::where('email',$request->email)->first();

            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
                $token = $user->createToken($user->first_name)->plainTextToken;
               
                return response()->json([
                    'status' => 201,
                    'data' => 'You are successfully loged in', 
                    'token' => 'Bearer '.$token,                
                    ])->header('Access-Control-Allow-Origin', $this->header); 
            }
            else{
                return response()->json([
                    'status' => 503,
                    'data' => 'Invalid email or password please try again !!!',                
                    ])->header('Access-Control-Allow-Origin', $this->header); 
            }

        }
    }  

    public function api_update_profile(Request $request){

        // $validator = Validator::make($request->all(), [
        //     'name'=>'string|required',
        //     'phone'=>'numeric|required|digits:10',
        //     'email'=>'required|email',
        // ]);
 
        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 400,
        //         'data' => $validator->errors(),                
        //         ])->header('Access-Control-Allow-Origin', $this->header); 
        // } 
        // else { 

            $user_id = Auth()->user()->id;

            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {           
                $imageName = $this->storage_path.$request->photo->getClientOriginalName();            
                $request->photo->move(public_path($this->storage_path), $imageName);
            }else{
                $imageName = Auth()->user()->photo;
            } 

            if (!empty($request->get('name'))) {
                $name = $request->get('name');
            }else{
                $name = Auth()->user()->first_name;
            }

            if (!empty($request->get('phone'))) {
                $phone = $request->get('phone');
            }else{
                $phone = Auth()->user()->phone;
            }

            if (!empty($request->get('email'))) {
                $email = $request->get('email');
            }else{
                $email = Auth()->user()->email;
            }

            try {
                $status = DB::table('users')->where('id',$user_id)
                ->update([
                    'first_name'=>$name,
                    'phone'=>$phone,
                    'email'=>$email,
                    'photo'=>$imageName,
                ]); 
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => 503,
                    'data' => $th->getMessage(),                
                    ])->header('Access-Control-Allow-Origin', $this->header); 
            }

            // if($status){
                return response()->json([
                    'status' => 201,
                    'data' => 'Your profile has been updated successfully.',                
                    ])->header('Access-Control-Allow-Origin', $this->header); 
            // }
            // else{
            //     return response()->json([
            //         'status' => 503,
            //         'data' => 'Oops something went wrong, please try again !!!',                
            //         ])->header('Access-Control-Allow-Origin', $this->header); 
            // }
          
        // }
    }

    public function api_logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response([
            'message'=>'You are successfully logout'
        ]);
    }

    public function api_get_products(){
        $products = Product::where('status','active')
                    ->where('theme',$this->theme_id)
                    ->orderBy('id','desc')
                    // ->select('id','title','slug','photo','sub_photos','category','rating','description','additional_info','care_instruction','status','vender')
                    ->addSelect([
                        'id',
                        'title',
                        'slug',
                        'photo',
                        'sub_photos',
                        'category',
                        'rating',
                        'description',
                        'additional_info',
                        'care_instruction',
                        'status',
                        'vender'
                    ])
                    ->with(['ProductPrice' => function ($query) {
                        $query->select('product_id', 'price','mrp', 'quantity');
                    }])
                    ->get();
        return response()->json([
            'status' => 200,
            'base_url' => URL::to('/'),
            'data' => $products,                
            ])->header('Access-Control-Allow-Origin', $this->header); 
    }  

    public function api_get_product_price($id){
        $product_price = DB::table('product_price')
                    ->where('status','active')
                    ->where('theme',$this->theme_id)
                    ->where('product_id',$id)
                    ->select('id','price','mrp','quantity','product_id')
                    ->get();

        return response()->json([
            'status' => 200,
            'data' => $product_price,                
            ])->header('Access-Control-Allow-Origin', $this->header); 
    }  

    public function api_get_category($id){
        $category = DB::table('product_category')
                    ->where('status','active')
                    ->where('theme',$this->theme_id)
                    ->where('id',$id)
                    ->select('id','title','photo')
                    ->get();

        return response()->json([
            'status' => 200,
            'base_url' => URL::to('/'),
            'data' => $category,                
            ])->header('Access-Control-Allow-Origin', $this->header); 
    }  

    public function api_get_categorylist(){
        $categories = DB::table('product_category')
                    ->where('status','active')
                    ->where('theme',$this->theme_id)
                    ->select('id','title','products','photo')
                    ->get();

        return response()->json([
            'status' => 200,
            'base_url' => URL::to('/'),
            'data' => $categories,                
            ])->header('Access-Control-Allow-Origin', $this->header); 
    }  

    public function api_get_bannerlist(){
        $banners = DB::table('banners')
                    ->where('theme',$this->theme_id)
                    ->select('id','left_title','left_sub_title','left_photo','center_title',
                    'center_sub_title','center_photo','right_title','right_sub_title', 'right_photo')
                    ->get();

        return response()->json([
            'status' => 200,
            'base_url' => URL::to('/'),
            'data' => $banners,                
            ])->header('Access-Control-Allow-Origin', $this->header); 
    }

    public function api_profile(Request $request)
    {
        
        return response()->json([
            'user'=>Auth::user(),
            'status'=>200
        ]);
    }

    public function api_order(Request $request){

    
            $user = auth()->user();
            if($user){
                
        $validator = Validator::make($request->all(), [
            'address'=>'required',
            'pincode' => 'int|required',
            'payment_option'=>'required|in:cod,gateway',
            'delivery_option' => 'required|in:future_delivery,standard_delivery',
            'products'=>'required',
            'buy'=>'required|in:direct_buy,from_wishlist,from_cart'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'error' => $validator->errors(),                
                ])->header('Access-Control-Allow-Origin', $this->header); 
        }
        
       

        // if ($request->user_address) {
        //     $user_address = $request->user_address;
        // }else{
            $last_insertd_address_id = DB::table('user_addresses')
            ->insertGetId([
                'address'=>$request->address,
                'pin_code'=>$request->pincode,
                'name'=>Auth()->user()->first_name,
                'phone'=>Auth()->user()->phone,
                'user_id'=>Auth()->user()->id,
            ]);
            $user_address = $last_insertd_address_id;
            // dd(DB::table('user_addresses')->find($user_address));
        // }        
        $payment_method = $request->payment_option;
        $tax = $sub_total = $total_amount = 0;
        $shipping_charges = $this->shipping_charges;
        
        if ($request->delivery_option == 'future_delivery') {
            $this->validate($request,[
                'future_delivery_date'=>'required',
            ]);
        }
       
        if (!empty($request->future_delivery_date)) {
            $future_delivery_date = $request->future_delivery_date;
            $future_delivery_charges = $this->future_delivery_charges;
        }else{
            $future_delivery_date = null;
            $future_delivery_charges = 0;
        }

        if(empty(auth()->user()->id)){
            return response()->json(["message"=>"login first","status"=>400]);
        }
        
        $user_id = auth()->user()->id;
        $user_detail = DB::table('users')->where('id',$user_id)->first();
        
        if (empty($user_detail)) {
            return response()->json(["message"=>"user data not found","status"=>404]);
        }

        // dd(gettype($request->products));
        if ($request->buy=='direct_buy') {
           
                $main_array1 = $request->products;
                $buy_through = 'Direct Buy'; 
            
        }elseif($request->buy=='from_wishlist') {
              
                $main_array1 = $request->products;
                $buy_through = 'Through Wishlist'; 
            
        }else{
            
                $main_array1 = $request->products;
                $buy_through = 'Through Cart'; 
            
        }
        $main_array = json_decode($main_array1, true);
        if ($main_array === null) {
            echo 'Error decoding JSON: ' . json_last_error_msg();
        }
        // die();
        $final_total_amount = 0;
        
            $sub_total = 0;
            $total_products = 0;            
                if($main_array){                    
                    foreach ($main_array as $main_array_key => $main_array_value) {
                        // $main_array_value = json_decode($main_array_value_json, true);
                        
                    if ($main_array_value['theme']== $this->theme_id) {
                                $sub_total += $main_array_value['price'] * $main_array_value['quantity'];
                                $total_products++;
                                 
                        }else{
                            return response()->json([
                                'error'=> 'theme of product should be the current theme',
                                'staus'=>400
                            ]);
                        } 
                     
                    }         
                }
                $tax = ($sub_total * 18 / 100);
                $products_array =[];
                foreach ($main_array as $vender_key => $vender_value) {
                    // $vender_value = json_decode($vender_value_json, true);

                    $vender_info = DB::table('products')->find($vender_value['product_id']);                        
                    $products_array[]=$vender_info;
                }
                // dd($products_array);
                if ($vender_info->vender) {
                    $vender = $vender_info->vender;
                }else{
                    $vender = 'Admin';
                }
               
                $total_amount = $sub_total + $shipping_charges + $tax + $future_delivery_charges;
                $final_total_amount += $total_amount;
                
                $last_order_id = DB::table('orders')->orderBy('id','desc')->latest()->first();  
               
                if ($last_order_id) {
                    $last_order_number =  str_replace($this->site_name."-","",$last_order_id->order_number);
                    $last_order_data = $this->site_name.'-'.($last_order_number+1);
                }else{
                    $last_order_data = $this->site_name.'-'.(10000);
                }
               
                 try {
                    // DB::beginTransaction();

                    $status = DB::table('orders')->insertGetId([                        
                        'user_id'=>auth()->user()->id,
                        'order_number'=>$last_order_data,                      
                        'total_amount'=>$total_amount,
                        'sub_total'=>$sub_total,            
                        'tax'=>$tax,            
                        'shipping_charges'=>$shipping_charges,  
                        'total_products'=>$total_products,  
                        'payment_method'=>$payment_method,
                        'delivery_type'=>$request->delivery_option,
                        'future_delivery_date'=>$future_delivery_date,
                        'product_detail'=>json_encode($main_array),
                        'buy_through'=>$buy_through,
                        'future_delivery_charges'=>$future_delivery_charges,  
                        'theme'=>$this->theme_id,  
                        'vender'=>$vender,  
                        'user_address'=>$user_address 
                    ]);
                    // DB::commit();

                    // dd($status);
                   
                } catch (\Throwable $th) {
                    
                    return $th;
                }
        
        $data['settings'] = $settings = DB::table('settings')->where('theme',$this->theme_id)->first();
       
        if ($request->payment_method == 'gateway') {
           
            $last = DB::table('orders')->where('user_id',auth()->user()->id)->latest()->first();  
            if ($last) {
                $amount = $final_total_amount;        
                $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
                $payment = $api->order->create(array('receipt'=>'123', 'amount'=>$amount * 100, 'currency'=>'INR'));
                $paymentId = $payment['id'];                
                $order_data['payment_id']=$paymentId;                        
               
                echo ' <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                          <form action="'.route("pay").'" method="POST">
                            <script src="https://checkout.razorpay.com/v1/checkout.js"
                            data-key="'.env("RAZORPAY_KEY").'"         
                            data-amount="'.Session::get("amount").'"
                            data-currency="INR"
                            data-order_id="'.Session::get("payment_id").'"
                                data-buttontext="Pay with Razorpay"
                                data-name="'.$settings->title.'"    
                                data-description="'.$settings->title.'" 
                                data-image="'.URL::to('public/'.$settings->logo_path).'"  
                                data-prefill.name="'.$user_detail->first_name.' '.$user_detail->last_name.'"
                                data-prefill.email="'.$user_detail->email.'"
                                data-theme.color="#139c65">
                            </script><input type="hidden" custom="Hidden Element" name="hidden">
                            <input type="hidden" value="'.$last->id.'" name="last_id">
                        </form>
                        <script>
                        $(document).ready(function(){
                            $(".razorpay-payment-button").css("display","none");
                            $(".razorpay-payment-button").trigger("click");
                            });
                    </script>';
                    // die;
             
            }else{
                                                   
                return response()->json(['user not found for payment']);
            }
        }
        

        return response()->json([
            'message'=>'order successful',
            'data'=>$products_array,
            'status'=>201,
            'success'=>true
        ]);
      

            }else{
                return response()->json([
                    'message'=>'token expired or invalid',
                    'status' => 400,               
                    ])->header('Access-Control-Allow-Origin', $this->header); 
            }
        

    }
}
