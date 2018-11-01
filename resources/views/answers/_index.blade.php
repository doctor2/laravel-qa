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
                            <div class="media-body">
                                {!!$answer->body_html!!}
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
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
</div>