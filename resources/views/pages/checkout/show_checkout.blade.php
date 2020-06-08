@extends('layout')
@section('content')


        <div class="container">
            <div class="row">
               
            </div>
            <div class="checkout__form">
                <h4>Thông tin người nhận</h4>
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
        	<form action="{{URL::to('/save-checkout-customer')}}" method="POST">
									{{csrf_field()}}
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="shipping_email" >
                                    </div>
                                </div>
                                <div class="col-lg-6"></div>
                            </div>

                            <div class="checkout__input">
                                <p>Họ và tên<span>*</span></p>
                                <input type="text" name="shipping_name" >
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add">
                               
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
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Hóa Đơn</h4>
                                <?php
				$content = Cart::content();
				
				?>
                                <div class="checkout__order__products">Sản phẩm <span>Tổng</span></div>
                                <ul>
                                	@foreach($content as $v_content)
                                    <li>{{$v_content->name}} <span>{{number_format($v_content->price).' '.'vnđ'}}</span></li>
                                 @endforeach
                                </ul>
                               
                                <div class="checkout__order__total">Tổng <span><?php
									$subtotal = $v_content->price * $v_content->qty;
									echo number_format($subtotal).' '.'vnđ';
									?></span></div>
                                
                                
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Check Payment
                                        <input type="checkbox" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    
@endsection