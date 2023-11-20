<tr>
    <th class="align-middle">{{$name}}</th>
    <td  >

        <table class="table table-borderless" style="border: 0">
            <tbody>
            @foreach ($arr  as  $item)
                <tr>
                    <form action="{{route("$url-payment-details.update",$item->id)}}" class="submit-form" method="post">
                        @csrf
                        @method('PATCH')

                        <td><input type="number" name="amount" id="{{$arr_name}}-{{$item->id}}-amount" class="border-0" value="{{ $item->amount }}" disabled> </td>
                        <td>
                            <select name="status" id="{{$arr_name}}-{{$item->id}}-status"  class="border-0" disabled required>
                                <option value="{{ $item->status }}" hidden>{{ $item->status }}</option>
                                <option value="work done and payed">work done and payed</option>
                                <option value="work done but not payed">work done but not payed</option>
                                <option value="work not done but payed">work not done but payed</option>
                                <option value="not work done and  not payed">not work done and not payed</option>
                            </select>
                            <input type="hidden" name="inp_name" value="{{$arr_name}}-{{$item->id}}" >
                        </td>
                        <td><textarea name="description" id="{{$arr_name}}-{{$item->id}}-description" placeholder="description ..." class="border-0" cols="20" rows="3"  disabled>{{ $item->description  }}</textarea> </td>
                        <td>{{$item->created_at}}</td>
                        @if ($action)
                        <td>

                              <div class="btn-group btn-group-sm">
                            <button type="submit" class="d-none btn btn-success btn-sm" id="{{$arr_name}}-{{$item->id}}-submit-button"  > <i class="fas fa-save"></i></button>
                            <button type="button" class="btn btn-sm btn-primary" id="{{$arr_name}}-{{$item->id}}-edit-button"  onclick="editDetails('{{$arr_name}}-{{$item->id}}')"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-danger btn-sm"  data-toggle="modal" data-id="{{$item->id}}" data-name="{{$arr_name}}-{{$item->id}}"
                            data-target="#myModal"><i class="fas fa-trash"></i></button>
                              </div>
                        </td>
                        @endif

                    </form>
                </tr>
            @endforeach
            @if (  $arr != [])
                <tr>
                    <td colspan="{{$action ? '4' : '3'}}" class="text-end"><strong>Total </strong></td>
                    <td class="text-center"><strong id="{{$arr_name}}-{{$item->id}}-total">{{$data->$arr_name  }} </strong></td>
                </tr>
            @endif
        </tbody>
        </table>
    </td>
</tr>
