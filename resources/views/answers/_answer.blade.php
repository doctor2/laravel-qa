<answer :answer="{{ $answer }}" inline-template>
    <div class="media post">
        <div class="d-flex flex-column">
            @include('shared._vote', [
                'model' => $answer,
            ])
        </div>
        <div class="media-body">

            {!!$answer->body_html!!}

            <div class="row">

                <div class="col-4">
                    <div class="ml-auto">
                        @can('update', $answer)
                            <a @click.prevent="editing = true" class="btn btn-small btn-outline-info"> Edit question</a>
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
{{--                    @include('shared._author',[--}}
{{--                        'model' => $answer,--}}
{{--                        'label' => 'answered'--}}
{{--                    ])--}}
                    <user-info :model="{{$answer}}" label="answered"></user-info>
                </div>
            </div>

        </div>
    </div>
</answer>