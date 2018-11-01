@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                    <h1>Editing answer for question: <strong>{{$question->title}}</strong></h1>
                    </div>
                    <hr>
                <form action="{{route('questions.answers.update', [$question->id, $answer->id])}}" method="POST">
                       @csrf
                       @method('PATCH')
                       <div class="form-group">
                       <textarea id="" class="form-control {{$errors->has('body')? 'is-invalid': ''}}" rows="10" name="body">{{old('body', $answer->body)}}</textarea>
                        @if($errors->has('body'))
                        <strong>{{$errors->first('body')}}</strong>
                        @endif
                    </div>
                       <div class="form-group">
                           <button type="submit" class="btn btn-large btn-outline-primeri">update</button>
                       </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection