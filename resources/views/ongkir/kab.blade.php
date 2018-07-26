<hr>
<label for="exampleInputEmail1">Kota</label><br>
<select class='form-control' name='kota' id="kota">
	<option value=''>Pilih Kota</option>
	@foreach($city as $kota)
	<option value="{{$kota['city_id']}}">{{$kota['city_name']}}</option>
	@endforeach
</select>
<hr>
<select class="form-control" id="ekspedisi">
	<option value="">Pilih Kurir</option>
	<option value="pos">POS</option>
	<option value="tiki">TIKI</option>
	<option value="jne">JNE</option>
</select>
<script type="text/javascript">

	$(document).ready(function(){
		
		$('#ekspedisi').change(function(){

			//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax 
			var asal = $('#asal').val();
			var kab = $('#kota').val();
			var kurir = $('#ekspedisi').val();
			var berat = $('#berat').val();

			$.ajax({
				// type : 'GET',
				url : '{{ route('getTarif') }}',
				data :  {'kab_id' : kab, 'kurir' : kurir, 'asal' : asal, 'berat' : berat},
				success: function (data) {

					//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
					$("#cost").html(data);
				}
			});
		});

		
	});
</script>

