<a href="Click as favorite" class="favorite {{ Auth::guest()? 'off' : ($model->is_favorited ? 'favorited':'')}}"
    onclick="event.preventDefault();document.getElementById('f-{{$name}}-{{$model->id}}').submit()"                            
    >favorite 
    <span class="favorites-count">{{$model->favorites_count}}</span>
</a>
<form action="/questions/{{$model->id}}/favorites" id="f-{{$name}}-{{$model->id}}" method="POST" style="display:none;">
    @csrf
    @if ($model->is_favorited)
        @method('DELETE')
    @endif
</form>