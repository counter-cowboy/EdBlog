@extends('admin.layouts.main')
@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Adding POST</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('main.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form action="{{route('admin.post.store')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            {{--  Title--}}
                            <div class="form-group w-25">
                                <input type="text" name="title" class="form-control"
                                       value="{{old('title')}}" placeholder="Enter post name">
                                @error('title')
                                <div class="text-danger"> {{ $message }}  </div>
                                @enderror
                            </div>
                            {{--Content--}}
                            <div class="form-group">
                                <textarea id="summernote" name="content">
                                    {{ old('content') }}
                                </textarea>
                                @error('content')
                                <div class="text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            {{--Preview image--}}
                            <div class="form-group w-50">
                                <label>Add preview</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="preview_image"
                                               id="exampleInputFile">

                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                                @error('preview_image')
                                <div class="text-danger">{{ $message }} </div>
                                @enderror
                            </div>
                            {{--Main image--}}
                            <div class="form-group w-50">
                                <label>Add image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="main_image"
                                               id="exampleInputFile">

                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                                @error('main_image')
                                <div class="text-danger">{{ $message }}                  </div>
                                @enderror
                            </div>
                            {{-- Select category ID--}}
                            <div class="form-group w-25">
                                <label>Select category</label>
                                <select name="category_id" class="form-control">
                                    <option selected value="">--=select=--</option>
                                    @foreach($category as $cat)
                                        <option value="{{$cat->id}}"
                                                {{$cat->id == old('category_id')? ' selected' : ''}}>
                                            {{$cat->title}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="text-danger">{{ $message }}  </div>
                                @enderror
                            </div>
                            {{-- Select tag multiple--}}
                            <div class="form-group  w-25">
                                <label>Select tags</label>
                                <select class="select2 form-control" multiple="multiple" name="tag_ids[]"
                                        data-placeholder="Select a tag" style="width: 100%;">

                                    @foreach($tags as $tag)
                                        <option {{is_array(old('tag_ids'))&&in_array($tag->id,old('tag_ids'))?' selected':''}} value="{{$tag->id}}">
                                            {{$tag->title}}</option>
                                    @endforeach
                                </select>
                                @error('tag_ids')
                                <div class="text-danger">{{ $message }}    </div>
                                @enderror
                            </div>

                            {{--  Submit button--}}
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary col-1" value="Add">
                            </div>
                        </form>
                        {{--End form--}}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
