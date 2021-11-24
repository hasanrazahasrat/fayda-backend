@extends('marketing.layout.master')


@section('title', 'View item promotion')

@section('css')
@endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>View items</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">View item promotion</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">

                  <div class="card">
              <div class="card-header">
                <h3 class="card-title">View item promotion deatails</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Item</th>
                    <th>Merchant Name</th>
                    <th>User Name</th>
                    <th>Actions</th>

                  </tr>
                  </thead>
                  @foreach($itemPromotions as $ipro)
                  <tbody>
                    <tr>
                    <td>{{$ipro->id}}</td>
                    <td>
                    <div style ="width:80px">
                   <img style="width:100%"src="/storage/itemimages/{{$ipro->image}}">
                    </div>
                    </td>
                    <td>{{$ipro->item}}</td>
                    <td>{{$ipro->merchant_name}}</td>
                    <td>{{$ipro->user_name}}</td>

                    <td>
                    <form action="{{ route('itempros.destroy',$ipro->id) }}" method="POST">
                      <a href="/itempros/{{$ipro->id}}/edit" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</button>

                    </td>
                  </tr>

                  </tbody>
                  @endforeach
                  <tfoot>
                  <tr>
                     <th>#</th>
                    <th>Image</th>
                    <th>Item Name</th>
                    <th>Merchant Name</th>
                    <th>User Name</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection


@section('js')
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>


@endsection

