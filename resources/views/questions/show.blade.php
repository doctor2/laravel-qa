@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-item-center">
                        <h1>{{$question->title}}</h1>
                        <div class="ml-auto">
                            <a href="{{route('questions.index')}}" class="btn btn-outline-secondary">Back to all questions</a>
                        </div>
                    </div>   
                </div>

                <div class="card-body">
                    <div class="media">
                        <div class="d-flex flex-column">
                            <a href="" title="This question is usful" class="vote-up"> vote up</a>
                            <span class="votu-count">123</span>
                            <a href="" title="This question is not usful" class="vote-down">vote down</a>
                            <a href="Click as favorite" class="favorite">favorite 
                                <span class="favorites-count">12</span>
                            </a>
                        </div>
                        <div class="media-body">
                                {!!$question->body_html!!}
                                <div class="float-right">
                                   <span class="text-muted"> {{$question->created_date}}</span>
                                   <div class="media">
                                       <a href="{{ $question->user->url}}" class="pr-2">
                                           <img src="{{$question->user->avatar}}" alt="">
                                       </a>
                                       <div class="media-body">
                                       <a href="{{$question->user->url}}"> {{$question->user->name}}</a>
                                       </div>
                                   </div>
                               </div>
                        </div>
                    </div>
               
                </div>

            </div>
        </div>
    </div>
    @include('answers._index',[
        'answers' =>$question->answers,
        'answersCount' => $question->answers_count,
    ])
    @include('answers._create')
</div>
@endsection
