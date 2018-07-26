@extends('layouts.app')

@section('content')
<div class="row">
	<div class="container">
		<div class="col-md-6">
			<label>Kota Asal</label><br>
			<select name="asal" id="asal" disabled="" class="form-control">
				<option value="501">Yogyakarta</option>
			</select>
			<br>
			<label for="exampleInputEmail1">Provinsi</label><br>
			<select class='form-control' name='provinsi' id="provinsi">
				<option value=''>Pilih Provinsi</option>
				@foreach($province as $prov)
				<option value="{{$prov['province_id']}}">{{$prov['province']}}</option>
				@endforeach
			</select>
			
			<div id="kabupaten">

			</div>
			<div id="cost">

			</div>
			<hr>
			<input type="text" class="form-control" name="berat" id="berat" value="1000">
			<br>
			<input type="text" class="form-control" name="harga" id="harga" value="250000">
			<br>
			<input type="text" class="form-control" name="tarif" id="tarif" value="">
			<br>
			<input type="text" class="form-control" name="total" id="total" value="">

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

			<script type="text/javascript">

				$(document).ready(function(){
					$('#provinsi').change(function(){

						var prov = $('#provinsi').val();

						$.ajax({
							url : '{{ route('getKota') }}',
							data :  'prov_id=' + prov,
							success: function (data) {

								$("#kabupaten").html(data);
							}
						});
					});
				});
			</script>
		</div>
	</div>
</div>
@endsection