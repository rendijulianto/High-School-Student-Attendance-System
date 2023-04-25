<!DOCTYPE html>
<html>
<head>
	<title>
        Registrasi Akun Guru
    </title>
	<style type="text/css">
		table {
			border-style: double;
			border-width: 3px;
			border-color: white;
		}
		table tr .text2 {
			text-align: right;
			font-size: 13px;
		}
		table tr .text {
			text-align: center;
			font-size: 13px;
		}
		table tr td {
			font-size: 13px;
		}

	</style>
</head>
<body>
	<center>
		<table>
			<tr>
				<td><img src="https://sekolahpedia.id/medias/logosekolah/SMKS%20PASUNDAN%202%20BANDUNG.png" width="90" height="90"></td>
				<td>
				<center>
					<font size="5"><b>SMK PASUNDAN 2 BANDUNG</b></font><br>
					<font size="2">Bidang Keahlian : Bisnis dan Menejemen - Teknologi informasi dan Komunikasi</font><br>
					<font size="2"><i>Jln Maleber No. 02 Kode Pos : 68173 Telp./Fax (0331)758005 Tempurejo Jember Jawa Barat</i></font>
				</center>
				</td>
			</tr>
			<tr>
				<td colspan="2"><hr></td>
			</tr>
		<table width="625">
			<tr>
				<td class="text2">Bandung, {{ date('d-m-Y') }}</td>
			</tr>
		</table>
		</table>
		<table>
			<tr class="text2">
				<td>Nomer</td>
				<td width="572">: -</td>
			</tr>
			<tr>
				<td>Perihal</td>
				<td width="564">: Pembuatan Akun Guru</td>
			</tr>
		</table>
		<br>
		<table width="625">
			<tr>
		       <td>
			       <font size="2">Kpd yth.<br> {{ $teacher->gender == 'L' ? 'Bapak' : 'Ibu' }} <b>{{ $teacher->name }}</b><br>Di tempat</font>
		       </td>
		    </tr>
		</table>
		<br>
		<table width="625">
			<tr>
		       <td>
			       <font size="2">Assalamu'alaikum wr.wb<br>
                    Dengan ini, memberitahukan bahwa akun guru anda telah dibuat oleh admin. Berikut adalah data akun anda :
		       </td>
		    </tr>
		</table>
		<br>
		</table>
		<table>
            <tr class="text2">
				<td>NIP </td>
				<td width="541">: {{ $teacher->nip > 0 ? $teacher->nip : '-' }}</td>
			</tr>
			<tr class="text2">
				<td>Nama </td>
				<td width="541">: {{ $teacher->name }}</td>
			</tr>
			<tr>
				<td>Email</td>
				<td width="525">: <b>{{ $teacher->email }}</b> </td>
			</tr>
			<tr>
				<td>Password</td>
				<td width="525">: <b>{{ $password }}</b> </td>
			</tr>
		</table>
		<br>
		<table width="625">
			<tr>
		       <td>
			       <font size="2">Diharapkan untuk segera mengganti password anda setelah login. Terima kasih atas perhatiannya.<br>
                    Wassalamu'alaikum wr.wb
</font>
		       </td>
		    </tr>
		</table>
		<br>

	</center>
</body>
</html>
