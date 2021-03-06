<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CheckoutController extends Controller
{
     public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function view_order($orderId){
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*')->first();

        $manager_order_by_id  = view('admin.view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.view_order', $manager_order_by_id);
        
    }
    public function login_checkout(){

    	
        $cate_product = DB::table('tbl_category_product')->orderby('IDLoai','desc')->get(); 
        $brand = DB::table('tbl_brand_product')->orderby('IDnhasanxuat','desc')->get(); 
     
         $all_product = DB::table('tbl_product')
         ->where('product_status','0')
         
         ->orderby('product_id','desc')->get(); 


    	return view('pages.banner.login_form')->with('category',$cate_product)->with('brand',$brand)->with('all_product',$all_product);
    }
    
    public function add_customer(Request $request){

    	$data = array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_phone'] = $request->customer_phone;
    	$data['customer_email'] = $request->customer_email;
    	$data['customer_password'] = md5($request->customer_password);

    	$customer_id = DB::table('tbl_customers')->insertGetId($data);

    	Session::put('customer_id',$customer_id);
    	Session::put('customer_name',$request->customer_name);
    	return Redirect::to('/checkout');


    }
    public function checkout(){
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.IDLoai','=','tbl_product.IDLoai')
        ->join('tbl_brand_product','tbl_brand_product.IDnhasanxuat','=','tbl_product.IDnhasanxuat')
        ->orderby('tbl_product.product_id','desc')->get();
    	$cate_product = DB::table('tbl_category_product')->orderby('IDLoai','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('IDnhasanxuat','desc')->get(); 

        $id_user = Session::get('customer_id');
        //echo $id_user;
        $user = DB::table('tbl_customers')->where('customer_id',$id_user)->first();
        // echo "<pre>";
        // print_r($user);
        // echo "</pre>";
         $shipping_id = Session::get('shipping_id');
         
          $shipping = DB::table('tbl_shipping')->get();
          $flag = false;
         foreach ($shipping as $key => $value) {
            if($value->shipping_id == $shipping_id ){
                $flag = true;
                //echo $value->shipping_id;
            }
         }
         
            if($flag) {
                //echo "string";
             return Redirect::to('/payment');
        }else{
             //echo "not ok";
            return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('user',$user);
        }
         
        
    	
    }
    public function save_checkout_customer(Request $request){
    	$data = array();
    	$data['shipping_name'] = $request->shipping_name;
    	$data['shipping_phone'] = $request->shipping_phone;
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_notes'] = $request->shipping_notes;
    	$data['shipping_address'] = $request->shipping_address;

    	$shipping_id = DB::table('tbl_shipping')->insertGetId($data);

    	Session::put('shipping_id',$shipping_id);
    	//echo "string";
    	return Redirect::to('/payment');
    }
    public function payment(){
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.IDLoai','=','tbl_product.IDLoai')
        ->join('tbl_brand_product','tbl_brand_product.IDnhasanxuat','=','tbl_product.IDnhasanxuat')
        ->orderby('tbl_product.product_id','desc')->get();
        $cate_product = DB::table('tbl_category_product')->orderby('IDLoai','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('IDnhasanxuat','desc')->get(); 
        return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);

    }
    public function order_place(Request $request){
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);


        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
        }
       if($data['payment_method']==2){
            Cart::destroy();
            $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.IDLoai','=','tbl_product.IDLoai')
        ->join('tbl_brand_product','tbl_brand_product.IDnhasanxuat','=','tbl_product.IDnhasanxuat')
        ->orderby('tbl_product.product_id','desc')->get();
            $cate_product = DB::table('tbl_category_product')->orderby('IDLoai','desc')->get();
            $brand_product = DB::table('tbl_brand_product')->orderby('IDnhasanxuat','desc')->get(); 
            return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);

        }else {
             Session::put('alert','<script> alert(\'Tính năng đang được cập nhật, bạn vui lòng thanh toán tiền mặt.\');</script>');
          return Redirect::to('/payment');
        }
        
        //return Redirect::to('/payment');
    }
    public function logout_checkout(){
    	Session::flush();
    	return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request){
    	$email = $request->email_account;
    	$password = md5($request->password_account);
    	$result = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();
    	
    	
    	if($result){
    		Session::put('customer_id',$result->customer_id);
    		return Redirect::to('/checkout');
    	}else{
    		return Redirect::to('/login-checkout');
    	}
    	
   
    	

    }
    public function manage_order(){
        
      /*  $this->AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name')
        ->orderby('tbl_order.order_id','desc')->get();
        $manager_order  = view('admin.manage_order')->with('all_order',$all_order);
        echo "<pre>";
        print_r($all_order);
        echo "</pre>";*/
       // return view('admin_layout')->with('admin.manage_order', $manager_order);
    }
}
