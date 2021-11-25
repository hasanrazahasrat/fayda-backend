@extends('merchant.layout.master')
@section('title', 'Add category')

@section('css')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('merchant.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Add category</li>
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
                            <h3 class="card-title">Add new category</h3>
                        </div>
                        <form role="form" id="quickForm" method="post"
                              action="{{ route('merchant.category.update', $category->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="first_name">Category Title</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                           value="{{$category->title}}">
                                </div>

                                <div class="form-group">
                                    <label for="first_name">اسم الفئه</label>
                                    <input type="text" name="title_ar" value="{{$category->title_ar}}" class="form-control" id="title_ar"
                                           placeholder="عرض الفئات">
                                </div>

                                <div class="form-group">
                                    <label for="points">Points</label>
                                    <input type="text" name="points" class="form-control" id="points"
                                           value="{{$category->points}}">
                                </div>

                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" class="form-control" id="image"
                                           placeholder="Enter first Name">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn " style="background-color: #8cc63f;">Update</button>
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
                    alert("working");
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
