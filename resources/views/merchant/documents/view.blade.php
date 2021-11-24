@extends('merchant.layout.master')
@section('title', 'View documents')

@section('css')
@endsection


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View documents</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">View documents</li>
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
                            <h3 class="card-title">View documents details</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Document Title</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                @foreach( $documents as $document )
                                    <tbody>
                                    <tr>
                                        <td>{{$document->id}}</td>
                                        <td>{{$document->title}}</td>
                                        <td>
                                            <div style ="width:80px">
                                           <img style="width:100%"src="{{asset('storage/'.$document->image)}}">
                                            </div>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.document.destroy',$document->id) }}"
                                                  method="POST">
                                                <a href="/merchant/document/{{$document->id}}/edit"
                                                   class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
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
                                    <th>Document Title</th>
                                    <th>Image</th>
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

