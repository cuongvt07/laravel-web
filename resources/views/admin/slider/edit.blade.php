@extends('layouts.admin')

@section('title')
    <title>Thêm sản phẩm</title>
@endsection

@section('css')
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admins/product/add/add.css') }}" rel="stylesheet" />
@endsection

@section('js')
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/cvabcc6j4qq936jfkdmwpwadxvdfg7026nqik1gi6fs1q41e/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="{{ asset('admins/product/add/add.js') }}"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Slider ', 'key' => 'Patch'])
        {{-- <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div> --}}
        <form action="{{route('slider.update',['id'=>$sliders->id])}}" method="POST" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            @csrf
                            <div class="form-group">
                                <label>Tên Slider</label>
                                <input class="form-control" 
                                name="name" 
                                value="{{$sliders->name}}"
                                placeholder="Nhập slider">
                                {{-- {!! $test!!} --}}
                                @error('name')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <input class="form-control"
                                value="{{$sliders->description}}"
                                 name="description">
                                {{-- {!! $test!!} --}}
                                @error('description')
                                <span style="color: red">{{$message}}</span>
                            @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh chính</label>
                                <input type="file"                                 name="image_path"
                                    class="form-control-file" 
                                    id="exampleInputEmail1">
                                    <div class="image">
                                        <img src="{{ $sliders->image_path }}" alt="">
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh phụ</label>
                                <input type="file" value="{{ old('price') }}" name="feature_image_path"
                                    class="form-control-file" id="exampleInputEmail1">

                            </div>


                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    @stop
