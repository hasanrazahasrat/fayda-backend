@extends('admin.layout.master')
@section('title', 'Add marketing')

@section('css')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit marketing</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit marketing</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form role="form" id="quickForm" method="post"
                          action="{{ route('admin.marketing.update', $marketing->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="card card-primary">
                            <div class="card-header" style="background-color: #8cc63f;">
                                <h3 class="card-title">Edit marketing details</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name"
                                           value="{{ $marketing->first_name }}">
                                </div>
                                
                                 <div class="form-group">
                                    <label for="first_name">الاسم الاول</label>
                                    <input type="text" name="first_name_ar"  value="{{ $marketing->first_name_ar }}" class="form-control" id="first_name_ar"
                                           placeholder="الاسم الاول">
                                </div>
                                
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" id="last_name"
                                           value="{{ $marketing->last_name }}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="last_name">الاسم الكامل</label>
                                    <input type="text" name="last_name_ar"value="{{ $marketing->last_name_ar }}" class="form-control" id="last_name_ar"
                                           placeholder="أدخل الاسم الكامل">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                           value="{{ $marketing->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="number">Password</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                           placeholder="Enter Password">
                                </div>
                                <div class="form-group">
                                    <label for="number">Mobile</label>
                                    <input type="text" name="mobile" class="form-control" id="mobile"
                                           value="{{ $marketing->mobile }}">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn " style="background-color: #8cc63f;">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

