<div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                    <h2>{{$answersCount  . " " . str_plural('Answer', $answersCount)}}</h2>
                    </div>
                    <hr>
                    @include('layouts._message')
                    @foreach ($answers as $answer)
                        <div class="media">
                            <div class="d-flex flex-column">

                                    <a href="" title="This answer is usfull" class="vote-up {{Auth::guest() ? 'off' : ''}}"
                                    onclick="event.preventDefault();document.getElementById('up-vote-answer-{{$answer->id}}').submit()"                                                    
                                    > vote up</a>
                                    <form action="/answers/{{$answer->id}}/vote" id="up-vote-answer-{{$answer->id}}" method="POST" style="display:none;">
                                        @csrf
                                        <input type="hidden" name="vote" value="1">
                                    </form>
        
                                    <span class="votu-count">{{$answer->votes_count}}</span>
        
                                    <a href="" title="This answer is not usfull" class="vote-down {{Auth::guest() ? 'off' : ''}}"
                                    onclick="event.preventDefault();document.getElementById('down-vote-answer-{{$answer->id}}').submit()"                                                                                
                                    >vote down</a>
                                    <form action="/answers/{{$answer->id}}/vote" id="down-vote-answer-{{$answer->id}}" method="POST" style="display:none;">
                                        @csrf
                                        <input type="hidden" name="vote" value="-1">
                                    </form>
                               
                               
                                @can('accept', $answer)
                                    <a href="Click as favorite" class="favorite {{$answer->status}}"
                                        onclick="event.preventDefault();document.getElementById('f-answer-{{$answer->id}}').submit()"
                                        >favorite 
                                            <span class="favorites-count">1f</span>
                                        </a>
                                    <form action="{{route('answers.accept', $answer->id)}}" id="f-answer-{{$answer->id}}" method="POST" style="display:none;">
                                    @csrf
                                    </form>
                                        
                                @else
                                        @if ($answer->is_best)
                                            <span>This is favorite answer!</span>
                                        @endif
                                @endcan
                           
                            </div>
                            <div class="media-body">
                                {!!$answer->body_html!!}
                                <div class="row">
                                        <div class="col-4">
                                                <div class="ml-auto">
                                                    @can('update', $answer)
                                                        <a href="{{route('questions.answers.edit',[$questionId, $answer->id])}}" 
                                                        class="btn btn-small btn-outline-info"> Edit question</a>
                                                    @endif
                                                    @can('delete', $answer)
                                                        <form action="{{route('questions.answers.destroy',[$questionId, $answer->id])}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-small btn-outline-danger"
                                                            onclick="return confirm('Are you sure?')"
                                                            >delete</button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </div>
                                            <div class="col-4">
                                            </div>
                                            <div class="col-4">
                                                <span class="text-muted"> {{$answer->created_date}}</span>
                                                <div class="media">
                                                    <a href="{{ $answer->user->url}}" class="pr-2">
                                                        <img src="{{$answer->user->avatar}}" alt="">
                                                    </a>
                                                    <div class="media-body">
                                                    <a href="{{$answer->user->url}}"> {{$answer->user->name}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                                
                               
                            </div>
                        </div> 
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
</div>