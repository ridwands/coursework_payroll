<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
    <style>
            table, th, td {
              border: 1px solid black;
            }
            </style>
</head>
<body>
    <img width="200px" height="100px" src="https://1.bp.blogspot.com/-KBPO2OTYEsY/Xgv5PTMf7NI/AAAAAAAABbE/vDmxGALTm_wE2x50ra5oTMhUYrsYMuVtACLcBGAsYHQ/s1600/Logo%2BUniversitas%2BPelita%2BBangsa.png"/>
    <p style="text-align: center">Report {{$monthName}}</p>
    <table style="width:100%">
        <tr>
            <th>NIK</th>
            <th>Salary</th>
        </tr>

        @foreach ($data as $item)
        <tr>
                <td style="text-align:center">{{$item['nik']}}</td>
        <td style="text-align:center">Rp{{number_format($item['total'])}}</td>
            </tr>

            @endforeach
    </table>
</body>
</html>