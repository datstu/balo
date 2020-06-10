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

			
			<div class="review-payment">
				<h2>Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ sớm liên hệ với bạn sớm nhất</h2>
			</div>
			<div class="table-responsive cart_info"></div>
			<div class="col-lg-8 col-md-6"></div>
			
			
		</div>
	</section> <!--/#cart_items-->

@endsection