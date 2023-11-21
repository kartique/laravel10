@extends('admin.layout.layout')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Product</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Product Single</li>
            </ol>
        </div>
    </div>
    </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <section class="col-lg-12">
                <div class="card">
                    <div class="p-3 pb-0 d-flex justify-content-between">
                        <div class="float-start">
                            Product Information
                        </div>
                        <div class="float-end">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">&larr; Back</a>
                        </div>
                    </div>
                    <div class="card-body pt-0">

                            <div class="row">
                                <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    {{ $product->name }}
                                </div>
                            </div>

                            <div class="row">
                                <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Description:</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    {{ $product->description }}
                                </div>
                            </div>

                    </div>
                </div>
            </section>
        </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
