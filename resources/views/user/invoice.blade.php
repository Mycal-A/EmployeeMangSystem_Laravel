<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            width: 80%;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .logo {
            float: right;
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .header {
            text-align: right;
        }

        .bill-info,
        .bill-from {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            border: 1px solid #dee2e6;
            /* Add a border around the entire .bill-info and .bill-from */
            padding: 10px;
            /* Add padding for better visual appearance */
        }

        .bill-info .address,
        .bill-info .date {
            border: 1px solid #dee2e6;
            /* Add a border to each child element */
            padding: 10px;
            /* Add padding for better visual appearance */
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #dee2e6;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        tfoot td {
            text-align: right;
            font-weight: bold;
        }

    </style>
</head>

<body>

    <div class="container">
        <div style="float: right">
            <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/images/invoice.png'))); ?>"
                width="50" style="text-align: right">
        </div>
        <div>
            <table style="border: none; margin-top: 30px;">
                <tr>
                    <td style="border: none">
                        <div class="" style="text-align: left">
                            <h2>Page Soft</h2>
                        </div>
                    </td>
                    <td style="border: none">
                        <div class="" style="text-align:right">
                            <h2>Invoice</h2>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div>
            <!-- Bill-to Information -->
            <table style="margin-top: 0px;">
                <tr>
                    <td>
                        <div>
                            <p><b>Invoice Number:</b> INV-12345</p>
                            <span style="font-weight: bold;">Date:</span> November 23, 2023
                            
                        </div>
                    </td>
                    <td rowspan="2">
                        <div class="address">
                            <h4>Bill From:</h4>
                            <p>Your Company Name</p>
                            <p>456 Business Street</p>
                            <p>City, Country</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="address">
                            <h4>Bill To:</h4>
                            <p>John Doe</p>
                            <p>123 Main Street</p>
                            <p>City, Country</p>
                        </div>
                    </td>
                </tr>

            </table>
            <!-- Items Table -->
            <table> 
                <thead style="background-color: #e6f7ff;">
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Car 1</td>
                        <td>2</td>
                        <td>$25,000</td>
                        <td>$50,000</td>
                    </tr>
                    <tr>
                        <td>Car 2</td>
                        <td>1</td>
                        <td>$30,000</td>
                        <td>$30,000</td>
                    </tr>
                    <tr>
                        <td>Car 3</td>
                        <td>1</td>
                        <td>$30,000</td>
                        <td>$30,000</td>
                    </tr>
                </tbody>
                <tfoot style="border: none">
                    <tr style="border: none">
                        <td colspan="3" style="border: none"><strong>SubTotal:</strong></td>
                        <td>$0.00</td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Discount:</strong></td>
                        <td>$0.00</td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Tax:</strong></td>
                        <td>$0.00</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="background-color: #e6f7ff;"><strong>Total:</strong></td>
                        <td style="background-color: #e6f7ff;"><strong>$110,000</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
</body>

</html>
