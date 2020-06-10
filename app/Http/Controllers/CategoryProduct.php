<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

use App\Imports\ImportCategory;
use App\Exports\ExportCategory;
use Excel;
use CategoryProductModel;

class CategoryProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category_product');
    }
    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product  = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.all_category_product', $manager_category_product);


    }
    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['TenLoai'] = $request->TenLoai;
        $data['slug_category_product'] = $request->slug_category_product;
        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-category-product');
    }
    public function edit_category_product($IDLoai){
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('IDLoai',$IDLoai)->get();

        $manager_category_product  = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);

        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }
    public function update_category_product(Request $request,$IDLoai){
        $this->AuthLogin();
        $data = array();
        $data['TenLoai'] = $request->TenLoai;
        $data['slug_category_product'] = $request->slug_category_product;
        DB::table('tbl_category_product')->where('IDLoai',$IDLoai)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($IDLoai){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('IDLoai',$IDLoai)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    //End Function Admin Page
    public function show_category_home($slug_category_product){
        $cate_product = DB::table('tbl_category_product')->orderby('IDLoai','desc')->get(); 
        $brand_product = DB::table('tbl_brand_product')->orderby('IDnhasanxuat','desc')->get(); 

        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.IDLoai','=','tbl_category_product.IDLoai')->where('tbl_category_product.slug_category_product',$slug_category_product)->get();
        
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.slug_category_product',$slug_category_product)->limit(1)->get();

        return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name);
    }
    public function export_loaisp(){
               return Excel::download(new ExportCategory , 'CategoryProduct.xlsx');
    }
    public function excel_loai(){
               return view('admin.excel.loai');
    }
     public function import_loaisp(Request $request){
       /* if($request ->hasfile('file')){
            $file = $request->file;
            echo "Ok";
            $exten = $file->getClientOriginalExtension() ;
            echo $exten;
             if($exten != 'xlsx' ){
                echo "Lỗi ngay";
             }else echo "OKKKK";
        }else echo "Chua co file";*/

        if($request ->hasfile('file')){
            $path = $request->file('file')->getRealPath();
        Excel::import(new ImportCategory, $path);

        Session::put('message','<script type="text/javascript">alert(\'Import thành công.\');</script>');
        return back();
        }else {
            Session::put('message','<script type="text/javascript">alert(\'Chưa có file. Import thất bại.\');</script>');
              return back();
        }
        // $path = $request->file('file')->getRealPath();
        // Excel::import(new ImportCategory, $path);

        // return back();

    }
   

}
