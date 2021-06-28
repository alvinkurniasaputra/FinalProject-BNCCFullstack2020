@extends('layouts.appx')

@section('css')
<link href="{{ asset('css/forum/users/show.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container pt-4">
    <div class="myHeader">
        <a class="btn btn-primary" href="{{ url("/users/$user->id") }}">Profile</a>
        @if ($user->id == $id)
            <a class="btn" href="{{ url("/users/$user->id/edit") }}">Edit profile</a>
        @endif
    </div>
    <div class="myProfile row mt-5 ml-2 pl-5">
        <div class="col-8">
            <img class="photo-profile" src="/uploads/images/{{ $user->photo }}">
            <h4>{{$user->name}}</h4>
            @isset($user->title)
                <p class="text-muted" style="font-size: 17px">{{$user->title}}</p>
            @endisset
            @isset($user->about_me)
                <p class="pt-1">{{$user->about_me}}</p>
            @endisset
            @empty($user->about_me)
                @if ($user->id == $id)
                    <p class="text-muted pt-1 mb-2">(Your <i>about me</i> is currently blank.)</p>
                    <a href="{{url("/users/$user->id/edit")}}"><u>Click here to edit</u></a>
                @else
                    <p class="text-muted pt-1 mb-2">Apparently, this user prefers to keep an air of mystery about them.</p>
                @endif
            @endempty
        </div>
        <div class="col-4">
            <div style="width:70px; display:inline-block;">
                <b class="mb-0">{{$user->answer->count()}}</b>
                <p class="mb-2">answer</p>
            </div>
            <div style="width:70px; display:inline-block;">
                <b class="mb-0">{{$user->question->count()}}</b>
                <p class="mb-2">question</p>
            </div>
            @isset($user->location)
                <p class="m-0 mt-2"><i class="fa fa-map-marker text-muted" aria-hidden="true"></i> {{$user->location}}</p>
            @endisset
            <p class="m-0 mt-1"><i class="fa fa-history text-muted" aria-hidden="true"></i> Member for {{$user->created_at->diffForHumans(null, true)}}</p>
            <p class="m-0 mt-1"><i class="fa fa-clock-o text-muted" aria-hidden="true"></i> Last seen {{\Carbon\Carbon::parse($user->last_seen)->diffForHumans()}}</p>
        </div>
    </div>

    <div class="myActivity row mt-5 ml-4 pl-5">
        <div class="col-6">
            <b>Question </b><label class="text-muted">({{$user->question->count()}})</label>
            <hr class="mt-1">
            @forelse ($user->question as $item)
                <a class="quecontent mb-1" href="/questions/{{$item->id}}">{{$item->content}}</a>
            @empty
                @if ($user->id == $id)
                    <small>You have not asked any questions</small>
                @else
                    <small>This user has not asked any questions</small>
                @endif
            @endforelse
        </div>
        <div class="col-6">
            <b>Answer </b><label class="text-muted">({{$user->answer->count()}})</label>
            <hr class="mt-1">
            @forelse ($user->answer as $item)
                <a class="anscontent mb-1" href="/questions/{{$item->question_id}}">{{$item->question->content}}</a>
            @empty
                @if ($user->id == $id)
                    <small>You have not answered any questions</small>
                @else
                    <small>This user has not answered any questions</small>
                @endif
            @endforelse
        </div>
    </div>

</div>


@endsection

