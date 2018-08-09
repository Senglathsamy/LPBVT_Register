<option>ເລືອກວິຊາຮຽນ</option>
@if(!empty($subject))
    @foreach($subject as $key => $subb_id)
        <option value="{{ $key }}">{{ $subb_id }}</option>
    @endforeach
@endif