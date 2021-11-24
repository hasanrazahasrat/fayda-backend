@extends('marketing.layout.master')


@section('title', 'item popup promotion')

@section('css')
@endsection


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Popup promotion</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href=".admin/dasboard">Home</a></li>
                    <li class="breadcrumb-item active">Popup promotion</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">

        <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header" style="background-color: #8cc63f;">
                <h3 class="card-title">Popup promotion</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="quickForm" method="post" enctype="multipart/form-data" action="/marketing/popup_promotion/{{ $ppro->id }}">
                @csrf
                @method('PATCH')
                <div class="card-body">
                  <div class="form-group">
                       <label for="first_name">Item Name</label>
                       <input type="text" name="item" class="form-control" value="{{ $ppro->item }}">
                     </div>
                     <div class="form-group">
                         <label for="first_name">Item Image</label>
                         <div style ="width:80px">
                          <img style="width:100%"src="{{$ppro->image}}">
                          </div>
                       <input type="file" name="image" class="form-control">
                     </div>
                     <div class="form-group">
                        <label for="promotion_date">Promotion Date</label> 
                        <input type="date" name="promotion_date" class="form-control" id="promotion_date" placeholder="Promotion Date" value="{{ $ppro->promotion_date }}">
                     </div>
                      <div class="form-group">
                        <label for="first_name">Detail</label>
                        <textarea class="form-control" name="ip_detail">{{ $ppro->ip_detail }}</textarea>
                      </div>                       
                  </div>
                   
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn " style="background-color: #8cc63f;">Save</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection


@section('js')
    
    <script type="text/javascript">
$(document).ready(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Working!" );
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
});
</script>    


@endsection