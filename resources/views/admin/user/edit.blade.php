@extends('admin.layout.master')
@section('title', 'Edit user')

@section('css')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit user</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href=".admin/dasboard">Home</a></li>
                        <li class="breadcrumb-item active">Edit user</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('admin.user.update', $user) }}" role="form" id="quickForm">
                        @csrf
                        @method('PATCH')
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit new user</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="first_name">Full Name</label>
                                    <input type="text" name="name" class="form-control" id="first_name"
                                           value="{{ $user->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="name">الاسم الكامل</label>
                                    <input type="text" name="name_ar" class="form-control" id="name_ar"
                                           placeholder="أدخل الاسم الكامل">
                                </div>
                                
                                <!--<div class="form-group">-->
                                <!--    <label for="last_name">Last Name</label>-->
                                <!--    <input type="text" name="last_name" class="form-control" id="last_name"-->
                                <!--           value="{{ $user->last_name }}">-->
                                <!--</div>-->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                           value="{{ $user->email }}">
                                </div>
                                <!--<div class="form-group">-->
                                <!--    <label for="number">Password</label>-->
                                    <input type="hidden" name="password" class="form-control" id="password">
                                <!--</div>-->
                                <div class="form-group">
                                    <label for="number">Mobile</label>
                                    <input type="text" name="mobile" class="form-control" id="mobile"
                                           value="{{ $user->mobile }}">
                                </div>
                                <div class="form-group">
                                    <label for="business_name">Business Name</label>
                                    <input type="text" name="business_name" class="form-control" id="business_name"
                                           placeholder="Enter Business Name" value="{{ $user->business_name }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="business_address">اسم العمل</label>
                                    <input type="text" name="business_name_ar" class="form-control" value="{{ $user->business_name_ar }}" id="business_name_ar"
                                           placeholder="أدخل اسم العمل">
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="business_address">Business Address</label>
                                    <input type="text" name="business_address" class="form-control" id="business_address"
                                           placeholder="Enter Full name" value="{{ $user->business_address }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="business_address">عنوان العمل</label>
                                    <input type="text" name="business_address_ar" class="form-control" value="{{ $user->business_address_ar }}" id="business_address_ar"
                                           placeholder="أدخل عنوان العمل">
                                </div>
                                
                                <div class="form-group">
                                    <label for="loyalty_points">Loyalty Points</label>
                                    <input type="text" name="loyalty_points" class="form-control"
                                           id="loyalty_points"
                                           placeholder="Enter available points" value="{{ $user->loyalty_points }}">
                                </div>
                                
                                <!--<div class="form-group">-->
                                <!--    <label for="code">code</label>-->
                                <!--    <input type="text" name="code" class="form-control" id="code"-->
                                <!--           placeholder="Enter Code" value="{{ $user->code }}">-->
                                <!--</div>-->
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
