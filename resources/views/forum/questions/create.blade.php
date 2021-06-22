@extends('layouts.app')

@section('css')
<link href="{{ asset('css/forum/questions/create.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="content">
    <h4 class="mt-4">Ask a public question</h4>
    <div class="card card-content mt-5 mb-5" style="width: 60rem;">
        <form role="form" method="POST" action="/questions">
          @csrf
            <div class="card-body">
                <div class="form-group">
                    <h5 for="title">Title</h5>
                    <label for="title">Be specific and imagine you’re asking a question to another person</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title') }}" placeholder="Title" autocomplete="off" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <h5 for="content">Body</h5>
                    <label for="content">Include all the information someone would need to answer your question</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" placeholder="Body" autocomplete="off" rows="10" cols="30" required>{{old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</div>

@endsection
