@extends('masteradmin')
@section('content')
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>Add</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors)>0)
                          <div class="alert alert-danger">
                            @foreach( $errors->all() as $err)
                            {{$err}}<br>
                            @endforeach()
                          </div>
                        @endif
                        @if(session('thanhcong'))
                        <div class="alert alert-success">{{session('thanhcong')}}</div>
                        @endif
                        <form action="{{route('admin_postaddsp')}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}" >
                            <div class="form-group">
                                <label>Loại sản phẩm</label>
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
                                <label>giá chính(đồng)</label>
                                <input class="form-control" name="unit_price" placeholder="Please Enter Category Name" 
                                type="number" />
                            </div>
                            <div class="form-group">
                                <label>giá khuyến mãi(đồng)</label>
                                <input class="form-control" name="promotion_price" placeholder="Please Enter Category Order"
                                type="number" />
                            </div>
                            <div class="form-group">
                                <label>Tên ảnh</label>
                                <input class="form-control" name="image" placeholder="Please Enter Category Keywords" />
                            </div>
                            <div class="form-group">
                                <label>Mô tả sản phẩm</label>
                                <textarea class="form-control" name="description" rows="3"></textarea>
                            </div>
                           
                            <button type="submit" class="btn btn-default">Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
@endsection