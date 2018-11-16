@extends('master')
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">Sản Phẩm {{$sanpham->name}}</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="{{route('trangchu')}}">Trang chủ</a> / <span>Thông tin chi tiết sản phẩm</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container">
        <div id="content">
            <div class="row">
                <div class="col-sm-9">

                    <div class="row">
                        <div class="col-sm-4">
                            <img src="{{URL::to('source/image/product/')}}/{{$sanpham->image}}" alt="">
                        </div>
                        <div class="col-sm-8">

                            <div class="single-item-body">

                                <p class="single-item-title">{{$sanpham->name}}</p>
                                <p class="single-item-price">
                                    @if($sanpham->promotion_price==0)
                                        <span class="flash-sale">{{number_format($sanpham->unit_price)}}đ</span>
                                    @else
                                        <span class="flash-del">{{number_format($sanpham->unit_price)}}đ</span>
                                        <span class="flash-sale">{{number_format($sanpham->promotion_price)}}đ</span>
                                    @endif
                                </p>
                            </div>

                            <div class="clearfix"></div>
                            <div class="space20">&nbsp;</div>

                            <div class="single-item-desc">
                                <p>{{$sanpham->description}}</p>
                            </div>
                            <div class="space20">&nbsp;</div>

                            <p>Số Lượng</p>
                            <div class="single-item-options">

                                <select class="wc-select" name="color">
                                    <option>Color</option>
                                    <option value="Red">Red</option>
                                    <option value="Green">Green</option>
                                    <option value="Yellow">Yellow</option>
                                    <option value="Black">Black</option>
                                    <option value="White">White</option>
                                </select>
                                <select class="wc-select" name="color">
                                    <option>Số Lượng</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i></a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                    <div class="space40">&nbsp;</div>
                    <div class="woocommerce-tabs">
                        <ul class="tabs">
                            <li><a href="#tab-description">Description</a></li>
                            <li><a href="#tab-reviews">Reviews (0)</a></li>
                        </ul>

                        <div class="panel" id="tab-description">
                            <p>{{$sanpham->description}}</p>
                        </div>
                        <div class="panel" id="tab-reviews">
                            <p>No Reviews</p>
                        </div>
                    </div>
                    <div class="space50">&nbsp;</div>
                    <div class="beta-products-list">
                        <h4>Sản phẩm tương tự</h4>
                     @foreach($sanphamtuongtu as $sp_tt)
                            <div class="col-sm-4">
                                <div class="single-item">
                                    @if($sp_tt->promotion_price !=0)
                                        <div class="ribbon-wrapper"><div class="sale ribbon"> Sale</div></div>
                                    @endif
                                    <div class="single-item-header">
                                        <a href="{{route('chitietsanpham',$sp_tt->id_type)}}"><img src="{{ URL::to('source/image/product')}}/{{ $sp_tt->image }}" alt="" height="250px"></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{$sp_tt->name}}</p>
                                        <p class="single-item-price">
                                            @if($sp_tt->promotion_price !=0)
                                                <span class="flash-del">{{$sp_tt->unit_price}}</span>
                                                <span class="flash-sale">{{$sp_tt->promotion_price}}</span>
                                            @else
                                                <span class="flash-del">{{$sp_tt->unit_price}}</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>


                        @endforeach
                    </div> <!-- .beta-products-list -->
                </div>
                <div class="col-sm-3 aside">
                    <div class="widget">
                        <h3 class="widget-title">Sản phẩm mới</h3>
                        <div class="widget-body">
                            <div class="beta-sales beta-lists">
                                @foreach($new_product1 as $new1)
                                <div class="media beta-sales-item">
                                    <a class="pull-left" href="{{route('chitietsanpham',$sp_tt->id_type)}}"><img src="{{ URL::to('source/image/product')}}/{{ $new1->image }}" alt=""></a>
                                    <div class="media-body">
                                        {{$new1->name}}
                                        <span class="beta-sales-price">{{$new1->unit_price}}</span>
                                    </div>
                                </div>


                                    @endforeach
                            </div>
                        </div>
                    </div> <!-- best sellers widget -->
                    <div class="widget">
                        <h3 class="widget-title">New Products</h3>
                        <div class="widget-body">
                            <div class="beta-sales beta-lists">
                                @foreach($sanpham_khuyenmai1 as $spkm1)
                                    <div class="media beta-sales-item">
                                        <a class="pull-left" href="{{route('chitietsanpham',$spkm1->id_type)}}"><img src="{{ URL::to('source/image/product')}}/{{ $spkm1->image }}" alt=""></a>
                                        <div class="media-body">
                                            {{$spkm1->name}}
                                            <span class="beta-sales-price">{{$spkm1->unit_price}}</span>
                                        </div>
                                    </div>


                                @endforeach
                            </div>
                        </div>
                    </div> <!-- best sellers widget -->
                </div>
            </div>
        </div> <!-- #content -->
    </div> <!-- .container -->
@endsection