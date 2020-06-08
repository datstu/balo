@extends('layout')
@section('content')
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Tìm Sản Phẩm theo từ khóa{{$keywords}}</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            
                            <li class="active" data-filter="*">All</li>
                            <?php $flag = false; ?>
                            @foreach($category as $cate)
                             @foreach($search_product as $pd)
                            
                            <?php if($pd->IDLoai == $cate->IDLoai ){
                             if(!$flag){ ?>
                            
                            <li data-filter=".{{$cate->slug_category_product}}">{{$cate->TenLoai}}</li>
                            <?php $flag = true;}else $flag =false; }?>
                          
                            @endforeach
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter"> 
                @foreach($search_product as $pd)
                @if($pd->trangthai != 1 && $pd->trangthai != 2)
                <div class="col-lg-3 col-md-4 col-sm-6 mix 
                <?php 
                    foreach($category as $val)
                    if($pd->IDLoai == $val->IDLoai)
                    echo($val->slug_category_product);
                ?> ">
                    <div class="featured__item">
                      <div class="featured__item__pic set-bg" data-setbg="{{asset('public/uploads/product/'.$pd->product_image)}}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="{{URL::to('/chi-tiet-san-pham/'.$pd->product_slug)}}"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        
                        
                        <div class="featured__item__text">
                            <h6><a href="{{URL::to('/chi-tiet-san-pham/'.$pd->product_slug)}}">{{$pd->product_name}}</a></h6>
                            <h5>{{number_format($pd->product_price).' '.'VNĐ'}}</h5>
                        </div>
                    </div>
                </div>
                 @endif
                @endforeach
            </div>
        </div>
    @endsection