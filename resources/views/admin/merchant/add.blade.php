@extends('admin.layout.master')
@section('title', 'Add merchant')

@section('css')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add merchant</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Add merchant</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" id="quickForm" method="POST" action="{{ route('admin.merchant.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-header" style="background-color: #8cc63f;">
                                <h3 class="card-title">Add new merchant</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name"
                                           placeholder="Enter first Name">
                                </div>
                                <div class="form-group">
                                    <label for="first_name">الاسم الاول</label>
                                    <input type="text" name="first_name_ar" class="form-control" id="first_name_ar"
                                           placeholder="الاسم الاول">
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" id="last_name"
                                           placeholder="Enter last name">
                                </div>

                                <div class="form-group">
                                    <label for="last_name">الاسم الكامل</label>
                                    <input type="text" name="last_name_ar" class="form-control" id="last_name_ar"
                                           placeholder="أدخل الاسم الكامل">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                           placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="number">Password</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                           placeholder="Enter Password">
                                </div>
                                <div class="form-group">
                                    <label for="number">Mobile</label>
                                    <input type="text" name="mobile" class="form-control" id="number"
                                           placeholder="Enter full number">
                                </div>
                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <input type="text" name="company" class="form-control" id="company"
                                           placeholder="Enter company">
                                </div>

                                <div class="form-group">
                                    <label for="company">الشركه</label>
                                    <input type="text" name="company_ar" class="form-control" id="company_ar"
                                           placeholder="أدخل الشركه">
                                </div>

                                <!--<div class="form-group">-->
                                <!--    <label for="company">Rating</label>-->
                                    <input type="hidden" name="rating"  class="form-control" id="rating"
                                           placeholder="Enter rating">
                                <!--</div>-->
                                <div class="form-group">
                                    <label for="image">Logo</label>
                                    <input type="file" name="logo" class="form-control mt-2" id="image">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn " style="background-color: #8cc63f;">Save</button>
                            </div>
                        </div>
                    </form>
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
        });
    </script>


@endsection
