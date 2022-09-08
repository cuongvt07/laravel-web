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
        @include('partials.content-header', ['name' => 'user', 'key' => 'list'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="" class="btn btn-primary float-right ">ADD</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên </th>                                   
                                    <th scope="col">email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{$user->id}}</th>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email  }}</td>                                       

                                        <td>
                                            <a href=""
                                                 class="btn btn-default">Edit</a>
                                            <a href=""

                                            data-url=""
                                                class="btn btn-danger delete">Xóa</a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class=" d-flex justify-item-between -mb-12">
                            {{ $users->links() }}
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
    @stop   
