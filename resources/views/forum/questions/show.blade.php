@extends('layouts.appx')

@section('css')
<link href="{{ asset('css/forum/questions/show.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="content">
    <div class="myHeader pt-3 pl-4 pr-4">
            <div class="row">
                <div class="quetitle col-10 pr-2">
                    <p style="font-size:27px;">{{$question->title}} @if ($question->close_thread == 1)[closed]@endif</p>
                </div>
                <div class="col pl-0">
                    <a class="btn btn-primary btn-md" href="{{url('/questions/create')}}">Ask Question</a>
                </div>
            </div>
            <small class=" mt-3" style="display: block"><span class="text-muted">Asked</span> {{$question->created_at->diffForHumans()}}</small>
        <hr>
    </div>

    <section class="pl-4">
            <div class="col-8">
                <p class="quecontent">{{$question->content}}</p>
                @if ($question->user_id == $id)
                        <a href="{{ url("/questions/$question->id/edit") }}" class="text-muted">Edit</a>&emsp;
                        <form method="POST" id="quedelete" action="{{ url("/questions/$question->id")}}" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <a href="#" class="text-muted" onclick="queDelete()">Delete</a>
                        </form>&emsp;
                    @if ($question->close_thread != 1)
                        <form method="POST" id="closethread" action="{{url("/questions/$question->id")}}" style="display:inline">
                            @csrf
                            <a href="#" class="text-muted" onclick="closeThread()">Close Thread</a>
                        </form>
                    @endif
                @endif
                <div style="overflow: auto" class="mb-5">
                    <div class="user-info p-2" style="background-color: #E1ECF4; width:200px; float:right;" >
                        <small class="card-text text-muted" style="display: block">asked {{$question->created_at->format('F j \'y')}} at {{$question->created_at->format('H:i')}}</small>
                        <a href="#">{{$question->user->name}}</a>
                    </div>
                </div>
                <div>
                    @if ($answer->count() != 0)
                        <p style="font-size: 18px; font-weight: bold">{{$answer->count()}} Answer</p>
                    @endif
                    @forelse ($answer as $key => $p)
                        <p class="anscontent">{{$p->content}}</p>
                        @if ($question->close_thread != 1)
                            @if ($p->user_id == $id)
                                <a href="{{ url("/answers/$question->id/$p->id/edit") }}" class="text-muted">Edit</a>&emsp;
                                <form method="POST" id="ansdelete{{$p->id}}" action="{{ url("/answers/$p->id") }}" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#" id="ans{{$key}}" class="ansdelete{{$p->id}} text-muted" onclick="ansDelete(id)">Delete</a>
                                </form>
                            @endif
                        @endif
                        <div class="mb-2" style="overflow: auto">
                            <div class="user-info p-2" style="width:200px; float:right;" >
                                <small class="card-text text-muted" style="display: block">asked {{$p->created_at->format('F j \'y')}} at {{$p->created_at->format('H:i')}}</small>
                                <a href="#">{{$p->user->name}}</a>
                            </div>
                        </div>

                        @foreach ($p->answerComment as $k => $item)
                        <div class="comment ml-5">
                            @if ($k == 0)
                                <hr class="mt-1 my-1">
                            @endif
                            <div class="pl-4">
                                <form role="form" method="POST" id="replyedit{{$item->id}}" class="{{$item->content}}" action="{{url("/comments/$item->id")}}" style="display:inline;">
                                    <p class="comcontent mb-0" style="display:inline;">{{$item->content}} - <a href="#">{{$item->user->name}}</a>
                                        <small class="card-text text-muted">asked {{$item->created_at->format('F j \'y')}} at {{$item->created_at->format('H:i')}}</small>&emsp;
                                        @if($item->user_id == $id)
                                            <a href="#" id="edit{{$k}}{{$key}}"  class="replyedit{{$item->id}} delete{{$k}}{{$key}}"  onclick="replyEdit(id)">Edit</a>&emsp;
                                        @endif
                                    </p>
                                </form>
                                @if($item->user_id == $id)
                                    <form method="POST" id="replydelete{{$item->id}}" action="{{url("/comments/$item->id")}}"  style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <a style="color:red;" href="#" id="delete{{$k}}{{$key}}" class="replydelete{{$item->id}}" onclick="replyDelete(id)">Delete</a>
                                    </form>
                            </div>
                            @endif
                            <hr class="my-1">
                        </div>
                        @endforeach
                        <form method="POST" id="replyanswer{{$p->id}}" action="{{url("/comments/$p->id")}}">
                            <a href="#" id="reply{{$key}}" class="replyanswer{{$p->id}} mt-2 ml-5 text-muted" style="display:inline-block"onclick="replyShow(id)">Add a comment</a>
                        </form>
                        <hr>

                        @empty
                        <p>Know someone who can answer? Share a link to this question via email, Twitter, or Facebook.</p>
                    @endforelse
                </div>

                @if ($question->close_thread != 1)
                    <div class="myAnswer mb-5">
                        <p style="font-size: 20px">Your Answer</p>
                        <form role="form" method="POST" action="{{url("/answers/$question->id")}}">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control @error('ans_content') is-invalid @enderror" id="ans_content" name="ans_content" autocomplete="off" rows="10" cols="30" required @empty($id)disabled @endempty></textarea>
                                @error('ans_content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Post Your Answer</button>
                            @empty($id)
                                <p class="mt-4" style="font-size: 20px">Please Sign Up or <a href="{{ route('login') }}">Login</a> to answer the question</p>
                            @endempty
                        </form>
                    </div>
                @else
                    <div class="mb-5"></div>
                @endif
            </div>
    </section>
</div>
<script>
    function closeThread(){
    event.preventDefault();
    document.getElementById('closethread').submit();
}

    function replyDelete(d){
    event.preventDefault();
    let res = document.getElementById(d).className;
    console.log(res)
    document.getElementById(res).submit();
}

    function replyEdit(c){
    event.preventDefault();
    let res = document.getElementById(c).className.split(" ")[0];
    let del = document.getElementById(c).className.split(" ")[1];
    document.getElementById(del).remove();
    let content = document.getElementById(res).className;
    document.getElementById(res).innerHTML=`
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-10">
            <textarea id="content_edit" class="form-control @error('content_edit') is-invalid @enderror" name="content_edit" minlength="15" rows="4" required>${content}</textarea>
            @error('content_edit')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col pl-0">
            <button type="submit" class="mt-2 btn btn-primary">Save Edits</button>
        </div>
    </div>
    `;
}

    function replyShow(b){
    event.preventDefault();
        var text = document.getElementById(b).className.split(" ")[0];
        document.getElementById(text).innerHTML=`
        @csrf
        <hr class="my-2">
        <div class="row">
            <div style="width:38rem; display:inline-block" class="px-3">
                <textarea id="content_reply" class="form-control @error('content_reply') is-invalid @enderror" name="content_reply" minlength="15" rows="3" placeholder="Use comments to reply to other users. If you are adding new information, edit your post instead of commenting." required></textarea>
                @error('content_reply')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <button type="submit" class="mt-2 btn btn-primary">Add comment</button>
            </div>
        </div>
        <small class="text-muted">Enter at least 15 characters</small>
        `;
}

    function queDelete(){
    event.preventDefault();
    document.getElementById('quedelete').submit();
}

    function ansDelete(a){
    event.preventDefault();
    let res = document.getElementById(a).className.split(" ")[0];
    document.getElementById(res).submit();
}
</script>

@endsection
