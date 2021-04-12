@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Horse list</h1>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <ul class="list-group">
                            @foreach ($horses as $horse)
                            <li class="list-group-item list-element">
                                <div class="content-group list-element__group">
                                    <label class="list-element__group__name">Horse</label>
                                    <h3>{{$horse->name}}</h3>
                                    <div class="make-inline">
                                        <label class="list-element__group__name">Runs</label>
                                        <p>{{$horse->runs}}</p>
                                        <label class="list-element__group__name">Wins</label>
                                        <p>{{$horse->wins}}</p>
                                    </div>
                                </div>
                                <div class="list-element__buttons">
                                    <a class="btncustom info" href="{{route('horse.pdf', [$horse])}}">PDF</a>
                                    <a class="btncustom" href="{{route('horse.edit', [$horse])}}">EDIT</a>
                                    <form action="{{route('horse.delete', [$horse])}}" method="post">
                                        <button class="btncustom red" type="submit">DELETE</button>
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection