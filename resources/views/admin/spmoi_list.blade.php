@extends('masteradmin')
@section('content')
  <div class="container-fluid">
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
                <div class="row">
                    <div class="col-lg-8">
                        <h1 class="page-header">
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Sản Phẩm</th>
                                <th>Mô Tả</th>
                                <th>giá mới</th>
                                <th>giá khuyến mãi</th>
                                <th>Hình ảnh</th>
                               
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sp_new as $sp)
                            <tr class="even gradeC" align="center">
                                <td>{{$sp->id}}</td>
                                <td>{{$sp->name}}</td>
                                <td>{{$sp->description}}</td>
                                <td>{{$sp->unit_price}}</td>
                                 <td>{{$sp->promotion_price}}</td>
                                  <td><img src="{{URL::to('source/image/product')}}/{{$sp->image}}" style="width:100px;height: 100px" /></td>
                               
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{route('admin_getdel',$sp->id)}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{route('admin_getupdatesp',$sp->id)}}">Edit</a></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
@endsection