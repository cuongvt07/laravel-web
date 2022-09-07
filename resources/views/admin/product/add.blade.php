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
        @include('partials.content-header', ['name' => 'Sản Phẩm ', 'key' => 'Add'])
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
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input type="text" value="{{old('name')}}" name="name" class="form-control" id="exampleInputEmail1"
                                    placeholder="Nhập tên sản phẩm ">

                                @error('name')
                                    <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá</label>
                                <input type="text" name="price"  value="{{old('price')}}" class="form-control" id="exampleInputEmail1"
                                    placeholder="Nhập giá sản phẩm  ">
                                    @error('price')
                                    <span style="color: red">{{$message}}</span>
                                @enderror
                                </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh sản phẩm</label>
                                <input type="file" value="{{old('price')}}" name="feature_image_path" class="form-control-file"
                                    id="exampleInputEmail1">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ảnh chi tiết</label>
                                <input type="file" value="{{old('image_path')}}" multiple name="image_path[]" class="form-control-file"
                                    id="exampleInputEmail1">
                                    @error('image_path')
                                    <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nhập tags cho sản phẩm</label>
                                <select name="tags[]" value="{{old('tags')}}" class="form-control tags_select_choose" multiple="multiple">
                                </select>
                                @error('form-control')
                                    <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class=" js-example-placeholder-single js-states form-control" name="category_id"
                                    multiple="multiple" value="{{old('category_id')}}">
                                    <option value="0">Chọn danh mục </option>
                                    {!! $tag !!}
                                </select>
                                @error('category_id')
                                    <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Nội dung</label>
                                <textarea name="contents" 
                                value="{{old('contents')}}"
                                class="form-control tinymce_init" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            @error('contents')
                            <span style="color: red">{{$message}}</span>
                        @enderror
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    @stop
