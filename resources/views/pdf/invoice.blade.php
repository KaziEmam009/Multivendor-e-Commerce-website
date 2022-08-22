<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INVOICE</title>
    <style>
table, th, td {
  border: 1px solid rgb(60, 23, 224);
  border-collapse: collapse;
}
th, td {
  background-color: #eeeeee;
}
</style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                       <p  style="color:rgb(11, 11, 146); font-size:50px;">My Orders</p>
                    </div>
                            <div class="card-body">
                            <table style="width:100%">
                            <thead class="thead-inverse">
                            <tr style="color:rgb(75, 5, 60); font-size:20px;">
                                <th>Coupon Name</th>
                                <th>Card Total</th>
                                <th>Discount Amount</th>
                                <th>Sub Total</th>
                                <th>Shipping</th>
                                <th>Grand Total</th>
                                <th>Payment Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(getdataorder_summeries() as $order_summery)
                                <tr style="text-align: center">
                                    <td>{{ $order_summery->coupon_name }}</td>
                                    <td>{{ $order_summery->card_total }}</td>
                                    <td>{{ $order_summery->discount_amount }}</td>
                                    <td>{{ $order_summery->sub_total }}</td>
                                    <td>{{ $order_summery->shipping }}</td>
                                    <td>{{ $order_summery->grand_total }}</td>
                                    <td>
                                        @if ( $order_summery->payment_option  == 1)
                                            <p class="text-primary text-center">Cash On Delivery</p>
                                        @else
                                            <p class="text-danger text-center">Online Payment</p>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <h2 style="text-emphasis-color: rgb(22, 17, 17)">
                            Thank You for shopping with us......
                        </h2>
                  </div>
            </div>
        </div>
    </div>
</body>
</html>
