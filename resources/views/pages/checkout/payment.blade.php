@extends('layout')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div>

			<?php
			$alert = Session::get('alert');
			if($alert) {echo $alert; Session::put('alert',null);}
			 ?>
			<div class="review-payment">
				<h2>Xem lại giỏ hàng</h2>
			</div>
			<div class="table-responsive cart_info">
				<?php
				$content = Cart::content();
				
				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên sp</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" width="90" alt="" /></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price).' '.'vnđ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/update-cart-quantity')}}" method="POST">
									{{ csrf_field() }}
									<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->qty}}"  >
									<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control">
									<input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									
									<?php
									$subtotal = $v_content->price * $v_content->qty;
									echo number_format($subtotal).' '.'vnđ';
									?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="col-lg-8 col-md-6">
				
                            <div class="checkout__order">
                               
                                <?php
				$content = Cart::content();

				?>
                                <div class="checkout__order__products">Sản phẩm <span>Tổng</span></div>
                                <ul>
                                	@foreach($content as $v_content)
                                    <li>{{$v_content->name}} <span><?php
                                    $subtotal = $v_content->price * $v_content->qty;
                                    echo number_format($subtotal).' '.'vnđ';
                                    ?></span></li>
                                 @endforeach
                                </ul>
                                  <div class="checkout__order__total">Thuế <span>{{Cart::tax().' '.'vnđ'}}</span></div>
                               
                                <div class="checkout__order__total">Tổng <span>{{Cart::total().' '.'vnđ'}}</span></div>
                                
                                
                                <form method="POST" action="{{URL::to('/order-place')}}">
				{{ csrf_field() }}
				<span><label> <input type="radio" name="payment_option" value="1"> Trả bằng thẻ ATM</label></span><br>
				<span><label><input type="radio" name="payment_option" checked value="2"> Nhận tiền mặt</label></span><br>
				<span><label><input type="radio" name="payment_option" value="3"> Thanh toán thẻ ghi nợ</label></span>
                                <button type="submit" name="send_order_place" class="site-btn">Đặt hàng</button>
                                </form>
                            </div>
                        
			</div>
			
			
		</div>
	</section> <!--/#cart_items-->

@endsection