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
                                    <th>Item</th>
                                    <th>صنف</th>
                                    <th>Catogory Name</th>
                                    <th>Price</th>
                                    <th>Points</th>
                                    <th>User</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <?php $sno = 1; ?>
                                @foreach( $items as $item)
                                    <tbody>
                                    <tr>
                                        <td>{{$sno++}}</td>
                                        <!--<td>-->
                                        <!--    <div style="width:80px">-->
                                        <!--        <img style="width:100%" src="{{storage_path()}}/images/{{$item->image}}">-->
                                        <!--    </div>-->
                                        <!--</td>-->
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->name_ar}}</td>
                                        <td>{{$item->category->title}}</td>
                                        <td>{{$item->price}}</td>
                                        <td>{{$item->points}}</td>
                                        <td>
                                             @foreach($admins as $admin)
                                             @if($item->user_id == $admin->id && $item->user_type == 'admin')
                                             {{$admin->name}}
                                             @endif
                                             @endforeach

                                             @foreach($merchants as $merchant)
                                             @if($item->user_id == $merchant->id && $item->user_type == 'merchant')
                                             {{$admin->name}}
                                             @endif
                                             @endforeach
                                        </td>
                                        <td>
                                            <form style="float: left;" action="{{ route('admin.item.destroy',$item->id) }}" method="POST">
                                                <a href="{{route('admin.item.edit', $item->id)}}" class="btn btn-info"><i
                                                        class="fa fa-pencil"></i> Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger"
                                                        onclick="return confirm('Are you sure?')"><i
                                                        class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg{{$item->id}}">View Images</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                    
                                    <div class="modal fade bd-example-modal-lg{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="row text-center text-lg-left">
                                            <br>
                                                @foreach( $images as $picture)
                                                    @if($item->id == $picture->item_id )
                                                    <!--<img class="d-block w-100" src="{{$picture->image}}"  width="150" height="180">-->
                                                  <!--  <figure class="col-md-4">-->
                                                  <!--  <a href="" data-size="1600x1067">-->
                                                  <!--    <img alt="picture" src="{{$picture->image}}" class="img-fluid">-->
                                                  <!--  </a>-->
                                                  <!--</figure>-->
                                                    <div class="col-lg-3 col-md-4 col-6">
                                                      <a href="#" class="d-block mb-4 h-150">
                                                            <img class="img-fluid img-thumbnail" src="{{$picture->image}}" alt="" width="300">
                                                          </a>
                                                    </div>
                                            
                                                    @endif
                                                @endforeach
                                                
                                                 
                                         
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                    
                                @endforeach
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <!--<th>Image</th>-->
                                    <th>Item</th>
                                    <th>صنف</th>
                                    <th>Catogory Name</th>
                                    <th>Price</th>
                                    <th>Points</th>
                                    <th>User</th>
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

