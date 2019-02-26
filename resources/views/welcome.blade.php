@extends('layouts.main')
@section('title', 'To Do')
@section('menu')
    {!! $menu !!}
@endsection

@section('content')
<header>
    <h1>To Do</h1>
    <p>Don't have an account? Join today.</p>
</header>
<form method="post" action="{{URL('register')}}">
    @csrf
    <div class="row gtr-uniform">
        <div class="col-6 col-12-xsmall">
            <input type="text" name="name" value="" placeholder="Name" required>
        </div>
        <div class="col-6 col-12-xsmall">
            <input type="email" name="email" id="email" value="" placeholder="Email" required>
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        </div>

        <div class="col-6 col-12-xsmall">
            <input type="password" name="password" value="" placeholder="Desired Password" required>
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        </div>
        <div class="col-6 col-12-xsmall">
            <input type="password" name="password_confirmation" value="" placeholder="Confirm Password" required>
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        </div>
        <div class="col-12">
            <ul class="actions">
                <li><input type="submit" value="Sign Up" class="primary" /></li>
                <li><input type="reset" value="Reset" /></li>
            </ul>
        </div>
    </div>
</form>
@endsection