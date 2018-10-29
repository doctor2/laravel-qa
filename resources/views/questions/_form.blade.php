@csrf
<div>
    @if($errors->has('title'))
    <strong>
        {{$errors->first('title')}}
    </strong>
    @endif
    <input type="text" name="title" value="{{old('title', $question->title)}}">
</div>
<div>
    @if($errors->has('body'))
    <strong>
        {{$errors->first('body')}}
    </strong>
    @endif
    <textarea name="body" id="" cols="30" rows="10">{{old('body', $question->body)}}</textarea>
</div>
<div>
    <button type="submit">{{$buttonText}}</button>
</div>