<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('IDLoai','desc')->get(); 
        $brand_product = DB::table('tbl_brand_product')->orderby('IDnhasanxuat','desc')->get(); 
       

        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product',$brand_product);
    	

    }
     public function all_product_user(){
        
        
        $brand = DB::table('tbl_brand_product')->orderby('IDnhasanxuat','desc')->get(); 
        $cate_product = DB::table('tbl_category_product')->orderby('IDLoai','desc')->get(); 
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.IDLoai','=','tbl_product.IDLoai')
        ->join('tbl_brand_product','tbl_brand_product.IDnhasanxuat','=','tbl_product.IDnhasanxuat')
        ->orderby('tbl_product.product_id','desc')->get();
        
        return view('pages.sanpham.sp_all')->with('all_product',$all_product)->with('brand',$brand)->with('category',$cate_product);

    }
    public function all_product(){
        $this->AuthLogin();
    	$all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.IDLoai','=','tbl_product.IDLoai')
        ->join('tbl_brand_product','tbl_brand_product.IDnhasanxuat','=','tbl_product.IDnhasanxuat')
        ->orderby('tbl_product.product_id','desc')->get();
    	$manager_product  = view('admin.all_product')->with('all_product',$all_product);
    	return view('admin_layout')->with('admin.all_product', $manager_product);

    }
    public function save_product(Request $request){
         $this->AuthLogin();
    	$data = array();
    	$data['product_name'] = $request->product_name;
        $data['product_slug'] = $request->product_slug;
    	$data['product_price'] = $request->product_price;
    	$data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['IDLoai'] = $request->product_cate;
        $data['IDnhasanxuat'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $data['product_soluong'] = $request->product_soluong;
        $data['trangthai'] = $request->trangthai;
       
        $get_image = $request->file('product_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('add-product');
        }
        $data['product_image'] = '';
    	DB::table('tbl_product')->insert($data);
    	Session::put('message','Thêm sản phẩm thành công');
    	return Redirect::to('all-product');
    }
    public function unactive_product($product_id){
         $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');

    }
    public function active_product($product_id){
         $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
         $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('IDLoai','desc')->get(); 
        $brand_product = DB::table('tbl_brand_product')->orderby('IDnhasanxuat','desc')->get(); 

        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();

        $manager_product  = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);

        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }
    public function update_product(Request $request,$product_id){
         $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
       
        $data['product_slug'] = $request->product_slug;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['IDLoai'] = $request->product_cate;
        $data['IDnhasanxuat'] = $request->product_brand;
        $data['product_soluong'] = $request->product_soluong;
        $data['product_status'] = $request->product_status;
        $data['trangthai'] = $request->trangthai;
        $get_image = $request->file('product_image');
        
        if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/product',$new_image);
                    $data['product_image'] = $new_image;
                    DB::table('tbl_product')->where('product_id',$product_id)->update($data);
                    Session::put('message','Cập nhật sản phẩm thành công');
                    return Redirect::to('all-product');
        }
            
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }
    //End Admin Page
    public function details_product($product_slug){
         $all_product = DB::table('tbl_product')
         ->where('product_status','0') 
         ->orderby('product_id','desc')->get(); 
        $cate_product = DB::table('tbl_category_product')->orderby('IDLoai','desc')->get(); 
        $brand_product = DB::table('tbl_brand_product')->orderby('IDnhasanxuat','desc')->get(); 

        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.IDLoai','=','tbl_product.IDLoai')
        ->join('tbl_brand_product','tbl_brand_product.IDnhasanxuat','=','tbl_product.IDnhasanxuat')
        ->where('tbl_product.product_slug',$product_slug)->get();

        foreach($details_product as $key => $value){
            $IDLoai = $value->IDLoai;
        }
      

        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.IDLoai','=','tbl_product.IDLoai')
        ->join('tbl_brand_product','tbl_brand_product.IDnhasanxuat','=','tbl_product.IDnhasanxuat')
        ->where('tbl_category_product.IDLoai',$IDLoai)->whereNotIn('tbl_product.product_slug',[$product_slug])->get();


        return view('pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)->with('product_details',$details_product)->with('relate',$related_product)->with('all_product',$all_product);

    }
    public function list_product_for_cate($slug_cate){
        $all_product = DB::table('tbl_product')
         ->where('product_status','0') 
         ->orderby('product_id','desc')->get();
          $IDLoai_ = DB::table('tbl_category_product')
         ->where('slug_category_product',$slug_cate)->select('IDLoai')->get(); 
         
         foreach ($IDLoai_ as $key => $value) {
             $IDLoai = $value->IDLoai;
         }
         $list_product_cate = DB::table('tbl_product')->where('IDLoai',$IDLoai)->get(); 
          $brand = DB::table('tbl_brand_product')->orderby('IDnhasanxuat','desc')->get(); 
          $cate_product = DB::table('tbl_category_product')->orderby('IDLoai','desc')->get(); 


         return view('pages.sanpham.sp_theoloai')->with('all_product',$all_product)->with('brand',$brand)->with('slug_cate',$slug_cate)->with('category',$cate_product)->with('list_product_cate',$list_product_cate);
    }
    public function list_product_for_brand($slug_brand){
        $all_product = DB::table('tbl_product')
         ->where('product_status','0') 
         ->orderby('product_id','desc')->get();
          $IDLoai_ = DB::table('tbl_brand_product')
         ->where('slug_brand_product',$slug_brand)->select('IDnhasanxuat')->get(); 
         
         foreach ($IDLoai_ as $key => $value) {
             $IDnhasanxuat = $value->IDnhasanxuat ;
         }
         $list_product_brand = DB::table('tbl_product')->where('IDnhasanxuat',$IDnhasanxuat)->get(); 
          $brand = DB::table('tbl_brand_product')->orderby('IDnhasanxuat','desc')->get(); 
          $cate_product = DB::table('tbl_category_product')->orderby('IDLoai','desc')->get(); 

          //print_r($list_product_brand);
         return view('pages.sanpham.sp_brand')->with('all_product',$all_product)->with('brand',$brand)->with('slug_brand',$slug_brand)->with('category',$cate_product)->with('list_product_brand',$list_product_brand);
    }
}
