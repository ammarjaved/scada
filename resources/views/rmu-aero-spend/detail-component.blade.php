<tr>
    <th class="align-middle" rowspan="{{ $rowCount > 1 ? $rowCount - 1 : '1' }}"> {{ $name }}</th>

    @if ($arr == [])
        <td></td>
        <td></td>
        <td></td>
</tr>
@else
@foreach ($arr as $index => $item)
    {!! $index != '0' ? '<tr> ' : '' !!}
    <td>{{ $item->amount }}</td>
    <td> {{ $item->status }}</td>
    <td>{{ $item->description }}</td>
    </tr>
@endforeach

@endif
