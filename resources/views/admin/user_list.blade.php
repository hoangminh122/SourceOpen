@extends('masteradmin')
@section('content')


        
        
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>User</th>
                        
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $users)
                            <tr class="odd gradeX" align="center">
                               
                                <td>{{$users->full_name}}</td>
                                
                                
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{route('admin_getdelUser',$users->id)}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#">Edit</a></td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        
        <!-- /#page-wrapper -->


@endsection