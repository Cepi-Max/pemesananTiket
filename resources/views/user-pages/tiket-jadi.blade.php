<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tiket Pesawat</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #ffffff; padding: 20px;">

    <div style="max-width: 600px; margin: 0 auto; border: 1px solid #c3dafe; border-radius: 12px; padding: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <!-- Logo & Maskapai -->
            <div style="display: flex; align-items: center;">
                <img src="{{ asset('path-to-your-logo') }}" alt="Logo Maskapai" style="width: 64px; height: auto; margin-right: 12px;">
                <div>
                    <h2 style="font-size: 20px; font-weight: bold; color: #1d4ed8; margin: 0;">
                        {{ $pesanan->penerbangan->pesawat->maskapai->nama }}
                    </h2>
                    <p style="font-size: 12px; color: #4b5563; margin: 0;">
                        {{ $pesanan->penerbangan->kode_penerbangan }}
                    </p>
                </div>
            </div>
            <div style="text-align: right;">
                <p style="font-size: 12px; color: #6b7280; margin: 0;">Kode Booking:</p>
                <p style="font-size: 16px; font-weight: bold; color: #1e40af; margin: 0;">
                    {{ $pesanan->kode_booking }}
                </p>
            </div>
        </div>

        <hr style="margin: 20px 0; border: 1px solid #c3dafe;" />

        <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 20px;">
            <!-- Penumpang -->
            <div style="width: 45%;">
                <p style="font-size: 12px; color: #6b7280; margin: 0;">Nama Penumpang</p>
                <p style="font-size: 16px; font-weight: bold; color: #1e40af; margin: 0;">
                    @foreach ($pesanan->detailPenumpangs as $penumpang)
                        {{ $penumpang->nama_penumpang }}<br>
                    @endforeach
                </p>
            </div>

            <!-- Tanggal -->
            <div style="width: 45%;">
                <p style="font-size: 12px; color: #6b7280; margin: 0;">Tanggal Penerbangan</p>
                <p style="font-size: 16px; font-weight: bold; color: #1e40af; margin: 0;">
                    {{ \Carbon\Carbon::parse($pesanan->penerbangan->tanggal_penerbangan)->format('d M Y') }}
                </p>
            </div>

            <!-- Kota Asal -->
            <div style="width: 45%;">
                <p style="font-size: 12px; color: #6b7280; margin: 0;">Kota Asal</p>
                <p style="font-size: 16px; font-weight: bold; color: #1e40af; margin: 0;">
                    {{ $pesanan->penerbangan->bandaraAsal->nama_kota }} {{ $pesanan->penerbangan->bandaraAsal->slug }}
                </p>
            </div>

            <!-- Kota Tujuan -->
            <div style="width: 45%;">
                <p style="font-size: 12px; color: #6b7280; margin: 0;">Kota Tujuan</p>
                <p style="font-size: 16px; font-weight: bold; color: #1e40af; margin: 0;">
                    {{ $pesanan->penerbangan->bandaraTujuan->nama_kota }} {{ $pesanan->penerbangan->bandaraTujuan->slug }}
                </p>
            </div>

            <!-- Bandara Asal -->
            <div style="width: 45%;">
                <p style="font-size: 12px; color: #6b7280; margin: 0;">Bandara Keberangkatan</p>
                <p style="font-size: 16px; font-weight: bold; color: #1e40af; margin: 0;">
                    {{ $pesanan->penerbangan->bandaraAsal->kota->nama_kota }}
                </p>
            </div>

            <!-- Bandara Tujuan -->
            <div style="width: 45%;">
                <p style="font-size: 12px; color: #6b7280; margin: 0;">Bandara Kedatangan</p>
                <p style="font-size: 16px; font-weight: bold; color: #1e40af; margin: 0;">
                    {{ $pesanan->penerbangan->bandaraTujuan->nama_bandara }}
                </p>
            </div>
        </div>

        <hr style="margin: 20px 0; border: 1px solid #c3dafe;" />

        <div style="display: flex; justify-content: space-between; align-items: center;">
            <p style="font-size: 12px; color: #6b7280; margin: 0;">
                Harap tiba di bandara 90 menit sebelum keberangkatan.
            </p>
            <p style="font-size: 14px; font-weight: bold; color: #1d4ed8; margin: 0;">
                Tiket Telah Dibayar
            </p>
        </div>
    </div>

    <!-- Tombol Export PDF -->
<div style="text-align: center; margin-top: 24px;">
    <form method="POST" action="{{ route('download.tiket') }}">
        @csrf
        <input type="hidden" name="kode_booking" value="{{ $pesanan->kode_booking }}">
        <button
            type="submit"
            style="background-color: #2563eb; color: white; padding: 12px 24px; border: none; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); cursor: pointer;"
        >
            Download Tiket PDF
        </button>
    </form>
</div>

</body>
</html>
