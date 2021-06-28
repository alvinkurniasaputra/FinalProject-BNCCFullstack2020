@extends('layouts.appx')

@section('css')
<link href="{{ asset('css/forum/users/edit.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container pt-4 mb-5">
    <div class="myHeader">
        <a class="btn" href="{{ url("/users/$user->id") }}">Profile</a>
        <a class="btn btn-primary" href="{{ url("/users/$user->id/edit") }}">Edit profile</a>
    </div>
    <div class="editProfile mt-5 ml-4 pl-5">
        <h1 style="font-size: 21px">Edit Profile</h1>
        <hr class="mb-4">
        <p style="font-size: 21px">Public Information</p>

        <div class="row">
            <div class="photo">
                <img class="photo-profile" src="/uploads/images/{{ $user->photo }}">
                <div class="dropdown">
                    <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Change picture
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <form action="/users/{{$user->id}}/photo" method="POST" enctype="multipart/form-data" style="margin-left: 10px;">
                            @csrf
                            <input type="file" name="image">
                            <input type="submit" class="btn btn-primary btn-sm" value="Upload" style="margin-top: 5px;">
                        </form>
                    </div>
                </div>
            </div>

            <div class="top-field">
                <form id="update">
                    <div class="form-group">
                        <h5 for="name">Display name</h5>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $user->name) }}" autocomplete="off" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <h5 for="location">Location</h5>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{old('location', $user->location) }}" autocomplete="off">
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <h5 for="title">Title</h5>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title', $user->title) }}" autocomplete="off">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            </div>
        </div>

            <div class="col-9 pl-0">
                <div class="form-group">
                    <h5 for="about_me">About Me</h5>
                    <textarea class="form-control @error('about_me') is-invalid @enderror" id="about_me" name="about_me" autocomplete="off" rows="8" cols="30">{{old('about_me', $user->about_me) }}</textarea>
                    @error('about_me')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div id="result"></div>
                <button type="submit" class="btn btn-primary mr-4">Save profile</button>
                <a href="{{ url("/users/$user->id") }}">cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
    $('#update').on('submit',function(e){
			e.preventDefault();
			$.ajax({
				url: "{{URL('users/'.$user->id)}}",
				type:'POST',
				data: {
                _token:'{{ csrf_token() }}',
				name: $('#name').val(),
				location: $('#location').val(),
				title: $('#title').val(),
				about_me: $('#about_me').val()
			},
				success: function(response) {
         document.getElementById('result').innerHTML=`
         <svg xmlns="http://www.w3.org/2000/svg" width="80" height="60" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
        </svg><br>
         <b>Your profile has been saved successfully.</b>
         `;
         document.getElementById('result').id="res";
				}
			});
		});
</script>



@endsection

