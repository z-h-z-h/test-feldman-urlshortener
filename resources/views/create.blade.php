@extends('layout')

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-7 mt-5">
            <div class="card">
                <div class="card-header">Simple Laravel URL Shortener</div>
                <div class="card-body">
                    <h5 class="card-title">Create short link</h5>
                    <form method="POST" action="{{ route('links.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="full_link">Full link with http://</label>
                            <input type="text" class="form-control @if($errors->has('full')) is-invalid @endif"
                                   id="full" name="full" maxlength="1000"
                                   placeholder="Link that should be shortened" required="required"
                                   value="{{ old('full') }}">

                            <div class="invalid-feedback" style="width: 100%;">
                                @foreach($errors->get('full') as $msg)
                                    {{ $msg }} <br><br>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="short_link">Short link</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{ request()->getSchemeAndHttpHost() }}/</span>
                                </div>
                                <input type="text" class="form-control @if($errors->has('short')) is-invalid @endif"
                                       id="short" name="short"
                                       placeholder="Fill in if you don't want to get a generated link"
                                       maxlength="5"
                                       value="{{ old('short') }}">
                                <div class="invalid-feedback" style="width: 100%;">
                                    @foreach($errors->get('short') as $msg)
                                        {{ $msg }} <br><br>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="minutes">Time to live in minutes</label>
                            <input type="number" name="minutes" id="minutes"
                                   class="form-control @if($errors->has('minutes')) is-invalid @endif" value="{{ old('minutes', 5) }}">
                            <small class="form-text text-muted">Leave blank if you don't want limit the lifetime</small>
                            <div class="invalid-feedback" style="width: 100%;">
                                @foreach($errors->get('minutes') as $msg)
                                    {{ $msg }} <br><br>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-block btn-secondary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
