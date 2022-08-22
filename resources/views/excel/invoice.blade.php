<table>
    <thead>
    <tr>
        <th>coupon_name</th>
        <th>card_total</th>
        <th>discount_amount</th>
        <th>sub-total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->card_total }}</td>
            <td>{{ $invoice->discount_amount }}</td>
            <td>{{ $invoice->sub_total }}</td>
            <td>{{ $invoice->coupon_name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
