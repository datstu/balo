<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class ShowProduct extends Controller
{
    public function index(){
    	$product = DB::table('tbl_product')->get();
    	// $qlydssanpham = view('admin.danhsachsanpham')->with('dssanpham',$dssanpham);
    	return view('page.home')->with('product',$product);
    }

     public function chitietsanpham($id)
    {

      $chitietbalo=DB::table('tbl_product')->where('tbl_product.product_id',$id)->get();

      return view('page.chitietsanpham')->with('chitietbalo',$chitietbalo);
    }
}
