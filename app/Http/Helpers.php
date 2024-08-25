<?php
namespace App;

use App\Models\Message;
use App\Models\Category;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\Shipping;
use App\Models\Cart;
use Exception;
use DB;
class Helper{


    public static function wishlistCount($para = null){
        try {
            $current_theme = DB::table('themes')->where('current_theme',1)->first();
            if(!$current_theme){
                throw new Exception("505, Server Error");
                die;
            }
            $theme_id = $current_theme->id;

       } catch (\Throwable $th) {
          throw new Exception("505, Server Error");
         die;
       }

        $wishlist_count = 0;
        if(session()->get('wishlist')){            
            foreach(session()->get('wishlist') as $wishlist_key=>$value){
                if($wishlist_key == $theme_id){
                    foreach($value as $key2=>$value2){  
                        foreach ($value2 as $value3) {
                            $wishlist_count++;
                        }
                    }
                }
            }
         }

         return $wishlist_count;
    }

    public static function cartCount($para = null){
        try {
            $current_theme = DB::table('themes')->where('current_theme',1)->first();
            if(!$current_theme){
                throw new Exception("505, Server Error");
                die;
            }
            $settings = DB::table('settings')->first(); 
            $site_name = $settings->title;            
            $theme = $current_theme->slug;
            $theme_id = $current_theme->id;
            $review_storage_path = '/storage/photos/'.$theme.'/customer_review/';

       } catch (\Throwable $th) {
          throw new Exception("505, Server Error");
         die;
       }
       
        $cart_count = 0;
        if(session()->get('cart')){
            foreach(session()->get('cart') as $cart_key=>$value){
                if ($cart_key == $theme_id) {
                    foreach ($value as $key => $value2) {
                        foreach ($value2 as $value3) {
                            $cart_count++;
                        }
                    }
                }
            }
        }

         return $cart_count;
    }

    public static function totalCartPrice($para = null){
        try {
            $current_theme = DB::table('themes')->where('current_theme',1)->first();
            if(!$current_theme){
                throw new Exception("505, Server Error");
                die;
            }
            $settings = DB::table('settings')->first(); 
            $site_name = $settings->title;            
            $theme = $current_theme->slug;
            $theme_id = $current_theme->id;
            $review_storage_path = '/storage/photos/'.$theme.'/customer_review/';

       } catch (\Throwable $th) {
          throw new Exception("505, Server Error");
         die;
       }

        $total_cart_price = 0;
        if(session()->get('cart')){                    
            foreach (session()->get('cart') as $key => $value) {
               if ($key == $theme_id) {
                foreach($value as $key2=>$value2){   
                //    if($key2 == $para){
                    foreach ($value2 as $value3) {
                        $total_cart_price += $value3['price']*$value3['quantity'];
                    }
                //    }
                }     
               }          
                
            }         
        }
         return $total_cart_price;
    }

    public static function totalWishlistPrice($para = null){
        try {
            $current_theme = DB::table('themes')->where('current_theme',1)->first();
            if(!$current_theme){
                throw new Exception("505, Server Error");
                die;
            }
            $settings = DB::table('settings')->first(); 
            $site_name = $settings->title;            
            $theme = $current_theme->slug;
            $theme_id = $current_theme->id;
            $review_storage_path = '/storage/photos/'.$theme.'/customer_review/';

       } catch (\Throwable $th) {
          throw new Exception("505, Server Error");
         die;
       }
       
        $total_cart_price = 0;
        if(session()->get('wishlist')){                    
            foreach (session()->get('wishlist') as $key => $value) {
               if ($key == $theme_id) {
                foreach($value as $key2=>$value2){                  
                    foreach ($value2 as $value3) {
                        $total_cart_price += $value3['price']*$value3['quantity'];
                    }
                }     
               }          
                
            }         
        }

         return $total_cart_price;
    }

    public static function totalBuyPrice($para = null){
        try {
            $current_theme = DB::table('themes')->where('current_theme',1)->first();
            if(!$current_theme){
                throw new Exception("505, Server Error");
                die;
            }
            $settings = DB::table('settings')->first(); 
            $site_name = $settings->title;            
            $theme = $current_theme->slug;
            $theme_id = $current_theme->id;
            $review_storage_path = '/storage/photos/'.$theme.'/customer_review/';

       } catch (\Throwable $th) {
          throw new Exception("505, Server Error");
         die;
       }
       
        $total_cart_price = 0;
        if(session()->get('buy_product')){                    
            foreach (session()->get('buy_product') as $key => $value) {
               if ($key == $theme_id) {
                foreach($value as $key2=>$value2){                  
                    foreach ($value2 as $value3) {
                        $total_cart_price += $value3['price']*$value3['quantity'];
                    }
                }     
               }          
                
            }         
        }

         return $total_cart_price;
    }

    public static function buyCount($para = null){
        try {
            $current_theme = DB::table('themes')->where('current_theme',1)->first();
            if(!$current_theme){
                throw new Exception("505, Server Error");
                die;
            }
            $settings = DB::table('settings')->first(); 
            $site_name = $settings->title;            
            $theme = $current_theme->slug;
            $theme_id = $current_theme->id;
            $review_storage_path = '/storage/photos/'.$theme.'/customer_review/';

       } catch (\Throwable $th) {
          throw new Exception("505, Server Error");
         die;
       }
       
        $cart_count = 0;
        if(session()->get('buy_product')){
            foreach(session()->get('buy_product') as $cart_key=>$value){
                if ($cart_key == $theme_id) {
                    foreach ($value as $key => $value2) {
                        foreach ($value2 as $value3) {
                            $cart_count++;
                        }
                    }
                }
            }
        }

         return $cart_count;
    }

}

?>