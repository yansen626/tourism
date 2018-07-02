<option value="-1">- Select City -</option>
@if(!empty($cities))
    @foreach($cities as $city)
        <option value="{{ $city->id }}">{{ $city->name }}</option>
    @endforeach
@endif