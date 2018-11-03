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
                        @include('shared._vote',[
                            'model' => $question
                        ])
                        <div class="media-body">
                                {!!$question->body_html!!}
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-4"></div>
                                    <div class="col-4">
                                            @include('shared._author',[
                                                'model' => $question,
                                                'label' => 'Asked'
                                            ])
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
