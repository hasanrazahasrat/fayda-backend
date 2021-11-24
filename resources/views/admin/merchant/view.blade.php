@extends('admin.layout.master')
@section('title', 'View merchant')

@section('css')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View merchants</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">View Merchants</li>
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
                            <h3 class="card-title">View Merchants details</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>الاسم الاول</th>
                                    <th>Last Name</th>
                                    <th>الاسم الكامل</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <!--<th>Rating</th>-->
                                    <th>Company</th>
                                    <th>الشركه</th>
                                    <th style="width: 180px; overflow: hidden; display: inline-block; white-space: nowrap; padding: 24px;">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $sno = 1;  ?>
                                @foreach($merchants as $merchant)
                                    <tr>
                                        <td>{{$sno++}}</td>
                                        <td>{{$merchant->first_name}}</td>
                                        <td>{{$merchant->first_name_ar}}</td>
                                        <td>{{$merchant->last_name}}</td>
                                        <td>{{$merchant->last_name_ar}}</td>
                                        <td>{{$merchant->email}}</td>
                                        <td>{{$merchant->mobile}}</td>
                                        <!--<td>{{$merchant->rating}}</td>-->
                                        <td>{{$merchant->company}}</td>
                                        <td>{{$merchant->company_ar}}</td>
                                        <td>
                                            <form action="{{ route('admin.merchant.destroy',$merchant->id) }}"
                                                  method="POST">
                                                <a href="{{route('admin.merchant.edit', $merchant->id)}}"
                                                   class="btn btn-info">
                                                    <i class="fa fa-pencil"></i> Edit
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger"
                                                        onclick=" return confirm('Are you sure?')">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>الاسم الاول</th>
                                    <th>Last Name</th>
                                    <th>الاسم الكامل</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <!--<th>Rating</th>-->
                                    <th>Company</th>
                                    <th>الشركه</th>
                                    <th>Actions</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        {{ $merchants->links() }}
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

