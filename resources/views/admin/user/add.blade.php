@extends('admin.layout.master')
@section('title', 'Add user')

@section('css')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add user</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Add user</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('admin.user.store') }}" role="form" id="quickForm">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add new user</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" name="name" class="form-control" id="first_name"
                                           placeholder="Enter Full name">
                                </div>
                                <div class="form-group">
                                    <label for="name">الاسم الكامل</label>
                                    <input type="text" name="name_ar" class="form-control" id="name_ar"
                                           placeholder="أدخل الاسم الكامل">
                                </div>
                                <!--<div class="form-group">-->
                                <!--    <label for="last_name">Last Name</label>-->
                                <!--    <input type="text" name="last_name" class="form-control" id="last_name"-->
                                <!--           placeholder="Enter last name">-->
                                <!--</div>-->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                           placeholder="Enter email">
                                </div>
                                <!--<div class="form-group">-->
                                <!--    <label for="password">Password</label>-->
                                    <input type="hidden" name="password" class="form-control" id="password"
                                           placeholder="Enter Password">
                                <!--</div>-->
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" name="mobile" class="form-control" id="mobile"
                                           placeholder="Enter full number">
                                </div>
                                <div class="form-group">
                                    <label for="business_name">Business Name</label>
                                    <input type="text" name="business_name" class="form-control" id="business_name"
                                           placeholder="Enter Business Name">
                                </div>
                                
                                <div class="form-group">
                                    <label for="business_address">اسم العمل</label>
                                    <input type="text" name="business_name_ar" class="form-control" id="business_name_ar"
                                           placeholder="أدخل اسم العمل">
                                </div>
                                
                                <div class="form-group">
                                    <label for="business_address">Business Address</label>
                                    <input type="text" name="business_address" class="form-control" id="business_address"
                                           placeholder="Enter Full name">
                                </div>
                                
                                <div class="form-group">
                                    <label for="business_address">عنوان العمل</label>
                                    <input type="text" name="business_address_ar" class="form-control" id="business_address_ar"
                                           placeholder="أدخل عنوان العمل">
                                </div>
                                
                                
                                
                                <div class="form-group">
                                    <label for="loyalty_points">Loyalty Points</label>
                                    <input type="number" name="loyalty_points" class="form-control"
                                           id="loyalty_points"
                                           placeholder="Enter available points">
                                </div>
                                
                                <!--<div class="form-group">-->
                                <!--    <label for="code">code</label>-->
                                <!--    <input type="number" name="code" class="form-control" id="code"-->
                                <!--           placeholder="Enter Code">-->
                                <!--</div>-->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

