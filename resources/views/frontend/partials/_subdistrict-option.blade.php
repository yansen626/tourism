@foreach($collect->rajaongkir->results as $subdistrict)
    <option value="{{ $subdistrict->subdistrict_id }},{{ $subdistrict->subdistrict_name }}">{{ $subdistrict->subdistrict_name }}</option>
@endforeach