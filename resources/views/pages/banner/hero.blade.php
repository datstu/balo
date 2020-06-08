
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Danh Mục </span>
                        </div>
                        <ul>
                            @foreach($category as $key => $cate)
                            <li><a href="{{URL::to('/san-pham-theo-'.$cate->slug_category_product)}}">{{$cate->TenLoai}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="{{URL::to('/search')}}" method="POST">
                                {{csrf_field()}}
                                <div class="search_box pull-right">
                                    
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" name="keywords_submit" placeholder="Bạn cần tìm gì?">
                                <button type="submit" class="site-btn">Tìm kiếm</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <a href="tel:0973409613"><i class="fa fa-phone"></i></a>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>0973409613</h5>
                                <span>Hỗ trợ 24/7</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="{{asset('public/user/img/hero/banner.jpg')}}">
                        <div class="hero__text">
                            <span>BALO NHÓM 6</span>
                            <h2>Vải canvas <br />100% cotton</h2>
                           
                             <p>Balo đựng laptop chất lượng và thời trang</p>
                            <a href="#" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                    @yield('form');
                </div>
            </div>
        </div>
    