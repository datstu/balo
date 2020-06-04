<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class ShowProduct extends Controller
{
    public function index(){
    	$product = DB::table('tbl_product')->get();
      $sanpham = DB::table('tbl_category_product')->get();
    	// $qlydssanpham = view('admin.danhsachsanpham')->with('dssanpham',$dssanpham);
    	return view('page.home')->with('product',$product);
    }
     public function chitietsanpham($id)
    {

      $chitietbalo=DB::table('tbl_product')->where('tbl_product.product_id',$id)->get();
       
       foreach ($chitietbalo as $key => $value) {
        $id_loai = $value->IDLoai;
       }
     //  echo $id_loai;
      // }
      $splq=DB::table('tbl_product')
      //->join('tbl_category_product','IDloai','=','tbl_product.IDloai')
      ->where('tbl_product.IDLoai',$id_loai)->limit(4)->get();   
      return view('page.chitietsanpham')->with('chitietbalo',$chitietbalo)->with('lq',$splq);
    }
}
