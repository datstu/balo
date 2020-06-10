@extends('layout')
@section('content')


        <div class="container">
            <div class="row">
               
            </div>
            <div class="checkout__form">
                <h4>Thông tin người nhận</h4>
              
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
        	<form action="{{URL::to('/save-checkout-customer')}}" method="POST">
									{{csrf_field()}}
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="shipping_email" value="{{$user->customer_email}}" >
                                    </div>
                                </div>
                                <div class="col-lg-6"></div>
                            </div>

                            <div class="checkout__input">
                                <p>Họ và tên<span>*</span></p>
                                <input type="text" name="shipping_name" value="{{$user->customer_name}}" >
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text"  name='shipping_address' placeholder="Street Address" class="checkout__input__add">
                               
                            </div>
                            <div class="checkout__input">
                                <p>Số Điện Thoại<span>*</span></p>
                                <input type="text" name="shipping_phone">
                            </div>
                           
                           
                            
                            <div class="checkout__input__checkbox">
                                
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text" name="shipping_notes" 
                                    placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                           
                            <button style="font-family: sans-serif;" type="submit" class="site-btn">Cập nhật thông tin người nhận</button>

        </form>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    
@endsection