@if ($model instanceof App\Question)
    @php
        $name = 'question';
        $firstUri = 'questions';
    @endphp
@elseif($model instanceof App\Answer)
    @php
        $name = 'answer';
        $firstUri = 'answers';
    @endphp
@endif
@php
    $formId = $name . '-' . $model->id;
    $formAction = "/{$firstUri}/{$model->id}/vote";
@endphp
<div class="d-flex flex-column">                 
        <a href="" title="This {{$name}} is usfull" class="vote-up {{Auth::guest() ? 'off' : ''}}"
            onclick="event.preventDefault();document.getElementById('up-vote-{{$formId}}').submit()"                                                    
            > vote up</a>
        <form action="{{$formAction}}" id="up-vote-{{$formId}}" method="POST" style="display:none;">
            @csrf
            <input type="hidden" name="vote" value="1">
        </form>

        <span class="votu-count">{{$model->votes_count}}</span>

        <a href="" title="This {{$name}} is not usfull" class="vote-down {{Auth::guest() ? 'off' : ''}}"
            onclick="event.preventDefault();document.getElementById('down-vote-{{$formId}}').submit()"                                                                                
            >vote down</a>
        <form action="{{$formAction}}" id="down-vote-{{$formId}}" method="POST" style="display:none;">
            @csrf
            <input type="hidden" name="vote" value="-1">
        </form>

        @if ($model instanceof App\Question)
        <favorite :question="{{ $model}}"></favorite>
            {{-- @include('shared._favorite',[
                'model' => $model
            ]) --}}
        @elseif($model instanceof App\Answer)
        {{-- <accept :answer={{$model}}></accept> --}}
            {{-- @include('shared._accept',[
                'model' => $model
            ]) --}}
        @endif
    
    </div>