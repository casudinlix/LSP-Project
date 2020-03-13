<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>NOTA</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }
    </style>

</head>

<body>
    @php
    $user=DB::table('users')->where('id',$data->userId)->first();

    @endphp
    <table width="100%">
        <tr>
            <td align="right">
                <h3>xx</h3>
                <pre>
                {{$user->name}}


                </pre>
            </td>
        </tr>

    </table>



    <br />

    <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>#</th>
                <th>Deskripsi</th>
                <th>QTY</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @php
            $total=0;
            @endphp

            <tr>
                <td scope="row">{{$data->kode}}</td>
                <td>{{$data->name}}</td>
                <td align="right">{{$data->qty}}</td>
                <td align="right">{{number_format($data->harga)}}</td>



            </tr>

        </tbody>

        <tfoot>
            <tr>
                <td colspan="2"></td>
                <td align="right">Subtotal Rp</td>
                <td align="right">{{number_format($data->harga)}}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                {{-- <td align="right">Tax $</td>
                <td align="right">294.3</td> --}}
            </tr>
            <tr>
                <td colspan="2"></td>
                <td align="right">Total Rp</td>
                <td align="right" class="gray">Rp {{number_format($data->harga)}}</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>
