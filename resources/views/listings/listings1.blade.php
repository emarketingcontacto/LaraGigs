@extends('layout');

@section('content')



        @if(count($listings) == 0)
        <p>No listings found</p>
        @endif

        @foreach ($listings as $listing)
            <h2>
                <a href="/listing/{{$listing['id']}}">{{ $listing['title'] }} </a>
                </h2>
            <p> {{$listing['description']}} </p>
        @endforeach
</div>
@endsection


