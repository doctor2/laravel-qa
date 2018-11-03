@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-item-center">
                        <h2>All questions</h2>
                        <div class="ml-auto">
                            <a href="{{route('questions.create')}}" class="btn btn-outline-secondary">Ask new question</a>
                        </div>
                    </div>   
                
                
                </div>

                <div class="card-body">
                    @include('layouts._message')
                    @forelse ($questions as $question)
                        <div class="media post">
                            <div class="d-flex flex-column counters">
                                <div class="vote">
                                    <strong>{{$question->votes_count}}</strong> {{str_plural('vote', $question->votes_count)}}
                                </div>
                                <div class="status {{$question->status}}">
                                    <strong>{{$question->answers_count}}</strong> {{str_plural('answer', $question->answers_count)}}
                                </div>
                                <div class="view">
                                    {{$question->views . " " . str_plural('view', $question->views)}}
                                </div>
                            </div>
                            <div class="media-body">
                                <h3 class="mt-0">
                                    <!-- route('questions.show', $question->id) -->
                                    <a href="{{$question->url}}">   
                                        {{$question->title}}
                                    </a>
                                </h3>
                                <div class="ml-auto">
                                    @can('update-question', $question)
                                    <a href="{{route('questions.edit', $question->id)}}" 
                                    class="btn btn-small btn-outline-info"> Edit question</a>
                                    @endif
                                    {{-- for Gate Checking --}}
                                    {{-- @if(Auth::user() && Auth::user()->can('delete-question', $question)) --}}
                                    {{-- ..... Писать можно как через иф так и через кэн --}}
                                    {{-- @endif --}}

                                    {{-- for policy checking --}}
                                    @can('delete', $question)
                                    <form action="{{route('questions.destroy', $question->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-small btn-outline-danger"
                                        onclick="return confirm('Are you sure?')"
                                        >delete</button>
                                    </form>
                                    @endcan
                                    {{-- @can('update', $question)
                                        <div>
                                            можно обновлять
                                        </div>
                                    @endcan --}}
                                </div>
                                <p>
                                    Asked by
                                    <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                                    <small class="text-muted">{{$question->created_date}}</small>
                                </p>
                                {{ $question->excerpt(300) }}
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-warning">
                            <strong>Sorry</strong> There are no questions available.
                        </div>
                    @endforelse
                    {{$questions->links()}}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
