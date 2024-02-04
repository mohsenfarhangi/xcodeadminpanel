@props(['options' => [],'current' => ''])


<select {!! $attributes->merge(['class' => 'form-select']) !!}>
    @foreach($options as $key => $option)
        <option value="{{$key}}" {{$key == $current ? 'selected' : ''}}>{{$option}}</option>
    @endforeach
</select>
