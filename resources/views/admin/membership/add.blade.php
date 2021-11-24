@extends('admin.layout.master')
@section('title', 'Add item')

@section('css')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add MemberShip</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Add MemberShip</li>
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
                            <h3 class="card-title">Add MemberShip</h3>
                        </div>
                        <form role="form" id="quickForm" method="post" enctype="multipart/form-data"
                              action="{{ route('admin.membership.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="first_name">Title</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                           placeholder="Enter title">
                                </div>

                                <div class="form-group">
                                    <label for="last_name">Select Tier</label>
                                    <select class="form-control" name="tier" id="tier">
                                        <option>Select Category</option>
                                        @foreach($tiers as $tier)
                                            <option value="{{$tier->id}}">{{$tier->tier_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="badge_image" class="form-control" id="badge_image"
                                           placeholder="Enter first Name">
                                </div>
                                
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="card_image" class="form-control" id="card_image"
                                           placeholder="Enter first Name" >
                                </div>
                                
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="badge_image_sm" class="form-control" id="badge_image_sm"
                                           placeholder="Enter first Name" >
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn " style="background-color: #8cc63f;">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('js')

    <script type="text/javascript">
        $(document).ready(function () {
            $.validator.setDefaults({
                submitHandler: function () {
                    alert("Working!");
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
        
        
        $(document).ready(function(){
          $("#price").focusout(function(){
            var rp = $("#r_p").val();
            var sr = $("#s_r").val();
            
            var price = $("#price").val();
            var point = price/sr; 
             $("#points").val(point);
          });
          
          $("#points").focusout(function(){
            var rp = $("#r_p").val();
            var sr = $("#s_r").val();
            
            var point = $("#points").val();
            var price = point*sr; 
             $("#price").val(price);
          });
         
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>


@endsection
