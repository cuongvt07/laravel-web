@extends('layouts.admin')

@section('title')
    <title>Trang chủ</title>
@endsection



@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('partials.content-header', ['name' => 'Menu', 'key' => 'Add'])
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('menus.update', ['id' => $menuFoll->id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên Menus</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                    placeholder="Nhập tên Menus"
                                    value="{{$menuFoll->name}}">
                            </div>
                            <div class="form-group">
                                <label>Chọn Menus gốc</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Chọn menus cha</option>
                                    {!! $test!!}
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>

    @stop
