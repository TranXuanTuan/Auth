@extends('layouts.admin.content')

@section('title', '| Edit Event ')

@section('content')
<form action="{{route('admin_events.update', $event->id)}}" method="post" >
<input type="hidden" name="_method" value="PUT">
        @csrf
        @include('admin.blocks.errors')
        <h1>Edit Event </h1>
        @if(session('flash_message'))
        <div class="alert alert-success">
            {{session('flash_message')}}
        </div>
    @endif
        <hr>
        <div class="form-group">
            <div class="row">
            <div class="col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="{{$event->title}}">
                        </div>

                        <div class="form-group">
                            <label>Place</label>
                            <input type="text" name="event_place" class="form-control" value="{{ $event->event_place }}">
                        </div>

                        <div class="form-group">
                            <label>Date</label>
                            <input type="Date" name="event_date" class="form-control" value="{{ $event->event_date }}"></input>
                        </div>

                        <div class="form-group">
                            <label for="customFile">Image</label>
                            @if(!empty($event->image) && Storage::disk('local')->exists($event->image))
                                <img src="{{ Storage::disk('local')->url($event->image) }}" alt="{{ $event->image }}" class="img-fluid">
                            @endif
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="image">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Creator</label>
                            <select class="form-control chosen" name="user_id">
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach  
                            </select>
                        </div>
                        
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Content</label>
                            <textarea type="text" name="content" class="form-control ckeditor">{{ $event->content }}</textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="form-group text-center">
                <a href="{{ route('admin_events.index') }}" class="btn btn-secondary">Event List</a>
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="submit" class="btn btn-success">Update</button>            
            </div>
        </div>
    </form>
@endsection