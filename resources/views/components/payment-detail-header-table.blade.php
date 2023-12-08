<table class=" mb-3 table-borderless col-md-3">
    <tbody>
        <tr>
            <th>PE NAME : </th>
            <td>{{ $name }}</td>
        </tr>

        <tr>
            <th>BUDGET BY TNB : </th>

            <td>
                <span id="budget"> {{ $budget }} </span><strong>(RMB)</strong>
            </td>
        </tr>
        <tr>
            <th>FIX PROFIT :</th>
            <td> {{ $fixprofit }} <strong>(RMB) </strong></td>
        </tr>
        <tr>
            <th>TOTAL SPENDING :</th>
            <td><span class="subTotal">{{ $spending }}</span> <strong>(RMB) </strong></td>
        </tr>
        <tr>
            <th>TOTAL PENDING :</th>
            <td><span class="pending">{{ $pending }}</span> <strong>(RMB) </strong></td>
        </tr>
        <tr>
            <th>TOTAL OUTSTANDING :</th>
            <td><span class="outstanding">{{ $outstanding }}</span> <strong>(RMB) </strong></td>
        </tr>
        <tr>
            <th>TOTAL PROFIT :</th>
            <td><span class="total_profit">{{ $profit }} </span><strong>%</strong></td>
        </tr>
    </tbody>
</table>
