@extends('layouts.backend')
@section('title') Category
@endsection
@section('page-title') Tambah Category
@endsection
@section('content')
<div class="panel panel-headline">
    <div class="row">
    <!-- left column -->
        <div class="col-md-8">
            <!-- general form elements -->
            <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action={{Route('category.store')}} enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Kategori</label>
                    <input autocomplete="off" value="{{old('category_name')}}" type="text" class="form-control {{$errors->first('category_name') ? "is-invalid" : ""}} " name="category_name" placeholder="Nama category">
                    <div class="invalid-feedback">
                    {{$errors->first('category_name')}}
                    </div>
                </div>
                </div>

                <!-- /.box-body -->
                <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="submit" class="btn btn-primary">Kembali</button>

                </div>
            </form>
            </div>
        </div>
    </div>
</div>
    <!-- /.box -->

    
@endsection