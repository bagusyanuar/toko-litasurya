<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toko LitaSurya | Report</title>
    <style>
        /*@page {*/
        /*    margin: 0; !* Hapus semua margin halaman *!*/
        /*}*/

        body {
            padding: 0 0;
            font-family: 'Arial', sans-serif;
        }

        @page :after {
            content: "Page " counter(page) " / " counter(pages);
            position: fixed;
            right: 10px;
            bottom: 10px;
            font-size: 10px;
            color: #334155;
        }

        .text-dark {
            color: #0f172a;
        }

        .text-light {
            color: #334155;
        }

        .font-normal {
            font-size: 12px;
        }

        .font-large {
            font-size: 14px;
        }

        .font-small {
            font-size: 10px;
        }

        .font-bold {
            font-weight: bold;
        }

        .tb-px {
            padding-left: 5px;
            padding-right: 5px;
        }

        .tb-py {
            padding-top: 3px;
            padding-bottom: 3px;
        }

        .leading-0 {
            line-height: 0;
        }

        .leading-half {
            line-height: 0.5;
        }

    </style>
</head>
<body>
<div id="header">
    <table style="border-collapse: collapse; width: 100%; margin-bottom: 10px;">
        <tr>
            <td style="width: 80px; text-align: center; vertical-align: middle; height: 70px;">
                <img
                    src="{{ public_path('static/images/logo.png') }}"
                    alt="logo-image"
                    style="height: 60px"
                >
            </td>
            <td style="vertical-align: middle; height: 70px;">
                <div>
                    <p style="font-size: 16px; font-weight: bold; line-height: 0.5; margin-bottom: 0;"
                       class="text-dark">TOKO LITASURYA</p>
                    <p style="font-size: 12px; margin-bottom: 0; line-height: 0.3;"
                       class="text-light">Jl. Urip Sumoharjo No. 16, Wonogiri</p>
                    <p style="font-size: 12px; line-height: 0.3;" class="text-light">Telp. (0271) 626 666 | WA:
                        628967222871182</p>
                </div>
            </td>
        </tr>
    </table>
    <div style="width: 100%; border-bottom: 1px solid black; margin-bottom: 5px;"></div>
</div>
{{--report title--}}

@yield('content')
</body>
</html>
