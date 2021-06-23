@extends('layouts.appx')

@section('css')
<link href="{{ asset('css/forum/users/index.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container pt-4">
    <h3 class="mb-4">Users</h3>
    <form class="form-inline mb-5">
        <button type="submit" disabled><i class="fa fa-search"></i></button>
        <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" autocomplete="off" placeholder="Filter by user" aria-label="Search">
    </form>
    <div class="col-9" id="myDiv">
        @foreach ($user as $item)
            <p class="col-3" style="display: inline-block"><a href="#">{{$item->name}}</a></p>
        @endforeach
    </div>

</div>

<script>
    function myFunction() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        div = document.getElementById("myDiv");
        p = div.getElementsByTagName("p");
        for (i = 0; i < p.length; i++) {
            a = p[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                p[i].style.display = "inline-block";
            } else {
                p[i].style.display = "none";
            }
        }
    }
</script>

@endsection
