@extends('admin.layout.master')
@section('title', 'View users')

@section('css')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">View users</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">View users details</h3>
                            <div class="float-right">
                                <form class="form-inline" method="post" action="{{route('admin.search.user')}}">
                                 <lable class="">Search</lable>   
                                <input type="text" id="myInput" name="search" class="form control mb-2 ">
                               
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>لاسم الكامل	</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Available Points</th>
                                    <th>Category</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <?php $sno = 1; ?>
                                @foreach($users as $user)
                                    <tbody>
                                    <tr>
                                        <td>{{$user->merchant_id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->name_ar}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->mobile}}</td>
                                        <td>{{$user->loyalty_points}}</td>
                                        <td>{{$user->CategoryName}}</td>
                                        <td>
                                            <form method="POST" action="{{route('admin.user.destroy',$user->id)}}">
                                                <!--<a href="#" class="btn btn-info">-->
                                                <!--    <i class="fa fa-search"></i> Order History-->
                                                <!--</a>-->
                                                <a href="{{route('admin.user.edit', $user->id)}}" class="btn btn-info">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure?')"><i
                                                        class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>لاسم الكامل	</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Available Points</th>
                                    <th>Actions</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
<script>
$(document).ready(function(){
    
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#example1 tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
@endsection

