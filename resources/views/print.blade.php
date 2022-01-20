<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Test</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
      background-color: #F0F0F0;
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

    .row {
      /* display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      grid-auto-rows: 50px;
      grid-gap: 20px;
      */
      height: 210mm;
      page-break-after: always;
    }

    @page {
      /* width: 412mm;
      height: 210mm; */
      width: 330mm;
      height: 210mm;
      /* margin-top: 1.5mm;
      margin-bottom: 1.5mm;
      margin-left: 1.5mm;
      margin-right: 1.5mm; */
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

      body {
        /* width: 330mm;
      height: 210mm; */
        /* width: 100%; */
        /* height: 21cm; */
        /* margin-top: 1.5mm;
      margin-bottom: 1.5mm;
      margin-left: 1.5mm;
      margin-right: 1.5mm; */
      }

      .container-fluid {
        padding: 1.5mm;
        background-color: #F0F0F0;
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
        /* display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      grid-auto-rows: 50px;
      grid-gap: 20px;
      height: 25.6cm;
      */
        height: 210mm;
        page-break-after: always;
      }

      @page {
        /* width: 412mm;
      height: 210mm; */
        width: 330mm;
        height: 210mm;
        /* margin-top: 1.5mm;
      margin-bottom: 1.5mm;
      margin-left: 1.5mm;
      margin-right: 1.5mm; */
      }
    }
  </style>

</head>

<body>
  <div class="container-fluid">
    <div class="row g-2">
      <div class="col-3">
        <table class="table table-sm table-bordered table-nota">
          <colgroup>
            <col style="width: 30px;" />
            <col style="width: 160px;" />
            <col style="width: 37px;" />
            <col style="width: 38px;" />
          </colgroup>
          <thead>
          </thead>
          <tbody>
            <tr>
              <td>999</td>
              <td colspan="2">PUKIS</td>
              <td rowspan="2">99/99/2022</td>
            </tr>
            <tr>
              <td colspan="2">P Yanto</td>
              <td>9999</td>
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
            <tr>
              <td>999</td>
              <td style="text-align: left;">P Aji</td>
              <td>999</td>
              <td>999</td>
              <td>999</td>
              <td>9.999.999</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>

          </tbody>
        </table>
        <table class="table table-sm table-bordered table-nota">
        <colgroup>
            <col style="width: 68px;" />
            <col style="width: 50px;" />
            <col style="width: 35px;" />
            <col style="width: 35px;" />
            <col style="width: 35px;" />
          </colgroup>
          <thead>
          </thead>
          <tbody>
            <tr>
              <td>LAKU</td>
              <td>100%</td>
              <td>999</td>
              <td>999</td>
              <td>999</td>
              <td>5.555.555</td>
            </tr>
          </tbody>
        </table>
        <table class="table table-sm table-bordered table-nota table-hasil">
          <thead>
          </thead>
          <tbody>
            <tr>
              <td style="width: 30px;">Total</td>
              <td colspan="2">Rp.5.555.555</td>
              <td colspan="2">lain-lain</td>
              <td></td>
            </tr>
            <tr>
              <td colspan="2">Kas</td>
              <td>-1000</td>
              <td style="width: 30px;">jadi</td>
              <td colspan="2">Rp.5.555.555</td>
            </tr>
            <tr>
              <td colspan="2">Kemarin</td>
              <td>-0</td>
              <td colspan="2">Dibulatkan</td>
              <td>+1000</td>
            </tr>
            <tr>
              <td colspan="3">Uang Hari Ini</td>
              <td colspan="3">Rp.5.555.555</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-3">
        <table class="table table-sm table-bordered table-nota">
          <colgroup>
            <col style="width: 30px;" />
            <col style="width: 160px;" />
            <col style="width: 37px;" />
            <col style="width: 38px;" />
          </colgroup>
          <thead>
          </thead>
          <tbody>
            <tr>
              <td>999</td>
              <td colspan="2">PUKIS</td>
              <td rowspan="2">99/99/2022</td>
            </tr>
            <tr>
              <td colspan="2">P Yanto</td>
              <td>9999</td>
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
            <tr>
              <td>999</td>
              <td style="text-align: left;">P Aji</td>
              <td>999</td>
              <td>999</td>
              <td>999</td>
              <td>9.999.999</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>

          </tbody>
        </table>
        <table class="table table-sm table-bordered table-nota">
        <colgroup>
            <col style="width: 68px;" />
            <col style="width: 50px;" />
            <col style="width: 35px;" />
            <col style="width: 35px;" />
            <col style="width: 35px;" />
          </colgroup>
          <thead>
          </thead>
          <tbody>
            <tr>
              <td>LAKU</td>
              <td>100%</td>
              <td>999</td>
              <td>999</td>
              <td>999</td>
              <td>5.555.555</td>
            </tr>
          </tbody>
        </table>
        <table class="table table-sm table-bordered table-nota table-hasil">
          <thead>
          </thead>
          <tbody>
            <tr>
              <td style="width: 30px;">Total</td>
              <td colspan="2">Rp.5.555.555</td>
              <td colspan="2">lain-lain</td>
              <td></td>
            </tr>
            <tr>
              <td colspan="2">Kas</td>
              <td>-1000</td>
              <td style="width: 30px;">jadi</td>
              <td colspan="2">Rp.5.555.555</td>
            </tr>
            <tr>
              <td colspan="2">Kemarin</td>
              <td>-0</td>
              <td colspan="2">Dibulatkan</td>
              <td>+1000</td>
            </tr>
            <tr>
              <td colspan="3">Uang Hari Ini</td>
              <td colspan="3">Rp.5.555.555</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-3">
        <table class="table table-sm table-bordered table-nota">
          <colgroup>
            <col style="width: 30px;" />
            <col style="width: 160px;" />
            <col style="width: 37px;" />
            <col style="width: 38px;" />
          </colgroup>
          <thead>
          </thead>
          <tbody>
            <tr>
              <td>999</td>
              <td colspan="2">PUKIS</td>
              <td rowspan="2">99/99/2022</td>
            </tr>
            <tr>
              <td colspan="2">P Yanto</td>
              <td>9999</td>
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
            <tr>
              <td>999</td>
              <td style="text-align: left;">P Aji</td>
              <td>999</td>
              <td>999</td>
              <td>999</td>
              <td>9.999.999</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>

          </tbody>
        </table>
        <table class="table table-sm table-bordered table-nota">
        <colgroup>
            <col style="width: 68px;" />
            <col style="width: 50px;" />
            <col style="width: 35px;" />
            <col style="width: 35px;" />
            <col style="width: 35px;" />
          </colgroup>
          <thead>
          </thead>
          <tbody>
            <tr>
              <td>LAKU</td>
              <td>100%</td>
              <td>999</td>
              <td>999</td>
              <td>999</td>
              <td>5.555.555</td>
            </tr>
          </tbody>
        </table>
        <table class="table table-sm table-bordered table-nota table-hasil">
          <thead>
          </thead>
          <tbody>
            <tr>
              <td style="width: 30px;">Total</td>
              <td colspan="2">Rp.5.555.555</td>
              <td colspan="2">lain-lain</td>
              <td></td>
            </tr>
            <tr>
              <td colspan="2">Kas</td>
              <td>-1000</td>
              <td style="width: 30px;">jadi</td>
              <td colspan="2">Rp.5.555.555</td>
            </tr>
            <tr>
              <td colspan="2">Kemarin</td>
              <td>-0</td>
              <td colspan="2">Dibulatkan</td>
              <td>+1000</td>
            </tr>
            <tr>
              <td colspan="3">Uang Hari Ini</td>
              <td colspan="3">Rp.5.555.555</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-3">
        <table class="table table-sm table-bordered table-nota">
          <colgroup>
            <col style="width: 30px;" />
            <col style="width: 160px;" />
            <col style="width: 37px;" />
            <col style="width: 38px;" />
          </colgroup>
          <thead>
          </thead>
          <tbody>
            <tr>
              <td>999</td>
              <td colspan="2">PUKIS</td>
              <td rowspan="2">99/99/2022</td>
            </tr>
            <tr>
              <td colspan="2">P Yanto</td>
              <td>9999</td>
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
            <tr>
              <td>999</td>
              <td style="text-align: left;">P Aji</td>
              <td>999</td>
              <td>999</td>
              <td>999</td>
              <td>9.999.999</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>
            <tr>
              <td>1</td>
              <td style="text-align: left;">P Aji</td>
              <td>7</td>
              <td>5</td>
              <td>2</td>
              <td>1600</td>
            </tr>

          </tbody>
        </table>
        <table class="table table-sm table-bordered table-nota">
        <colgroup>
            <col style="width: 68px;" />
            <col style="width: 50px;" />
            <col style="width: 35px;" />
            <col style="width: 35px;" />
            <col style="width: 35px;" />
          </colgroup>
          <thead>
          </thead>
          <tbody>
            <tr>
              <td>LAKU</td>
              <td>100%</td>
              <td>999</td>
              <td>999</td>
              <td>999</td>
              <td>5.555.555</td>
            </tr>
          </tbody>
        </table>
        <table class="table table-sm table-bordered table-nota table-hasil">
          <thead>
          </thead>
          <tbody>
            <tr>
              <td style="width: 30px;">Total</td>
              <td colspan="2">Rp.5.555.555</td>
              <td colspan="2">lain-lain</td>
              <td></td>
            </tr>
            <tr>
              <td colspan="2">Kas</td>
              <td>-1000</td>
              <td style="width: 30px;">jadi</td>
              <td colspan="2">Rp.5.555.555</td>
            </tr>
            <tr>
              <td colspan="2">Kemarin</td>
              <td>-0</td>
              <td colspan="2">Dibulatkan</td>
              <td>+1000</td>
            </tr>
            <tr>
              <td colspan="3">Uang Hari Ini</td>
              <td colspan="3">Rp.5.555.555</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <script>
  </script>
</body>

</html>
