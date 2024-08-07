<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MOELCI 1 | {{ $name }}</title>
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/bootstrap.min.css') }}"> --}}


    <style>
        h1 {
            font-size: 30px;
            color: #000;
            text-transform: uppercase;
            font-weight: 300;
            text-align: center;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            table-layout: fixed;
        }

        .tbl-header {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .tbl-content {
            /* height: 300px; */
            overflow-x: auto;
            margin-top: 0px;
            /* border: 1px solid rgba(0, 0, 0, 0.3); */
        }

        th {
            padding: 20px 15px;
            text-align: left;
            font-weight: 500;
            font-size: 12px;
            color: #000;
            text-transform: uppercase;
        }

        td {
            padding: 10px;
            text-align: left;
            vertical-align: middle;
            font-weight: 300;
            font-size: 12px;
            color: #000;
            border-bottom: solid 1px rgba(0, 0, 0, 0.1);
        }


        /* demo styles */

        @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);

        body {
            /* background: -webkit-linear-gradient(left, #25c481, #25b7c4);
            background: linear-gradient(to right, #25c481, #25b7c4); */
            background: rgb(192, 186, 176);
            background: radial-gradient(circle, rgba(192, 186, 176, 1) 27%, rgba(255, 255, 255, 1) 84%);
            font-family: 'Roboto', sans-serif;
        }

        section {
            margin: 20px;
        }


        /* follow me template */
        /* .generated-by {
            vertical-align: text-bottom;
            margin-top: 40px;
            padding: 10px;
            clear: left;
            text-align: center;
            font-size: 10px;
            font-family: arial;
            color: #000;
        } */


        .generated-by {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            vertical-align: text-sub;
            margin-top: 40px;
            padding: 10px;
            clear: left;
            text-align: center;
            font-size: 10px;
            font-family: arial;
            color: #000;
        }

        .generated-by i {
            font-style: normal;
            color: #F50057;
            font-size: 14px;
            position: relative;
            top: 2px;
        }

        .generated-by a {
            color: #000;
            text-decoration: none;
        }

        .generated-by a:hover {
            text-decoration: underline;
        }


        /* for custom scrollbar for webkit browser*/

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        }

        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        }
    </style>

</head>

<body>
    <section>
        <h1>List of Purchased Materials</h1>
        <h2>{{ $monthname }} {{ $year }}</h2>
        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="1">
                <thead>
                    <tr>
                        <th>Requesting Employee</th>
                        <th>Material Code</th>
                        <th>Material Description</th>
                        <th>Supplier</th>
                        <th>Amount</th>
                        <th>Date of Purchase</th>
                        {{-- <th>Date Paid</th> --}}
                        <th>Issued to</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table cellpadding="1" cellspacing="0" border="0">
                <tbody>
                    @foreach ($purchasedmaterials as $material)
                        <tr>
                            <!-- <th scope="row">1</th> -->
                            <td style="text-transform: uppercase;">{{ $material->requisitioner }}</td>
                            <td>{{ $material->material_code }}</td>
                            <td>{{ $material->material_description }}</td>
                            <td>{{ $material->supplier }}</td>
                            <td>{{ number_format($material->amount, 2, '.', ',') }}</td>
                            <td>{{ $material->date_of_delivery }}</td>
                            {{-- <td>{{ $material->date_paid }}</td> --}}
                            <td style="text-transform: uppercase;">{{ $material->issued_to }}</td>
                            <td>{{ $material->remarks }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <div class="generated-by">
        Generated by
        <strong>{{ $user->name }}</stong>
    </div>


    {{-- <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
</body>

</html>
