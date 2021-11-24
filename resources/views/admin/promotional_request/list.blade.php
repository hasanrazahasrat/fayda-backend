@extends('admin.layout.master')
@section('title', 'Promotional request')

@section('css')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Promotional request</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Promotional requests</li>
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
                            <h3 class="card-title">Promotional request </h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Request Id</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    

                                </tr>
                                </thead>
                                @foreach($promotions as $promotion)
                                    <tbody>
                                    <tr>
                                        <td>{{$promotion->request_id}}</td>
                                        <td>{{$promotion->user_name}}</td>
                                        <td>{{$promotion->email}}</td>
                                        <td>{{$promotion->mobile}}</td>
                                  
                                    </tr>
                                    </tbody>
                                @endforeach
                                <tfoot>
                                <tr>
                                    <th>Request Id</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Mobile Number</th>
                                    
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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