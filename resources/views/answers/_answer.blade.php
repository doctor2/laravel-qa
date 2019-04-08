<answer :answer="{{ $answer }}" inline-template>
    <div class="media post">
        <div class="d-flex flex-column">
            <vote name="answer" :model="{{$answer}}"></vote>
{{--            @include('shared._vote', [--}}
{{--                'model' => $answer,--}}
{{--            ])--}}
        </div>
        <div class="media-body">
            <form v-if="editing" @submit.prevent="update">
                <div class="form-group">
                    <textarea cols="10" rows="10" v-model="body" class="form-control"></textarea>
                </div>
                <button class="btn btn-primary" :disabled="isInvalid">Update</button>
                <button class="btn btn-outline-secondary" type="button"  @click.prevent="calcel">Cancel</button>
            </form>
            <div v-else>
                <div v-html="bodyHtml"></div>
                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">
                            @can('update', $answer)
                                <a @click.prevent="edit" class="btn btn-small btn-outline-info"> Edit question</a>
                            @endif
                            @can('delete', $answer)
                                    <button @click="destroy" class="btn btn-small btn-outline-danger"
                                    >delete</button>
{{--                                    <form action="{{route('questions.answers.destroy',[$questionId, $answer->id])}}" method="post">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                    </form>--}}
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
    </div>
</answer>