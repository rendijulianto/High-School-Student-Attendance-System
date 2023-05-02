<!DOCTYPE html>
<html>
    <head>
        <title>Surat Konfirmasi Kehadiran</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            }
            h1 {
                text-align: center;
                margin-top: 0;
            }
            p {
                margin-bottom: 20px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }
            th,
            td {
                padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ccc;
            }
            .btn {
                display: inline-block;
                padding: 10px 20px;
                background-color: #4caf50;
                color: #fff;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            .btn:hover {
                background-color: #3e8e41;
            }
            .btn.danger {
                background-color: #f44336;
            }
            .btn.danger:hover {
                background-color: #da190b;
            }

        </style>
    </head>
    <body>
        <div class="container">
            <h1>Surat Konfirmasi Kehadiran</h1>
            <p>Kepada Yth,</p>
            <p>Nama: {{$student->name}}</p>
            <p>NIS: {{$student->nis}}</p>
            <p>Assalamu'alaikum Wr. Wb.</p>
            <p>Dengan hormat,</p>
            <p>
                Berdasarkan hasil absensi yang telah diambil, kami konfirmasi
                bahwa Anda telah hadir dalam pelajaran dengan rincian sebagai
                berikut:
            </p>
            <table>
                <tr>
                    <th>Nama Mata Pelajaran</th>
                    <td>{{$presence->schedule->teach->subject->name}}</td>
                </tr>
                <tr>
                    <th>Materi</th>
                    <td>{{$presence->material}}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>{{$presence->date}}</td>
                </tr>
            </table>
            <p>
                Apabila terdapat ketidaksesuaian data kehadiran, mohon segera
                hubungi pengajar terkait.
            </p>
            <p>
                Demikian surat ini kami sampaikan. Terima kasih atas
                perhatiannya.
            </p>
            <p>Wassalamu'alaikum Wr. Wb.</p>
            <button class="btn" type="submit" name="konfirmasi" value="benar">
                Konfirmasi Benar
            </button>
            <button class="btn danger" type="submit" name="konfirmasi" value="salah">
                Konfirmasi Salah
            </button>
        </div>
    </body>
</html>
