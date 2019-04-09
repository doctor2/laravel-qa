@extends('layouts.app')

@section('content')
    <question-page :question="{{$question}}"></question-page>
{{--<div class="container">--}}
{{--    @include('answers._index',[--}}
{{--        'answers' =>$question->answers,--}}
{{--        'answersCount' => $question->answers_count,--}}
{{--        'questionId' => $question->id,--}}
{{--    ])--}}
{{--    @include('answers._create')--}}
{{--</div>--}}
@endsection
