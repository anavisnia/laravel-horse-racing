@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Add New Better
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('better.store')}}">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="better_name" value="{{old('better_name')}}">
                            <small class="form-text text-muted">Please enter better name</small>
                        </div>

                        <div class="form-group">
                            <label>Surname:</label>
                            <input type="text" class="form-control" name="better_surname" value="{{old('better_surname')}}">
                            <small class="form-text text-muted">Please better surname</small>
                        </div>

                        <div class="form-group">
                            <label>Bet (EUR):</label>
                            <input type="text" class="form-control" name="better_bet" value="{{old('better_bet')}}">
                            <small class="form-text text-muted">Please enter how many better is willing to bet</small>
                        </div>

                        <div class="form-group">
                            <label>Choose horse:</label>
                            <select name="better_horse_id">
                                @foreach ($horses as $horse)
                                    <option value="{{$horse->id}}">
                                        {{$horse->name}}
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Please choose the horse</small>
                        </div>
                        @csrf
                        <button type="submit" class="btncustom">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection