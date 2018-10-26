@extends('layout')

@section('content')
    <div class="card">
        <div class="card-header">Simple Laravel URL Shortener</div>
        <div class="card-body">
            <h5 class="card-title">Link created successfully</h5>
            Link: <b>{{ request()->getSchemeAndHttpHost() . '/' . $link->short }}</b>
            <br>
            Redirect to: <b>{{ $link->full }}</b>
            <br>
            @if($link->is_expired)
                Link expired
            @elseif($link->expired_at == null)
                Link will be available forever
            @else
                Link will be available
                for {{  $link->expired_at->diffInMinutes(\Carbon\Carbon::now()) }} {{ str_plural('minute',  $link->expired_at->diffInMinutes(\Carbon\Carbon::now())) }}
            @endif

            <a href="{{ route('links.index') }}" class="btn d-block btn-secondary mt-3">Make another one</a>
        </div>
    </div>
@endsection
