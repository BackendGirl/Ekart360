<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
// use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Support\Str;
use Helper;
use Session;
use DB;
use Toastr;
use Exception;
class CartController extends Controller
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

       } catch (\Throwable $th) {
          throw new Exception("505, Server Error");
         die;
       }
    }

    protected $product=null;

    public function addToCart(Request $request){

        // $request->validate([
        //     'slug'      =>  'required',
        //     'quant'      =>  'required',
        //     'weight'      =>  'required',
        //     'price'      =>  'required',
        // ]);


        $product = DB::table('products')->where('slug', $request->slug)->first();
        
        $weight = $request->weight;
        $price = $request->price;
        $this->theme_id = $this->theme_id;

        if ($request->mrp) {
            $mrp = $request->mrp;
        }else{
            $mrp = null;
        }

        if ($product->vender) {
            $vender = $product->vender;
        }else{
            $vender = null;
        }

        // return($request->all());
        // // die;

        if ( ($request->quant < 1) || empty($product) ) {
            Toastr::error('Invalid Products !!!', __('msg_error'));
            return back();
        }   
        // return session()->get('cart');

        if ($request->cart_btn) {  
            $cart = session()->get('cart');
        if (!$cart) { 
            $cart =[
                $this->theme_id=>[
                    $product->id=>[
                        $weight =>[
                            'product_id'=>$product->id,
                            'weight'=>$weight,
                            'quantity'=>$request->quant,
                            'price'=>$price,
                            'mrp'=>$mrp,
                            'theme'=>$this->theme_id,
                            'vender'=>$vender,
                        ]
                    ] 
                ]
                ];
                session()->put('cart',$cart);
                Toastr::success('Product successfully added to cart', __('msg_success'));
            return back();     
        }
        

        if (isset($cart[$this->theme_id][$product->id][$weight])) {   

            $cart[$this->theme_id][$product->id][$weight]['quantity']=$cart[$this->theme_id][$product->id][$weight]['quantity']+$request->quant;
            session()->put('cart',$cart);
            // Toastr::success('Product successfully added to cart', __('msg_success'));
            // return back();     
            return 200;
        }

        $cart[$this->theme_id][$product->id][$weight]=[
                    'product_id'=>$product->id,
                    'weight'=>$weight,
                    'quantity'=>$request->quant,
                    'price'=>$price,
                    'mrp'=>$mrp,
                    'theme'=>$this->theme_id,
                    'vender'=>$vender,
        ];
        session()->put('cart',$cart);
        Toastr::success('Product successfully added to cart', __('msg_success'));
        }
        if ($request->wishlist_btn) {
            $wishlist = session()->get('wishlist');
        if (!$wishlist) {
            $wishlist =[
                $this->theme_id=>[
                    $product->id =>[
                        $weight =>[
                            'product_id'=>$product->id,
                            'weight'=>$weight,
                            'quantity'=>$request->quant,
                            'price'=>$price,
                            'mrp'=>$mrp,
                            'theme'=>$this->theme_id,
                            'vender'=>$vender,
                        ]
                    ]
                ]
                ];
                session()->put('wishlist',$wishlist);
                Toastr::success('Product successfully added to wishlist', __('msg_success'));
            return back();     
        }

        if (isset($wishlist[$this->theme_id][$product->id][$weight])) {
            $wishlist[$this->theme_id][$product->id][$weight]['quantity']=$wishlist[$this->theme_id][$product->id][$weight]['quantity']+$request->quant;
            session()->put('wishlist',$wishlist);
            // Toastr::success('Product successfully added to wishlist', __('msg_success'));
            // return back();   
            return 200;  
        }

        $wishlist[$this->theme_id][$product->id][$weight]=[
                    'product_id'=>$product->id,
                    'weight'=>$weight,
                    'quantity'=>$request->quant,
                    'price'=>$price,
                    'mrp'=>$mrp,
                    'theme'=>$this->theme_id,
                    'vender'=>$vender,
        ];
        session()->put('wishlist',$wishlist);
        Toastr::success('Product successfully added to wishlist', __('msg_success'));
        }

        if ($request->buy_btn) {
            $buy_product = session()->get('buy_product');           
        if ($buy_product) {
            Session::forget('buy_product');
        }
        $buy_product =[
           $this->theme_id=>[
            $product->id =>[
                $weight =>[
                    'product_id'=>$product->id,
                    'weight'=>$weight,
                    'quantity'=>$request->quant,
                    'price'=>$price,
                    'mrp'=>$mrp,
                    'theme'=>$this->theme_id,
                    'vender'=>$vender,
                ]
            ]
           ]
            ];
            session()->put('buy_product',$buy_product);
            // echo '<pre>';
            // print_r(session()->get('buy_product'));
            // die;
            if (session()->get('buy_product')) {
                if ($request->buy_btn=='buy_btn') {
                    return redirect()->route('checkout2');
                }
                if ($request->buy_btn=='buy_btn_wishlist') {
                    return redirect()->route('checkout3');
                }
                
            }else{
                Toastr::error('Error please try again !!!', __('msg_error'));
            }        
        }

        
                return back();     
    } 
    
    public function cartDelete(Request $request){
        $request->validate([
            'id'      =>  'required',
            'weight'      =>  'required'
        ]);

        $cart = session()->get('cart');
        if (isset($cart[$this->theme_id][$request->id][$request->weight])) {
            unset($cart[$this->theme_id][$request->id][$request->weight]);
            session()->put('cart',$cart);
            Toastr::success('Cart successfully removed', __('msg_success'));
            return back();
        }else{
            Toastr::error('Error please try again !!!', __('msg_error'));
            return back();       
        }
    }     

    public function cartUpdate(Request $request){
        $quantity = $request->get('value');
        $product_id = $request->get('product_id');
        $product_weight = $request->get('product_weight');
        
        $cart = session()->get('cart');

        $cart[$this->theme_id][$product_id][$product_weight]['quantity']=$quantity;

        session()->put('cart',$cart);           

        if(session()->get('cart')){
            $total=0;
            foreach (session()->get('cart') as $key => $value) {
                foreach($value as $value2){
                    $total += $value2['price']*$value2['quantity'];
                } 
                
            }      
            return $total;       
        }
        else{
            return 0;
        }
    }

    public function checkout(Request $request){
        return view('frontend.pages.checkout');
    }

    public function wishlistDelete(Request $request){
        $request->validate([
            'id'      =>  'required',
            'weight'      =>  'required'
        ]);

        $wishlist = session()->get('wishlist');
        
        if (isset($wishlist[$this->theme_id][$request->id][$request->weight])) {
            unset($wishlist[$this->theme_id][$request->id]);
            session()->put('wishlist',$wishlist);
            Toastr::success('Wishlist successfully removed', __('msg_success'));
            return back();
        }else{
            Toastr::error('Error please try again !!!', __('msg_error'));
            return back();       
        }   
    }

    

}
