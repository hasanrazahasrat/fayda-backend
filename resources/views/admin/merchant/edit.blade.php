@extends('admin.layout.master')
@section('title', 'Edit merchant')

@section('css')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit merchant</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit merchant</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" id="quickForm" method="POST"
                          action="{{ route('admin.merchant.update', $merchant->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="card card-primary">
                            <div class="card-header" style="background-color: #8cc63f;">
                                <h3 class="card-title">Edit merchant details</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name"
                                           value="{{ $merchant->first_name }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="first_name">الاسم الاول</label>
                                    <input type="text" name="first_name_ar" value="{{ $merchant->first_name_ar }}" class="form-control" id="first_name_ar"
                                           placeholder="الاسم الاول">
                                </div>
                                
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" id="last_name"
                                           value="{{ $merchant->last_name }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="last_name">الاسم الكامل</label>
                                    <input type="text" name="last_name_ar" value="{{ $merchant->last_name_ar }}" class="form-control" id="last_name_ar"
                                           placeholder="أدخل الاسم الكامل">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                           value="{{ $merchant->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="number">Password</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                           placeholder="Enter Password">
                                </div>
                                <div class="form-group">
                                    <label for="number">Mobile</label>
                                    <input type="text" name="mobile" class="form-control" id="number"
                                           value="{{ $merchant->mobile }}">
                                </div>
                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <input type="text" name="company" class="form-control" id="company"
                                           value="{{ $merchant->company }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="company">الشركه</label>
                                    <input type="text" name="company_ar" value="{{ $merchant->company_ar }}" class="form-control" id="company_ar"
                                           placeholder="أدخل الشركه">
                                </div>
                                
                                <!--<div class="form-group">-->
                                <!--    <label for="company">Rating</label>-->
                                    <input type="hidden" name="rating" class="form-control" id="rating"
                                           value="{{ $merchant->rating }}">
                                <!--</div>-->
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
