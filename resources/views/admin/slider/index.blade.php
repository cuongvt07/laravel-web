@extends('layouts.admin')


@section('title')
    <title>Trang chủ</title>
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
        @include('partials.content-header', ['name' => 'Slider', 'key' => 'Add'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('slider.create')}}" class="btn btn-primary float-right ">ADD</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên Slider</th>                                   
                                    <th scope="col">Description</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                    <tr>
                                        <th scope="row">{{$slider->id}}</th>
                                        <td>{{$slider->name}}</td>
                                        <td>{{$slider->description  }}</td>                                       
                                        <td>
                                            <img class="image" src="{{$slider->image_path}}" alt="">
                                            </td>
                                        <td>
                                            <a href="{{route('slider.edit', ['id'=>$slider->id])}}"
                                                 class="btn btn-default">Edit</a>
                                            <a href=""

                                            data-url="{{route('slider.delete', ['id'=>$slider->id])}}"
                                                class="btn btn-danger delete">Xóa</a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class=" d-flex justify-item-between -mb-12">
                            {{ $sliders->links() }}
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
    @stop   
