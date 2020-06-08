
                  
                        <h4>Hàng Mới Nhất</h4>
                        <div class="latest-product__slider owl-carousel">

                    <div class="latest-prdouct__slider__item">
                        <?php $n = 1; ?>
                        @foreach($all_product as $val)
                            
                            @if($val->trangthai == 0 )
                                <a href="{{URL::to('/chi-tiet-san-pham/'.$val->product_slug)}}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img style="width: 110px" src="{{asset('public/uploads/product/'.$val->product_image)}}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <?php 
                                   if($n > 6) break;
                                   else if($n % 3 == 0){ ?>
                                        </div> <div class="latest-prdouct__slider__item">
                                        <?php 
                                    }
                                 $n++; ?>
                            @endif
                                
                        @endforeach
                            </div>
                        </div>

                            