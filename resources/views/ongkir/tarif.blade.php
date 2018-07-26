<br>
<ul class="list-group">
    <li class="list-group-item">
        @if(count($tariff))
        @foreach($tariff as $tarif)
        @if(count($tarif['costs']) > 0)
        @foreach($tarif['costs'] as $cost)
        <div class="panel panel-default">
            <div class="panel-body">
                {{$tarif['name'].' - '.$cost['service'].' / '.$cost['description']}}
                <div class="radio">
                    <label>
                        <input type="radio" name="tarif" onclick="cekTarif(this.value)"  class="tarif" value="{{$tarif['code'].'-'.$cost['service'].'-'.$cost['cost'][0]['value']}}">
                        Rp. {{ number_format($cost['cost'][0]['value'], 0, ",", ".") }}
                    </label>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="panel panel-default">
            <div class="panel-body">
                Tarif Pengiriman Tidak diketemukan.
            </div>
        </div>
        @endif
        @endforeach
        @else
        Coba beberapa saat lagi
        @endif
    </li>
</ul><br>
<script type="text/javascript">
    $(document).ready(function() {
        // var trf= $('#tarif').val();
        var tarif = document.getElementsByName('tarif');
        $('#tarif').click(function(e) {
            alert(tarif);
        });
    });

    function cekTarif(trf) {
        // body...
        var harga = $('#harga').val();
        split = trf.split('-');
        total = parseInt(harga) + parseInt(split[2]);
        document.getElementById("tarif").value=split[2];
        document.getElementById("total").value=total;
    }
</script>

