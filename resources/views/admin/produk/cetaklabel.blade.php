<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cetak Label</title>
<style>

</style>

  </head>
  <body>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Barcode</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barcodes as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['produk'] }}</td>
                    <td>{{ $item['harga'] }}</td>
                    <td>{!! $item['barcode'] !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </body>
</html>