@extends('admin.layout.master')
@section('title', 'dashboard')

@section('css')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $orders->count()}}</h3>
                            <p>New Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $orders->count()}}</h3>
                            <p>Pending Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Accepted Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Compeleted Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">View Orders</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>id</th>
                                
                                    <th>User Name</th>
                                    <th>Delivery Address</th>
                                    <!-- <th>Total Points</th> -->

                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <?php $s = 1; ?>
                                @foreach($orders as $order)
                                @foreach($order_datas as $order_data)
                                @if($order->merchant_id == $order_data->merchant_id && $order->order_number == $order_data->order_number)
                                    <tbody>
                                    <tr>
                                        <td>
                                            {{$s}}
                                            
                                        </td>    
                                        <td>
                                            {{$order_data['user']['name']}}

                                        </td>
                                        <td>{{$order_data->delivery_address}}</td>
                                        <td>{{$order_data->date}}</td>
                                        <td>
                                        <a href="#" class="btn btn-warning">Pending</a>
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
                                                            <th>Total Points</th>
                                                            <th>Merchant</th>
                                                        </tr>
                                                        </thead>
                                @foreach($order_datas as $order_view)
                                @if($order_view->merchant_id == $order_data->merchant_id && $order_data->order_number == $order_view->order_number)
                                    <tbody>
                                        <tr>
                                            <td>{{$order_view->name}}</td>
                                            <td>
                                                @foreach($imagelists as $imagelist)
                                                    @if($imagelist->item_id == $order_view->item_id)
                                                    <img src="{{$imagelist->image}}" width="100" height="100">
                                                    @endif
                                                @endforeach
                                                
                                            </td>
                                            <td>{{$order_view->total_points}}</td>
                                            <td>
                                                
                                                @foreach($merchants as $merchant)
                                                @if($order_view->item && $order_view->item->user_id == $merchant->id && $order_view->item->user_type == 'merchant')
                                                {{$merchant->first_name}}
                                                @endif
                                                @endforeach

                                                @foreach($admins as $admin)
                                                @if($order_view->item && $order_view->item->user_id == $admin->id && $order_view->item->user_type == 'admin')
                                                {{$admin->name}}
                                                @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endif
                                    @endforeach
                                </table>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            
                                        </td>
                                        
                                    </tr>
                                    </tbody>
                                    <?php $s++;?>
                                    @break
                                    @endif
                                    @endforeach
                                @endforeach
                                <tfoot>
                                <tr>
                                    <th>id</th>
                                   
                                    <th>User Name</th>
                                    <th>Delivery Address</th>
                                    <!-- <th>Total Points</th> -->
                                    <th>Date</th>
                                    <th>Action</th>
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
@endsection