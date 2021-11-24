@extends('admin.layout.master')
@section('title', 'Daily statments')

@section('css')
@endsection
<style type="text/css">
    .input-group {
    
    width: 448% !important;
}
</style>
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daily statments</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Statments</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header" style="background-color: #8cc63f;">
                            <h3 class="card-title">Statement - <?php echo Date("d F Y");?></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 col-6">
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3>{{ $orders->count()}}</h3>
                                            <p>New Orders</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                        <!--<a href="#" class="small-box-footer">More info <i-->
                                        <!--        class="fas fa-arrow-circle-right"></i></a>-->
                                    </div>
                                </div>
                                
                                <div class="col-lg-4 col-6">
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h3>{{ $orders->count()}}</h3>
                                            <p>Pending Orders</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                        <!--<a href="#" class="small-box-footer">More info <i-->
                                        <!--        class="fas fa-arrow-circle-right"></i></a>-->
                                    </div>
                                </div>
                                <div class="col-lg-4 col-6">
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3>0<sup style="font-size: 20px">%</sup></h3>
                                            <p>Overall Compeleted orders</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                        <!--<a href="#" class="small-box-footer">More info <i-->
                                        <!--        class="fas fa-arrow-circle-right"></i></a>-->
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <form class="form-inline" method="post" accept="{{route('admin.statement.store')}}">
                                            @csrf
                                                <div class="form-group">
                                                <label>Starting Date:</label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="date" name="starting_date"
                                                           class="form-control float-right" id="reservation">
                                                </div>
                                            
                                         </div>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                         <div class="form-group">
                                              
                                                <label>Ending Date:</label>

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="date" name="ending_date"
                                                           class="form-control float-right" id="reservation">
                                                </div>
                                            </div>
                                        
                                        </div>
                                        <div class="col-md-8"></div>
                                    </div>
                                </div>                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn " style="background-color: #8cc63f;">Send</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                    <br/>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Statments History</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Total Orders</th>
                                    <th>Pending Orders</th>
                                    <th>Accepted Orders</th>
                                    
                                    <th>Date</th>
                                    <!--<th>Earning</th>-->
                                    <!--<th>Joined at</th>-->

                                </tr>
                         
                                </thead>
                                @if(isset($orders_state))

                                <?php $a = 0; $p = 0; ?>

                                @foreach($orders_state as $order)
                               
                              <tr>
                                <td>
                                    @foreach($users as $user)
                                    @if($order->merchant_id == $user->id)
                                    {{$user->name}}
                                    @endif
                                    @endforeach                                    
                                </td>
                                <td>
                                    <?php $total = 0; ?>
                                    @foreach($orders_totals as $orders_total)
                                    @if($order->merchant_id == $orders_total->merchant_id)
                                    <?php $total++; ?>
                                    @endif
                                    @endforeach 
                                    {{$total}}
                                </td>
                                <td>
                                    
                                    <?php $pend = 0; ?>
                                    @foreach($orders_totals as $orders_total)
                                    @if($order->merchant_id == $orders_total->merchant_id)
                                        @foreach($all_orders as $all_order)
                                            @if($all_order->merchant_id == $orders_total->merchant_id)
                                                @if($all_order->status == 0)
                                                    <?php $pend++; ?>
                                                @endif
                                            @break
                                            @endif
                                        @endforeach 
                                    
                                    @endif
                                    @endforeach 
                                    {{$pend}}
                                </td>
                                <td>
                                     <?php $pend = 0; ?>
                                    @foreach($orders_totals as $orders_total)
                                    @if($order->merchant_id == $orders_total->merchant_id)
                                        @foreach($all_orders as $all_order)
                                            @if($all_order->merchant_id == $orders_total->merchant_id)
                                                @if($all_order->status == 1)
                                                    <?php $pend++; ?>
                                                @endif
                                            @break
                                            @endif
                                        @endforeach 
                                    
                                    @endif
                                    @endforeach 
                                    {{$pend}}
                                </td>
                                
                                <td>
                                    @foreach($users as $user)
                                    @if($order->merchant_id == $user->id)
                                    {{$user->created_at}}
                                    @endif
                                    @endforeach
                                </td>
                              </tr>
                              @endforeach
                              @endif

                                <tfoot>
                                <tr>
                                    <th>User Name</th>
                                    <th>Total Orders</th>
                                    <th>Pending Orders</th>
                                    <th>Accepted Orders</th>
                                    
                                    <th>Date</th>
                                    <!--<th>Earning</th>-->
                                    <!--<th>Joined at</th>-->
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
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
            //Money Euro
            $('[data-mask]').inputmask()

            //Date range picker
            $('#reservationdate').datetimepicker({
                format: 'L'
            });
            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            })
            //Date range as a button
            $('#daterange-btn').daterangepicker(
                {
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function (start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                }
            )

            //Timepicker
            $('#timepicker').datetimepicker({
                format: 'LT'
            })

            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            $('.my-colorpicker2').on('colorpickerChange', function (event) {
                $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            });

            $("input[data-bootstrap-switch]").each(function () {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });

        })
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $.validator.setDefaults({
                submitHandler: function () {
                    alert("Form successful submitted!");
                }
            });
            $('#quickForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    terms: {
                        required: true
                    },
                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    terms: "Please accept our terms"
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {


            bsCustomFileInput.init();

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