@extends('merchant.layout.master')
@section('title', 'View categories')

@section('css')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">View categories</li>
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
                            <h3 class="card-title">View categories details</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Category Title</th>
                                    <th>اسم الفئه</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <?php $sno = 1; ?>
                                @foreach( $categories as $cat )
                                    <tbody>
                                    <tr>
                                        <td>{{$sno++}}</td>
                                        <td><img src="{{$cat->images}}" width="50" height="50"> </td>
                                        <td>{{$cat->title}}</td>
                                        <td>{{$cat->title_ar}}</td>
                                        <td>
                                            <form action="{{ route('merchant.category.destroy', $cat->id) }}" method="POST">
                                                <a href="{{route('merchant.category.edit', $cat->id)}}" class="btn btn-info"><i
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
                                @endforeach
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Category Title</th>
                                    <th>اسم الفئه</th>
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

