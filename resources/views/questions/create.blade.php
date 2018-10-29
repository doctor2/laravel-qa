@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-item-center">
                        <h2>Ask question</h2>
                        <div class="ml-auto">
                            <a href="{{route('questions.index')}}" class="btn btn-outline-secondary">Back to all questions</a>
                        </div>
                    </div>   
                </div>

                <div class="card-body">
                <form action="{{route('questions.store')}}" method="post">
                    @csrf
                    <div>
                        @if($errors->has('title'))
                        <strong>
                            {{$errors->first('title')}}
                        </strong>
                        @endif
                        <input type="text" name="title">
                    </div>
                    <div>
                         @if($errors->has('body'))
                        <strong>
                            {{$errors->first('body')}}
                        </strong>
                        @endif
                        <textarea name="body" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div>
                        <button type="submit">Ask the questons</button>
                    </div>
                </form>

                </div>

            </div>
        </div>
    </div>
</div>
@endsection
