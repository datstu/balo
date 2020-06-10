  <!DOCTYPE html>
<html lang="zxx">

<head>
   @include('pages/head/head')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">@include('pages/head/hamberger_menu')</div>
    <header class="header">@include('pages/head/header')</header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">@include('pages/banner/hero')</section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        @include('pages/category/show_category')
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                            	<?php
				$content = Cart::content();
				
				?>
                                <tr>
                                    <th class="shoping__product">Sản phẩm</th>
                                    
                                    <th>Giá</th>
                                    <th>Số Lượng</th>
                                    <th>Tổng</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($content as $value_content)
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img style="height: 61px;" src="{{URL::to('public/uploads/product/'.$value_content->options->image)}}" alt="">
                                        <h5>{{$value_content->name}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        {{number_format($value_content->price).' '.'vnđ'}}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                            	<form action="{{URL::to('/update-cart-quantity')}}" method="POST">
									{{ csrf_field() }}
                                            <div class="pro-qty">
                                                <input name="cart_quantity" type="number" value="{{$value_content->qty}}">
                                                
                                                
                                            </div>
                                            <input  type="hidden" value="{{$value_content->rowId}}" name="rowId_cart" class="form-control">
                                            <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
                                </form>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                       <?php
									$subtotal = $value_content->price * $value_content->qty;
									echo number_format($subtotal).' '.'vnđ';
									?>
                                  
                                    </td>
                                    <td class="shoping__cart__item__close">
                                      <a class="cart_quantity_delete" onclick="return confirm('Are you want to delete?')"  href="{{URL::to('/delete-to-cart/'.$value_content->rowId)}}"> <span class="icon_close"> </span></a>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">{{-- 
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                 --}}</div>
                <div class="col-lg-6">{{-- 
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                 --}}</div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Hóa Đơn</h5>
                        <ul>
                            <li>Tổng <span>{{Cart::total().' '.'vnđ'}}</span></li>
                            <li>Thuế <span>{{Cart::tax().' '.'vnđ'}}</span></li>
                            <li>Phí vận chuyển <span>Free</span></li>
                            <li>Thành tiền <span>{{Cart::total().' '.'vnđ'}}</span></li>
                        </ul>
                        <?php
                                   $customer_id = Session::get('customer_id');
                                   if($customer_id!=NULL){ 
                        ?>
                        <a href="{{URL::to('/checkout')}}" class="primary-btn">Thanh Toán</a>
                        <?php
                            }else{
                        ?>
                        <a class="btn primary-btn" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
                                 <?php 
                             }
                                 ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{asset('public/user/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('public/user/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/user/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('public/user/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('public/user/js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('public/user/js/mixitup.min.js')}}"></script>
    <script src="{{asset('public/user/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('public/user/js/main.js')}}"></script>


</body>

</html>
