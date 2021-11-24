@extends('marketing.layout.master')
@section('title', 'item promotion')

@section('css')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Item promotion</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href=".admin/dasboard">Home</a></li>
                        <li class="breadcrumb-item active">Item promotion</li>
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
                            <h3 class="card-title">Item promotion</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="quickForm" method="post" enctype="multipart/form-data"
                              action="{{route('marketing.item_promotion.store')}}">
                            @csrf

                            <div class="card-body">

                                <!--<div class="form-group">-->
                                <!--    <label for="last_name">Select Merchant</label>-->
                                <!--    <select class="form-control" name="merchant_name" id="merchant_name">-->
                                <!--        <option>Jhon</option>-->
                                <!--        <option>Dev</option>-->
                                <!--    </select>-->

                                <!--</div>-->
                                <!--<div class="form-group">-->
                                <!--    <label for="last_name">Select Item</label>-->
                                <!--    <select class="form-control" name="item" id="item">-->
                                <!--        <option>Mobile</option>-->
                                <!--        <option>Laptop</option>-->
                                <!--    </select>-->

                                <!--</div>-->
                                <!--<div class="form-group">-->
                                <!--    <label for="last_name">Select Users</label>-->
                                <!--    <select class="form-control" name="user_name" id="user_name">-->
                                <!--        <option>Jhon</option>-->
                                <!--        <option>Dev</option>-->
                                <!--    </select>-->
                                <!--</div>-->
                                <div class="form-group">
                                    <label for="promotions_category_id">Promotional Category</label>
                                    <select name="promotions_category_id" id="promotions_category_id" class="form-control">
                                        <option value="none">-- Select Category --</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="last_name"> Enter Item</label>
                                    <input type="text" class="form-control" name="item" id="item" />
                                </div>
                                
                                <div class="form-group">
                                    <label for="first_name">Detail</label>
                                    <textarea class="form-control" name="ip_detail"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image[]">Image</label>
                                    <input type="file" name="image" class="form-control" id="image" multiple>
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
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>


@endsection
