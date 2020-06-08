
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> stu.edu.vn</li>
                                <li>Miễn Phí Vận Chuyển cho Đơn hàng lớn hơn 1.000.000đ</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a target="blank" href="https://www.facebook.com/groups/1880222058732870/"><i class="fa fa-facebook"></i></a>
                                <a href="#" onclick="alert('Chúng tôi đang cập nhật. Cảm ơn bạn đã quan tâm.')"><i class="fa fa-twitter"></i></a>
                                <a href="#" onclick="alert('Chúng tôi đang cập nhật. Cảm ơn bạn đã quan tâm.')"><i class="fa fa-linkedin"></i></a>
                               {{--  <a href="#"><i class="fa fa-pinterest-p"></i></a> --}}
                            </div>
                            <div class="header__top__right__language">
                                <img src="img/language.png" alt="">
                                <div>Tiếng Việt</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">Vietnamese</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__auth">
                                <?php
                                   $customer_id = Session::get('customer_id');
                                   if($customer_id!=NULL){ 
                                   
                                 ?>
                                  <a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-unlock"></i> Đăng xuất</a>
                                
                                <?php
                            }else{
                               
                                 ?>
                                 <a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhsập</a>
                                 <?php 
                                 }
                                 ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{URL::to('/')}}"><img src="{{asset('public/user/img/logo.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="{{URL::to('/')}}">Trang Chủ</a></li>
                            <li><a href="{{URL::to('/danh-sach-san-pham')}}">Sản phẩm</a></li>
                            {{-- <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li> --}}
                           {{--  <li><a href="{{URL::to('/tintuc')}}">Tin tức</a></li> --}}
                            <li><a href="{{URL::to('/nhom6')}}">Nhóm 6</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                            <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                        </ul>
                        <div class="header__cart__price">item: <span>$150.00</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    