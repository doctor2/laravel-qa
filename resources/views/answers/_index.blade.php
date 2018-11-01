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
                                <div class="float-right">
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