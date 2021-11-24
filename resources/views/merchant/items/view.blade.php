@extends('merchant.layout.master')
@section('title', 'View items')

@section('css')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View items</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">View items</li>
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
                            <h3 class="card-title">View items details</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Item</th>
                                     <th>صنف</th>
                                    <th>Catogory Name</th>
                                    <th>Price</th>
                                    <th>Points</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                @foreach( $items as $item)
                                @if ($item->user_type == 'merchant' && $item->user_id == Session::get('login_merchant_59ba36addc2b2f9401580f014c7f58ea4e30989d') )
                                    <tbody>
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>
                                            <div style="width:80px">
                                                <img style="width:100%" src="/storage/images/{{$item->image}}">
                                            </div>
                                        </td>
                                        <td>{{$item->name}}</td>
                                         <td>{{$item->name_ar}}</td>
                                        <td>{{$item->category->title}}</td>
                                        <td>{{$item->price}}</td>
                                        <td>{{$item->points}}</td>
                                        <td>
                                            <form action="{{ route('merchant.item.destroy',$item->id) }}" method="POST">
                                                <a href="{{route('merchant.item.edit', $item->id)}}" class="btn btn-info"><i
                                                        class="fa fa-pencil"></i> Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger"
                                                        onclick="return confirm('Are you sure?')"><i
                                                        class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    </tbody>
                                    @endif
                                @endforeach
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Item</th>
                                     <th>صنف</th>
                                    <th>Catogory Name</th>
                                    <th>Price</th>
                                    <th>Points</th>
                                    <th>Actions</th>
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

