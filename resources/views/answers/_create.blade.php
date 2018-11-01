<div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                    <h3>Your answer</h3>
                    </div>
                    <hr>
                <form action="{{route('questions.answers.store', $question->id)}}" method="POST">
                       @csrf
                       <div class="form-group">
                       <textarea id="" class="form-control {{$errors->has('body')? 'is-invalid': ''}}" rows="10" name="body">{{old('body')}}</textarea>
                        @if($errors->has('body'))
                        <strong>{{$errors->first('body')}}</strong>
                        @endif
                    </div>
                       <div class="form-group">
                           <button type="submit" class="btn btn-large btn-outline-primeri">submit</button>
                       </div>
                   </form>
                </div>
            </div>
        </div>
</div>