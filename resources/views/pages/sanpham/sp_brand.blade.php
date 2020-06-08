@extends('layout')
@section('content')
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">

                        @foreach($brand as $br)

                        @if($br->slug_brand_product == $slug_brand)
                        <h2>Sản phẩm theo hãng {{$br->TenNhasanxuat}}</h2>
                        @endif
                        @endforeach
                    </div>
                  
                </div>
            </div>
            <div class="row featured__filter">

             
                @foreach($list_product_brand as $pd)
               
                <div class="col-lg-3 col-md-4 col-sm-6 mix ">
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
                
                @endforeach
            </div>
        </div>
    @endsection