@extends('emails.master.html')
@section('content')
    Ciao Angelo Marco Asperti,
    <h5>Riepilogo ordine #1234546789</h5>
    Data ordine: 31/12/2020
    <table  class="" border="0" cellpadding="2" cellspacing="0" width="570px">
        <tbody>
        <tr>
            <td width="45%">
                da:Simon Hass
                Baristoteles<br>
                Codice Cliente: 00006547<br>
                Huelsbergstraße, 63d<br>
                44797, Bochum<br>
                Germany<br>
                simon@baristoteles.de<br>
                Tel.: 01753262221<br>
                P. IVA: DE2895006784<br>
            </td>
            <td width="10%"></td>
            <td width="45%">
                Indirizzo di consegna:
                Codice:06547
                BARISTOTELES
                HUELSBERGSTRASSE 63D,
                44797, BOCHUM
                Germany
                Riferimento Ordine:
                Note:
            </td>
        </tr>
        </tbody>
    </table>

    <table  class="" border="1" cellpadding="2" cellspacing="0" width="570px">
        <thead>
        <tr>
            <th>Codice</th>
            <th>Descrizione</th>
            <th width="80px" class="text-center" align="center">Quantità</th>
            <th class="text-center">Prezzo</th>
            <th class="text-center">Prezzo Totale</th>
        </tr>
        </thead>
        <tbody>
        <tr id="table_row_372676">
            <td> 506725</td>
            <td> FAEMINA DICHTUNG KIT</td>
            <td class="text-center" width="80px" align="center">1</td>
            <td class="text-right"><span class="item-price">11,00</span></td>
            <td class="text-right"><span id="item_total_price_372676" class="item-total-price">11,00</span></td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td id="cart-big-total" colspan="9" align="right">Totale Ordine: € 11,00</td>
        </tr>
        </tfoot>
    </table>
@endsection
