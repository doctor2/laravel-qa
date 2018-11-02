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

                            <a href="" title="This question is usfull" class="vote-up {{Auth::guest() ? 'off' : ''}}"
                            onclick="event.preventDefault();document.getElementById('up-vote-question-{{$question->id}}').submit()"                                                    
                            > vote up</a>
                            <form action="/questions/{{$question->id}}/vote" id="up-vote-question-{{$question->id}}" method="POST" style="display:none;">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>

                            <span class="votu-count">{{$question->votes_count}}</span>

                            <a href="" title="This question is not usfull" class="vote-down {{Auth::guest() ? 'off' : ''}}"
                            onclick="event.preventDefault();document.getElementById('down-vote-question-{{$question->id}}').submit()"                                                                                
                            >vote down</a>
                            <form action="/questions/{{$question->id}}/vote" id="down-vote-question-{{$question->id}}" method="POST" style="display:none;">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>

                            <a href="Click as favorite" class="favorite {{ Auth::guest()? 'off' : ($question->is_favorited ? 'favorited':'')}}"
                            onclick="event.preventDefault();document.getElementById('f-question-{{$question->id}}').submit()"                            
                            >favorite 
                                <span class="favorites-count">{{$question->favorites_count}}</span>
                            </a>
                            <form action="/questions/{{$question->id}}/favorites" id="f-question-{{$question->id}}" method="POST" style="display:none;">
                                @csrf
                                @if ($question->is_favorited)
                                    @method('DELETE')
                                @endif
                            </form>
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
        'questionId' => $question->id,
    ])
    @include('answers._create')
</div>
@endsection
