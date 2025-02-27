<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>A simple, clean, and responsive HTML invoice template</title>
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <!-- Update the image path accordingly -->
                                <img src="{{ asset('logo/' . $setting->logo) }}" style="width:60px; height:70px;" alt="LOGO" />
                            </td>
                            <td>
                                Invoice No #: 12387878<br />
                                Created: January 1, 2015<br />
                                Due: February 1, 2015

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Sparksuite, Inc.<br />
                                12345 Sunny Road<br />
                                Sunnyville, CA 12345
                            </td>

                            <td>
                                Acme Corp.<br />
                                John Doe<br />
                                john@example.com
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Payment Method</td>
                <td>Cash #</td>
            </tr>

            <tr class="details">
                <td>Check</td>
                <td>1000</td>
            </tr>

            <tr class="heading">
                <td>Installment</td>
                <td>Paid Amount</td>
            </tr>

            <!-- Loop through the invoices -->
            @foreach ($invoices as $key => $row)
            <tr class="item">
                <td>{{ $key + 1 }}</td>
                <td>{{ $row->income_amount }}</td>
            </tr>
            @endforeach

            <tr class="item last" style="color: rgb(12, 12, 14); font-weight: bold;">
                <td></td>
                <td>Total Paid Amount <span style="color: rgb(12, 12, 14);">:</span> {{ $data->paid_amount }}</td>

            </tr>
            <tr class="item last" style="color: black; font-weight: bold;">
                <td></td>
                <td>Due Amount <span style="color: rgb(12, 12, 14);">:</span> {{ $data->due_amount }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
