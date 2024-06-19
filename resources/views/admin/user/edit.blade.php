@extends('admin.layouts.main')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Editing user</h1>
                    {{--Delete user button--}}
                    <form action="{{ route('admin.user.delete', $user->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="border-0 bg-transparent">
                            <i role="button" onclick="return confirm('Sure?')" class="fa fa-trash text-danger"></i>
                        </button>
                    </form>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route( 'main.index') }}">Main</a></li>
                        <li class="breadcrumb-item "><a href="{{route( 'admin.user.index')}}">Users v1</a></li>
                        <li class="breadcrumb-item active">{{$user->name}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.user.update', $user->id) }}" method="post" class="w-25">
                        @csrf
                        @method('patch')
                        {{--Name--}}
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" value="{{$user->name}}"
                                placeholder="Enter username">
                            @error('name')
                            <div class="text-danger">{{$message}} </div>
                            @enderror
                        </div>

                        {{--EMAIL User email--}}
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Enter email"
                                value="{{$user->email}}">
                            @error('email')
                            <div class="text-danger">{{$message}} </div>
                            @enderror
                        </div>
                        {{-- Select user role--}}
                        <div class="form-group w-25">
                            <label>Select role</label>
                            <select name="role" class="form-control">
                                @foreach($roles as $id => $role)
                                <option value="{{$id}}" {{$id == $user->role? ' selected' : ''}}>
                                    {{$role}}
                                </option>
                                @endforeach
                            </select>
                            @error('role')
                            <div class="text-danger">{{ $message }} </div>
                            @enderror
                        </div>
                        {{-- Hidden field--}}
                        <div class="form-group">
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                        </div>
                        {{--Input button--}}
                        <input type="submit" class="btn btn-primary col-4" value="Update">
                    </form>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection