@extends('marketing.layout.master')

@section('title', 'Item Wise promotion')

@section('css')
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Promotions Order</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Promotion Order</li>
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
                <h3 class="card-title">Promotion Order Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Order No</th>
                    <th>Customer</th>
                    <th>Actions</th>

                  </tr>
                  </thead>
                  <?php $sno = 1; ?>
                    @foreach($orders as $order)
                    @foreach($order_datas as $order_data)

                    @if($order->user_id == $order_data->user_id && $order->order_id == $order_data->order_id)

                  <tbody>
                    <tr>
                      <td>{{$sno++}}</td>
                      <td>{{$order->order_id}}</td>

                      <td>{{$order_data->user->name}}</td>
                       <td>
                         <!--  <a href="#" class="btn btn-warning">Pending</a> -->
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg{{$order_data->id}}">View Item</button>

                          <div class="modal fade bd-example-modal-lg{{$order_data->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">

                                    <div class="modal-header">
                                      <h4 class="modal-title" id="myLargeModalLabel">View Item</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <table id="example1" class="table table-bordered table-striped">
                                          <thead>
                                          <tr>
                                              <th>Name</th>
                                              <th>Image</th>
                                              <th>Quantity</th>
                                          </tr>
                                          </thead>

                            <tbody>


                    @foreach($order_datas as $order_data)
                    @if($order->user_id == $order_data->user_id && $order->order_id == $order_data->order_id)
                    <tr>
                    <td>{{$order_data->promotionalorder ? $order_data->promotionalorder->title : ''}}</td>
                    <td>
                        @if($order_data->promotionalorder)
                         <img src="{{$order_data->promotionalorder->image}}" width="80" height="80">
                        @else
                         -
                        @endif
                    </td>
                    <td>{{$order_data->quantity}}</td>
                     </tr>
                    @endif
                    @endforeach

                            </tbody>

                        </table>
                                    </div>
                                  </div>
                                </div>
                              </div>

                          </td>
                    </tr>

                  </tbody>
                  @endif
                  @endforeach
                  @endforeach
                  <tfoot>
                  <tr>
                     <th>#</th>
                    <th>Order No</th>
                    <th>Customer</th>
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

