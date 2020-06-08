<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Banner;
session_start();

class HomeController extends Controller
{
    public function index(){
        //$banner = Banner::orderby('banner_id','DESC')->where('banner_status','1')->take(3)->get();  

    	$cate_product = DB::table('tbl_category_product')->orderby('IDLoai','desc')->get(); 
        $brand = DB::table('tbl_brand_product')->orderby('IDnhasanxuat','desc')->get(); 
     
         $all_product = DB::table('tbl_product')
         ->where('product_status','0')
         
         ->orderby('product_id','desc')->get(); 

          $cate_product_hot = DB::table('tbl_category_product')
          ->join('tbl_product','tbl_product.IDLoai','=','tbl_category_product.IDLoai')
         ->select('tbl_category_product.slug_category_product','tbl_category_product.TenLoai','tbl_product.IDLoai')
         ->where('tbl_product.trangthai','0')
         
          
          ->groupBy('tbl_category_product.TenLoai','tbl_category_product.slug_category_product','tbl_product.IDLoai')
         
          ->get();
       
         




    	/*return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product_main',$all_product)->with('banner',$banner);*/
        return view('pages.sanpham.sp_noibat')->with('category',$cate_product)->with('brand',$brand)->with('all_product',$all_product)->with('cate_product_hot',$cate_product_hot);
    }
    public function contact_us(){

        $cate_product = DB::table('tbl_category_product')->orderby('IDLoai','desc')->get(); 
        $brand_product = DB::table('tbl_brand_product')->orderby('IDnhasanxuat','desc')->get();        
        return view('contact-us')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function source_code(){

        $cate_product = DB::table('tbl_category_product')->orderby('IDLoai','desc')->get(); 
        $brand_product = DB::table('tbl_brand_product')->orderby('IDnhasanxuat','desc')->get();        
        return view('pages.source-code')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function search(Request $request){

        $keywords = $request->keywords_submit;
        $cate_product = DB::table('tbl_category_product')->orderby('IDLoai','desc')->get(); 
        $brand_product = DB::table('tbl_brand_product')->orderby('IDnhasanxuat','desc')->get(); 

        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get(); 

        $all_product = DB::table('tbl_product')
         ->where('product_status','0')
         
         ->orderby('product_id','desc')->get(); 
        return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product)->with('keywords',$keywords)->with('all_product',$all_product);

    }
    public function nhom6(){
        $cate_product = DB::table('tbl_category_product')->orderby('IDLoai','desc')->get(); 
        $brand = DB::table('tbl_brand_product')->orderby('IDnhasanxuat','desc')->get(); 
     
         $all_product = DB::table('tbl_product')
         ->where('product_status','0')
         
         ->orderby('product_id','desc')->get(); 
      return view('info_nhom6')->with('category',$cate_product)->with('brand',$brand)->with('all_product',$all_product);
    }
}
