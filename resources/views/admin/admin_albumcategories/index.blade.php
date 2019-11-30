@extends('layouts.admin.content')

@section('content')
<div class="col-lg-12">
    <h1>ALBUM CATEGORY</h1>
    <div class="table-responsive">
    @if(session('flash_message'))
        <div class="alert alert-success">
            {{session('flash_message')}}
        </div>
    @endif
        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Id</th>
                    <th>Category Name</th>
                    <th>Created at</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($albumcategories as $albumcategory)
                <tr>
                    <td>{{ $albumcategory->id}}</td>
                    <td>{{ $albumcategory->category_name}}</td>
<<<<<<< HEAD
                    <td>{{ $albumcategory->created_at->format('F d, Y ') }}</td>
=======
                    <td>
                        <span>{{ $albumcategory->created_at->format('F d, Y') }}</span>
                                
                    </td>  
>>>>>>> 83dd0a2ceaeb29f78da0357cc6490cde1052a827
                    <td>
                    <a href="{{ route('admin_albumcategories.edit', $albumcategory->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>                   
                    </td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin_albumcategories.destroy', $albumcategory->id] ]) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ route('admin_albumcategories.create') }}" class="btn btn-success">Add Album Category</a>

</div>

@endsection