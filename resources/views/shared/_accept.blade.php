@can('accept', $model)
    <a href="Click as favorite" class="favorite {{$model->status}}"
        onclick="event.preventDefault();document.getElementById('f-answer-{{$model->id}}').submit()"
        >favorite 
            <span class="favorites-count">1f</span>
        </a>
    <form action="{{route('answers.accept', $model->id)}}" id="f-answer-{{$model->id}}" method="POST" style="display:none;">
    @csrf
    </form>
@else
    @if ($model->is_best)
        <span>This is favorite answer!</span>
    @endif
@endcan