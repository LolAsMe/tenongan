<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        * {
            font-size: 13px;
            color: #000;
            font-family: Arial;

            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {

            /* width: 100%; */
            /* height: 21cm; */
            /* margin-top: 1.5mm;
      margin-bottom: 1.5mm;
      margin-left: 1.5mm;
      margin-right: 1.5mm; */
        }

        .container-fluid {
            padding: 1.5mm;
            width: 330mm;
        }

        .table-nota {
            margin-bottom: 1mm;
            table-layout: fixed;
            width: 303.5px;
        }

        .table-nota td {
            overflow: hidden;
            word-wrap: break-word;
        }

        .table-penjualan td {
            margin: 0mm;
            padding: 0mm;
            text-align: center;
        }

        .table-hasil td {
            margin: 0mm;
            padding: 0mm;
        }

        .pagebreak {
            clear: both;
            page-break-after: always;
        }

        .row {
            /* display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      grid-auto-rows: 50px;
      grid-gap: 20px;
      */
            /* height: 210mm; */
            /* page-break-after: always; */
        }

        .page-break {
            page-break-after: always;
        }

        @page {
            width: 330mm;
            height: 210mm;
        }

        .col-3 {
            height: 100%;
            background-color: #ffffff;
            margin-bottom: 20mm
                /* page-break-after: always; */
        }


        @media print {
            * {
                font-size: 13px;
                color: #000;
                font-family: Arial;

                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            .container-fluid {
                padding: 1.5mm;
                background-color: #ffffff;
                width: 330mm;
            }

            .table-nota {
                margin-bottom: 1mm;
                table-layout: fixed;
                width: 303.5px;
            }

            .table-nota td {
                overflow: hidden;
            }

            .table-penjualan td {
                margin: 0mm;
                padding: 0mm;
            }

            .table-hasil td {
                margin: 0mm;
                padding: 0mm;
            }

            .row {
                /* height: 210mm; */
                /* page-break-after: always; */
            }

            .col-3 {
                height: 186.3mm;
                /* page-break-after: always; */
                /* background-color: #8f6767 */
            }

            @page {
                width: 330mm;
                height: 210mm;
            }

            .page-break {
                page-break-after: always;
            }

            .pagebreak {
                clear: both;
                page-break-after: always;
            }
        }

    </style>

</head>

<body>
    <div class="container-fluid">
        @php
            $index = 0;
        @endphp
        <div class="row g-2">
            @foreach ($transaksis as $key => $transaksi)
                @php
                    $totalBayar = 0;
                    $jadi = 0;
                @endphp
                @foreach ($transaksi->owner->produk as $produk)
                    @php
                        $persen = '0%';
                        $jumlahTitip = 0;
                        $jumlahSisa = 0;
                        $jumlahLaku = 0;
                        $index++;
                    @endphp
                    <div class="col-3 page-break">
                        <table class="table table-sm table-bordered table-nota">
                            <colgroup>
                                <col style="width: 30px;" />
                                <col style="width: 150px;" />
                                <col style="width: 37px;" />
                                <col style="width: 38px;" />
                            </colgroup>
                            <thead>
                            </thead>
                            <tbody>
                                  <tr>
                                    <td>{{ $produk->id }}</td>
                                    <td colspan="2">{{ $produk->nama }}</td>
                                    <td rowspan="2">{{ now()->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">{{ $transaksi->owner->nama }}</td>
                                    <td>{{ Helper::numerize($produk->harga_beli) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered table-nota table-penjualan">
                            <colgroup>
                                <col style="width: 29px;" />
                                <col style="width: 100px;" />
                                <col style="width: 27px;" />
                                <col style="width: 27px;" />
                                <col style="width: 30px;" />
                            </colgroup>
                            <thead>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>NO</td>
                                    <td>NAMA</td>
                                    <td>Titip</td>
                                    <td>Sisa</td>
                                    <td>Laku</td>
                                    <td>BAYAR</td>
                                </tr>
                                @foreach ($produk->penjualan as $data)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td style="text-align: left;">{{ $data->pedagang->nama }}</td>
                                        <td>{{ $data->titip }}</td>
                                        <td>{{ $data->titip - $data->laku }}</td>
                                        <td>{{ $data->laku }}</td>
                                        <td>{{ Helper::numerize($data->laku * $data->harga_beli) }}</td>
                                    </tr>
                                    @php
                                        $jumlahTitip += $data->titip;
                                        $jumlahLaku += $data->laku;
                                    @endphp
                                @endforeach

                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered table-nota">
                            <colgroup>
                                <col style="width: 60px;" />
                                <col style="width: 60px;" />
                                <col style="width: 30px;" />
                                <col style="width: 30px ;" />
                                <col style="width: 30px;" />
                            </colgroup>
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>LAKU</td>
                                    <td style="text-align: center">{{ intdiv($jumlahLaku * 100, $jumlahTitip) }}%
                                    </td>
                                    <td style="text-align: center">{{ $jumlahTitip }}</td>
                                    <td style="text-align: center">{{ $jumlahTitip - $jumlahLaku }}</td>
                                    <td style="text-align: center">{{ $jumlahLaku }}</td>
                                    <td style="text-align: center">
                                        {{ Helper::numerize($jumlahLaku * $produk->harga_beli) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered table-nota table-hasil">
                            <colgroup>
                                <col style="width: 60px;" />
                                <col style="width: 80px;" />
                                <col style="width: 65px;" />
                            </colgroup>
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>bayar</td>
                                    <td>Rp.{{ Helper::numerize($transaksi->penjualan->get('bayar')) }}
                                    </td>
                                    <td>lain-lain</td>
                                    <td>Rp.{{ Helper::numerize($transaksi->penjualan->get('lain')) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kas</td>
                                    <td>- {{ Helper::numerize($transaksi->kas->jumlah) }}</td>
                                    <td>jadi</td>
                                    <td>
                                        Rp.{{ Helper::numerize($transaksi->penjualan->get('lain') + $transaksi->penjualan->get('bayar') - $transaksi->kas->jumlah) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kemarin</td>
                                    <td>- {{ Helper::numerize($transaksi->kemarin) }}</td>
                                    <td>Dibulatkan</td>
                                    <td>+ {{ Helper::numerize($transaksi->pembulatan) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Uang Hari Ini</td>
                                    <td colspan="2">Rp. {{ Helper::numerize($transaksi->jumlah) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>


    <script>
    </script>
</body>

</html>
