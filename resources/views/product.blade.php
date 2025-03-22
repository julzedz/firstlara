@extends('components.layouts.main')

@section('header')
    <h2>Product11</h2>
@endsection

@section('content')
    <form action="{{ route('formsubmitted') }}" method="post">
        @csrf
        <label for="fullname">Full Name:</label>
        <input class="" type="text" id="fullname" name="fullname" placeholder="Name" required>
        <br>
        <br>
        <label for="email">E-mail:</label>
        <input type="text" id="email" name="email" placeholder="Email" required>
        <br>
        <br>
        <button type="submit">Submit</button>
    </form>
@endsection