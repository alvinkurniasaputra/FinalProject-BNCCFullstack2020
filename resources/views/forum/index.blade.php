@extends('layouts.appx')

@section('css')
<link href="{{ asset('css/forum/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="content">
    <div class="card card-top pt-2 pl-2" style="width: 50rem;">
        <div class="card-body">
          <h3 class="card-title" style="display: inline">My Questions</h3>
          <a class="btn btn-primary" style="float: right" href="{{url('/questions/create')}}">Ask Question</a>
          <p class="card-text mt-4">{{$sum}} questions</p>
        </div>
    </div>
    @forelse ($question as $key => $q)
    <div class="card card-content pt-2 pl-2" style="width: 50rem;">
        <div class="card-body">
            <a class="card-title mb-4" href="{{ url('/questions', ['questions' => $q->id] ) }}">{{$q->title}}</a>
            <p class="card-text">{{$q->content}}</p>
            <small class="card-text text-muted" style="display: block">asked {{$q->created_at->diffForHumans()}}</small>
            <a href="#">{{$q->user->name}}</a>
        </div>
    </div>
    {{-- <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus commodi praesentium iure reiciendis adipisci iste necessitatibus dolor cumque omnis velit! Minus dolore sit magnam, praesentium dolores aliquam, nulla doloremque numquam velit cupiditate, non quia veritatis consectetur? Suscipit aliquid ut magni tempora enim quis similique hic, velit voluptatem consequuntur aut. Nisi odio eveniet aperiam totam modi, numquam maxime! Quidem perferendis in ex magni labore a est nihil quasi repellendus harum unde, corporis maxime! Architecto adipisci maxime, modi accusantium consequuntur accusamus et rem distinctio ex, doloremque tempora eius ipsa. Perferendis quos nostrum incidunt, quia laudantium aliquid corrupti fugit quasi. Commodi, totam sint?</h1> --}}
        @empty
        <p class="mt-5 ml-4">No Question</p>
    @endforelse

</div>

@endsection
