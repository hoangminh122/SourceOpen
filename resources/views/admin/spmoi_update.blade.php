@extends('masteradmin')
@section('content')
 <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Product
                            <small>{{$sp_update->name}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                       
                        <form action="{{route('admin_postupdatesp',$sp_update->id)}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}" >

                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input class="form-control" name="name" placeholder="{{$sp_update->name}}" />
                            </div>
                            <div class="form-group">
                                <label>{{$tentl}}</label>
                               <select class="form-control" name="select">
                                    <option value="1">Bánh mặn</option>
                                    <option value="2">Bánh ngọt</option>
                                    <option value="3">Bánh trái cây</option>
                                    <option value="4">Bánh kem</option>
                                    <option value="5">Bánh crepe</option>
                                    <option value="6">Bánh pizza</option>
                                    <option value="7">Bánh su kem</option>
                                 </select>
                            </div>
                            <div class="form-group">
                                <label>giá chính</label>
                                <input class="form-control" name="unit_price" placeholder="{{$sp_update->unit_price}}">
                            </div>
                            <div class="form-group">
                                <label>giá khuyến mãi</label>
                                <input class="form-control"  name="promotion_price"
                                placeholder="{{$sp_update->promotion_price}}">
                            </div>
                            <div class="form-group">
                                <label>Mô tả sản phẩm</label>
                               <!-- <input type="file" name="description" placeholder="{{$sp_update->description}}>
                               -->
                                <input class="form-control" name="description" placeholder="{{$sp_update->description}}">
                            </div>

                            <div class="form-group">
                                <label>Tên hình ảnh</label>
                             
                               <input class="form-control" name="unit"placeholder="{{$sp_update->image}}">
                            </div>
                            <div class="form-group">
                                <label>Loại sản phẩm</label>
                                 <input class="form-control" name="unit"placeholder="{{$sp_update->unit}}">
                            </div>
                            
                            <button type="submit" class="btn btn-default">Update</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
@endsection