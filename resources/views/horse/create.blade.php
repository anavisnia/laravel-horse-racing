@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Add New Horse
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('horse.store')}}">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="horse_name" value="{{old('horse_name')}}">
                            <small class="form-text text-muted">Please enter horse name</small>
                        </div>

                        <div class="form-group">
                            <label>Runs:</label>
                            <input type="text" class="form-control" name="horse_runs" value="{{old('horse_runs')}}">
                            <small class="form-text text-muted">Please enter how many runs the horse have</small>
                        </div>

                        <div class="form-group">
                            <label>Wins:</label>
                            <input type="text" class="form-control" name="horse_wins" value="{{old('horse_wins')}}">
                            <small class="form-text text-muted">Please enter how many wins the horse have</small>
                        </div>

                        <div class="form-group">
                            <label>About horse:</label>
                            <textarea name="horse_about" id="summernote">{{old('horse_about')}}</textarea>
                            <small class="form-text text-muted">Please enter information about the horse</small>
                        </div>
                        @csrf
                        <button type="submit" class="btncustom">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        $('#summernote').summernote();
    });

</script>
@endsection