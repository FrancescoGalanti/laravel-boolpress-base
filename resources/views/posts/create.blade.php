@extends('layouts.main')
@section('content')
<div class="container mb-5">
      <h1>Create a new Post</h1>

      @if ($errors->any())
        <div class="alert alert-danger">
           <ul>
           @foreach($errors->all() as $error)
               <li>{{ $error }}</li>
           @endforeach
           </ul>
        </div>
      @endif

      <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
       @csrf
       @method('POST')

       <div class="form-group">
          <label for="title">Title</label>
          <input id="title" class="form-control" type="text" name="title" value="{{old('title')}}">
       </div>
       <div class="form-group">
          <label for="description"> Description</label>
          <textarea id="description" class="form-control"  name="body">{{old('body')}}</textarea>
       </div>
       <div class="form-group">
          <label for="path_img">Post Img</label>
          <input id="path_img" type="file" class="form-control"  name="path_img" accept="image/*">
       </div>
       <div class="form-group">
          <input class="btn btn-primary" type="submit" value="Create Post">
       </div>
@endsection