@extends('layouts.appx')

@section('css')
<link href="{{ asset('css/forum/questions/edit.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="content">
    <div class="pt-4 pl-4 col-8">
        <form role="form" method="POST" action="{{ url("/answers/$question->id/$answer->id") }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <h5 for="content">Answer</h5>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" autocomplete="off" rows="10" cols="30" required>{{old('content', $answer->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <p>{{$answer->content}}</p>
            </div>
            <button type="submit" class="btn btn-primary">Save edits</button>
        </form>
    </div>
</div>

@endsection
