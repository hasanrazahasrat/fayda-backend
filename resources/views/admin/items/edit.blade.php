@extends('admin.layout.master')
@section('title', 'Add item')

@section('css')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add item</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Add item</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" id="quickForm" method="post" enctype="multipart/form-data"
                          action="{{ route('admin.item.update', $item->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="card card-primary">
                            <div class="card-header" style="background-color: #8cc63f;">
                                <h3 class="card-title">Add new item</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="first_name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                           value="{{ $item->name }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="first_name">اسم الصنف</label>
                                    <input type="text" name="name_ar" value="{{ $item->name_ar }}" class="form-control" id="name"
                                           placeholder="اسم الصنف">
                                </div>
                                
                                <div class="form-group">
                                    <label for="last_name">Select Category</label>
                                    <select class="form-control" name="category_id" id="category_id">
                                        <option>Mobile</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"
                                                    {{ $category->id === $item->category_id ? "selected" : null }}>
                                                {{$category->title}}&nbsp&nbsp&nbsp&nbsp&nbsp{{$category->title_ar}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @foreach($RoyalityPoint as $Point)
                                    <input type="hidden" name="r_p" id="r_p" value="{{$Point->royality_points}}">
                                     <input type="hidden" name="s_r" id="s_r" value="{{$Point->saudi_riyal}}">
                                @endforeach
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="text" name="price" id="price" class="form-control"
                                                   value="{{ $item->price }}">
                                        </div>
                                    </div>
                                    {{-- <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Points</label>
                                            <input type="text" name="points" id="points" class="form-control"
                                                   value="{{ $item->points }}">
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="form-group">
                                    <label for="first_name">Detail</label>
                                    <textarea class="form-control" name="details" id="details">{{ $item->details }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="first_name">التفاصيل</label>
                                    <textarea class="form-control" name="details_ar" id="details">{{ $item->details_ar }}</textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="image">Images</label>
                                    @foreach($item->images as $image) 
                                        <div style="width:80px">
                                            <img style="width:100%" src="{{ $image->image }}">
                                        </div>
                                    @endforeach
                                    <input type="file" name="image[]" class="form-control" id="image" 
                                           placeholder="Enter first Name" multiple>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn " style="background-color: #8cc63f;">Update</button>
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
