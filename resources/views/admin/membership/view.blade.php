@extends('admin.layout.master')
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
                                    <!--<th>Image</th>-->
                                    <th>Title</th>
                                    <th>tier</th>
                                    <th>Badge Image</th>
                                    <th>Card Image</th>
                                    <th>Badge Image_sm</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <?php $sno = 1; ?>
                                @foreach( $members as $member)
                                    <tbody>
                                        <tr>
                                            <td>{{$sno++}}</td>
                                            <td>{{$member->title}}</td>
                                            <td>
                                                
                                                 @foreach( $tiers as $tier)
                                                 @if($tier->id == $member->tier )
                                                 {{$tier->tier_name}}
                                                 @endif
                                                 @endforeach
                                                
                                            </td>
                                            <td><img src="{{$member->badge_image}}" width="50" height="50"></td>
                                            <td><img src="{{$member->card_image}}" width="50" height="50"></td>
                                            <td><img src="{{$member->badge_image_sm}}" width="50" height="50"></td>
                                            <td>
                                            <form style="float: left;" action="{{ route('admin.membership.destroy',$member->id) }}" method="POST">
                                                <a href="{{route('admin.membership.edit', $member->id)}}" class="btn btn-info"><i
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
                                    <!--<th>Image</th>-->
                                    <th>Title</th>
                                    <th>tier</th>
                                    <th>Badge Image</th>
                                    <th>Card Image</th>
                                    <th>Badge Image_sm</th>
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
        
        document.documentElement.setAttribute("lang", "en");
document.documentElement.removeAttribute("class");

axe.run( function(err, results) {
  console.log( results.violations );
} );
    </script>


@endsection

