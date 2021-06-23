@extends('layouts.appx')

@section('css')
<link href="{{ asset('css/forum/questions/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="content">
    <div class="card card-top pt-2 pl-2" style="width: 50rem;">
        <div class="card-body">
          <h3 class="card-title" style="display: inline">All Questions</h3>
          <a class="btn btn-primary" style="float: right" href="{{url('/questions/create')}}">Ask Question</a>
          <p class="card-text mt-4">{{$question->count()}} questions</p>
        </div>
    </div>
    @forelse ($question as $key => $q)
    <div class="card card-content pt-2 pl-2" style="width: 50rem;">
        <div class="card-body">
            <a class="card-title mb-4" href="{{ url('/questions', ['questions' => $q->id] ) }}">{{$q->title}}</a>
            <div class="card-text quecontent" >{{$q->content}}</div>
            <small class="card-text text-muted pt-2" style="display: block">asked {{$q->created_at->diffForHumans()}}</small>
            <a href="#">{{$q->user->name}}</a>
        </div>
    </div>
        @empty
        <p class="mt-5 ml-4">No Question</p>
    @endforelse
    <div class="mb-5"></div>

</div>

@endsection
