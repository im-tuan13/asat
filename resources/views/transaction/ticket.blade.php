<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Ticket #{{ $transaction->no_tiket }}</title>
  <style>
    body {
      font-family: 'Courier New', Courier, monospace;
      font-size: 14px;
      color: #000;
      margin: 0;
      padding: 0;
      text-align: center;
    }
    .ticket-container {
      width: 320px;
      margin: 20px auto;
      padding: 15px;
      border: 1px dashed #000;
    }
    .header {
      font-weight: bold;
      font-size: 16px;
      margin-bottom: 2px;
    }
    .address {
      font-size: 10px;
      margin-bottom: 15px;
      line-height: 1.2;
    }
    .divider {
      border-top: 1px dashed #000;
      margin: 10px 0;
    }
    .title {
      font-weight: bold;
      font-size: 15px;
      margin-bottom: 5px;
    }
    .location {
      font-size: 16px;
      font-weight: bold;
      margin-top: 5px;
    }
    .vehicle {
      font-size: 16px;
      font-weight: bold;
      margin-bottom: 15px;
    }
    .details {
      text-align: left;
      font-size: 12px;
      margin: 15px 0;
      line-height: 1.4;
    }
    .footer-msg {
      font-size: 9px;
      margin-top: 20px;
      font-weight: bold;
      line-height: 1.3;
    }
  </style>
</head>
<body>
  <div class="ticket-container">
    <div class="header">SIJA PARKING</div>
    <div class="address">
      Jl. Raya Karadenan No. 7, Karadenan,<br>
      Kec. Cibinong, Kabupaten Bogor, Jawa Barat 16111
    </div>
    
    <div class="divider"></div>
    
    <div class="title">TIKET PARKIR</div>
    <div class="location">{{ $transaction->location->location_name }}</div>
    <div class="vehicle">
      @if($transaction->vehicleType->jenis === 'motorcycle')
        Motor
      @elseif($transaction->vehicleType->jenis === 'car')
        Mobil
      @else
        Truck/Bus/Lainnya
      @endif
    </div>
    
    <div class="divider"></div>
    
    <div class="details">
      <div><strong>No Tiket :</strong> {{ $transaction->no_tiket }}</div>
      <div><strong>Tanggal  :</strong> {{ $transaction->masuk->format('Y-m-d H:i:s') }}</div>
    </div>
    
    <div class="divider"></div>
    
    <div class="footer-msg">
      JANGAN MENINGGALKAN TIKET DAN BARANG BERHARGA DI DALAM KENDARAAN
    </div>
  </div>
</body>
</html>
