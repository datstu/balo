<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class BrandProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }
    public function all_brand_product(){
        $this->AuthLogin();
        $all_brand_product = DB::table('tbl_brand_product')->get();
        $manager_brand_product  = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);


    }
    public function save_brand_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['TenNhasanxuat'] = $request->TenNhasanxuat;
        $data['slug_brand_product'] = $request->slug_brand_product;
         

        $get_image = $request->file('brand_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/brand',$new_image);
            $data['image'] = $new_image;
           DB::table('tbl_brand_product')->insert($data);
             Session::put('message','Thêm thương hiệu sản phẩm thành công');
          
        }else {
              Session::put('message','Vui lòng chọn file. ');
         
        }
         return Redirect::to('add-brand-product');



        
       
        
    }
    public function edit_brand_product($IDnhasanxuat){
        $this->AuthLogin();
        $edit_brand_product = DB::table('tbl_brand_product')->where('IDnhasanxuat',$IDnhasanxuat)->get();

        $manager_brand_product  = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);


        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }
    public function update_brand_product(Request $request,$IDnhasanxuat){
        $this->AuthLogin();
        $data = array();
        $data['TenNhasanxuat'] = $request->TenNhasanxuat;
        $data['slug_brand_product'] = $request->slug;

        $get_image = $request->file('brand_image');
        
        if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/brand',$new_image);
                    $data['image'] = $new_image;
                    DB::table('tbl_brand_product')->where('IDnhasanxuat',$IDnhasanxuat)->update($data);
                     Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
                   
        }else {

            DB::table('tbl_brand_product')->where('IDnhasanxuat',$IDnhasanxuat)->update($data);
                  Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
        }



        
        return Redirect::to('all-brand-product');
    }
    public function delete_brand_product($IDnhasanxuat){
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('IDnhasanxuat',$IDnhasanxuat)->delete();
        Session::put('message','Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    //End Function Admin Page
     
     public function show_brand_home($slug_brand_product){
        $cate_product = DB::table('tbl_category_product')->orderby('IDLoai','desc')->get(); 
        $brand_product = DB::table('tbl_brand_product')->orderby('IDnhasanxuat','desc')->get(); 

        $brand_by_id = DB::table('tbl_product')->join('tbl_brand_product','tbl_product.IDnhasanxuat','=','tbl_brand_product.IDnhasanxuat')->where('tbl_brand_product.slug_brand_product',$slug_brand_product)->get();

        $brand_name = DB::table('tbl_brand_product')->where('tbl_brand_product.slug_brand_product',$slug_brand_product)->limit(1)->get();

        return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name);
    }
 
}
