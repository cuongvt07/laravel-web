@extends('layouts.admin')


@section('title')
    <title>Add Product</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('admins/product/index/list.css')}}">
@endsection

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('admins/product/index/list.js')}}"></script>
@endsection


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name' => 'Sản Phẩm', 'key' => 'List'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('product.create') }}" class="btn btn-primary float-right ">ADD</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên Sản phẩm </th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $productItem)
                                    <tr>
                                        <th scope="row">{{ $productItem->id }}</th>
                                        <td>{{ $productItem->name }}</td>
                                        <td>{{ $productItem->price }}</td>
                                        <td>
                                            <img class="image" src="{{ $productItem->feature_image_path }}" alt="">
                                        </td>
                                        <td>{{$productItem->category->name}}</td>
                                        <td>
                                            <a href="" class="btn btn-default">Edit</a>
                                            <a href="" 
                                            data-url="{{route('product.delete',['id'=>$productItem->id])}}"
                                            class="btn btn-danger delete">Xóa</a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class=" d-flex justify-item-between -mb-12">
                            {{ $products->links() }}
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
    @stop
