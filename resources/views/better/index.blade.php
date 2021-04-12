@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Beeter list</h1>
                    <div class="make-inline">
                        <form action="{{route('better.index')}}" method="get" class="make-inline">
                            <div class="form-group make-inline">
                                <label>Horse: </label>
                                <select class="form-control" name="horse_id">
                                    <option value="0" disabled @if($filterBy == 0) selected @endif>Select Horse</option>
                                    @foreach ($horses as $horse)
                                    <option value="{{$horse->id}}" @if($filterBy == $horse->id) selected @endif>
                                        {{$horse->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="form-check-label">Sort by horse name:</label>
                            <label class="form-check-label" for="sortASC">ASC</label>
                            <div class="form-group make-inline column">
                                <input type="radio" class="form-check-input" name="sort" value="asc" id="sortASC" @if($sortBy == 'asc') checked @endif>
                            </div>
                            <label class="form-check-label" for="sortDESC">DESC</label>
                            <div class="form-group make-inline column">
                                <input type="radio" class="form-check-input" name="sort" value="desc" id="sortDESC" @if($sortBy == 'desc') checked @endif>
                            </div>
                            <button type="submit" class="btncustom">Filter</button>
                        </form>

                        <a href="{{route('better.index')}}" class="btncustom">Clear filter</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <ul class="list-group">
                            @foreach ($betters as $better)
                            <li class="list-group-item list-element">
                                <div class="content-group list-element__group">
                                    <label class="list-element__group__name">Beeter name</label>
                                    <h3>{{$better->name}} {{$better->surname}}</h3>
                                        <label class="list-element__group__name">Chosen horse</label>
                                        @foreach ($horses as $horse)
                                            @if ($better->horse_id === $horse->id)
                                                <p>{{$horse->name}}</p>
                                            @endif
                                        @endforeach
                                        <label class="list-element__group__name">Bet</label>
                                        <p>{{$better->bet}} Eur</p>
                                </div>
                                <div class="list-element__buttons">
                                    <a class="btncustom" href="{{route('better.edit', [$better])}}">EDIT</a>
                                    <form action="{{route('better.delete', [$better])}}" method="post">
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