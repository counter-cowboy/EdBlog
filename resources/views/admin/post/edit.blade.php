@extends('admin.layouts.main')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-12">
                        <h1 class="m-0">Edit post</h1>
                        <form action="{{ route('admin.post.delete', $post->id) }}"
                              method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="border-0 bg-transparent">
                                <i role="button" onclick="return confirm('Sure?')"
                                   class="fa fa-trash text-danger"></i>
                            </button>
                        </form>
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
                        <form action="{{ route('admin.post.update', $post->id) }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            {{--  Title--}}
                            <div class="form-group w-25">
                                <input type="text" name="title" class="form-control"
                                       value="{{old('title', $post->title)}}" placeholder="Enter post name">
                                @error('title')
                                <div class="text-danger">{{$message}}   </div>
                                @enderror
                            </div>
                            {{--Content--}}
                            <div class="form-group">
                                <textarea id="summernote" name="content">
                                    {{old('content', $post->content)}}
                                </textarea>
                                @error('content')
                                <div class="text-danger">{{$message}}  </div>
                                @enderror
                            </div>
                            {{--Preview image--}}
                            <div class="form-group w-50">
                                <label>Add preview</label>
                                <div class="w-50 mb-3">
                                    <img src="{{asset('storage/'. $post->preview_image) }}" class="w-50"
                                         alt="preview_image">
                                </div>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="preview_image"
                                               id="exampleInputFile">
                                        @error('preview_image')
                                        <div class="text-danger">{{$message}}  </div>
                                        @enderror
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                            {{--Main image--}}
                            <div class="form-group w-50">
                                <label>Add image</label>
                                <div class="w-50 mb-3">
                                    <img src="{{ url('storage/'.$post->main_image)}}" class="w-50" alt="main_image">
                                </div>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="main_image"
                                               id="exampleInputFile">
                                        @error('main_image')
                                        <div class="text-danger">{{$message}}  </div>
                                        @enderror
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                            {{-- Select category--}}
                            <div class="form-group w-25">
                                <label>Select category</label>
                                <select name="category_id" class="form-control">
                                    @foreach($category as $cat)
                                        <option value="{{$cat->id}}"
                                                {{$cat->id == $post->category_id ? ' selected' : ''}}>
                                            {{$cat->title}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="text-danger">{{$message}}  </div>
                                @enderror
                            </div>
                            {{-- Select tag multiple--}}
                            <div class="form-group  w-25">
                                <label>Select tags</label>
                                <select class="select2 form-control" multiple="multiple" name="tag_ids[]"
                                        data-placeholder="Select a tag" style="width: 100%;">
                                    @foreach($tags as $tag)
                                        <option {{is_array($post->tags->pluck('id')->toArray())&&in_array($tag->id,$post->tags->pluck('id')->toArray())?' selected':''}} value="{{$tag->id}}">
                                            {{$tag->title}}</option>
                                    @endforeach
                                </select>
                                @error('tag_ids')
                                <div class="text-danger">{{$message}}  </div>
                                @enderror
                            </div>
                            {{--  Submit button--}}
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary col-1" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
