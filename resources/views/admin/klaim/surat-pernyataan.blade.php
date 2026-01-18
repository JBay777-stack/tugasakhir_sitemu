<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Surat Pernyataan</title>
<style>
    body { font-family: "Times New Roman"; font-size: 12pt; line-height: 1.6; }
    .center { text-align: center; }
    .bold { font-weight: bold; }
    table { width: 100%; margin-top: 20px; }
    td { padding: 6px; vertical-align: top; }
</style>
</head>
<body>

<h3 class="center bold">SURAT PERNYATAAN</h3>
<h4 class="center">PENGEMBALIAN BARANG</h4>

<p>
Kami yang bertanda tangan di bawah ini menyatakan bahwa barang berikut telah
diserahkan dan diterima secara sah:
</p>

<table>
<tr>
    <td width="30%">Nama Barang</td>
    <td width="5%">:</td>
    <td>{{ $item->nama_barang ?? '-' }}</td>
</tr>
<tr>
    <td>Nama Pelapor</td>
    <td>:</td>
    <td>{{ $item->nama_pelapor ?? '-' }}</td>
</tr>
<tr>
    <td>Nama Pengklaim</td>
    <td>:</td>
    <td>{{ $claim->nama_pengklaim }}</td>
</tr>
<tr>
    <td>Tanggal Pengambilan</td>
    <td>:</td>
    <td>{{ now()->translatedFormat('d F Y') }}</td>
</tr>
</table>

<p>
Dengan ini kedua belah pihak menyatakan bahwa barang telah dikembalikan
dan tidak akan ada tuntutan di kemudian hari.
</p>

<table style="margin-top:60px; text-align:center;">
<tr>
    <td>
        Yang Menyerahkan<br><br><br>
        ( ____________________ )<br>
        <b>Pelapor</b>
    </td>
    <td>
        Yang Menerima<br><br><br>
        ( ____________________ )<br>
        <b>Pengklaim</b>
    </td>
</tr>
</table>

</body>
</html>
