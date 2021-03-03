@extends('website.app')
@section('content')

    <main class="main-cart">
        <div class="container">
            <h1 class="text-primary">Esito dell'ordine</h1>

            <div class="border p-4">


                <div class="h3 text-primary">Ordine concluso con successo #<span class="text-accent">{{$order->order_reference}}</span></div>
                @if ( $payment->payment_method_id == 1)
                    <p>
                        Grazie per aver ordinato, all'interno del profilo utente sarà possibile visionare lo stato dell'ordine.
                       </p>
                @endif
                @if ( $payment->payment_method_id == 2)
                    <p>
                        Grazie per aver ordinato, di seguito sono indicate le coordinate bancarie necessario per effettuare il bonifico bancario.<br>
                        Per velocizzare i tempi di consegna una volta effettuato il bonifico chiediamo gentilmente di:
                    <ul class="mt-2">
                        <li>inviare copia della ricevuta via mail all'indirizzo <a class="text-primary" href="mailto:info@magutti.com">info@magutti.com</a></li>
                        <li>Indicare nella causale il seguente codice ordine <span class="text-accent">{{$order->order_reference}}</span></li>
                    </ul>
                    </p>
                    <hr>
                    <div class="my-2">
                        <span class="font-weight-bold">Intestatario:</span> xxxxxxxxx<br>
                        <span class="font-weight-bold">IBAN:</span> xxxxxx<br>
                        <span class="font-weight-bold">BIC/SWIFT:</span> xxxxxxx<br>
                        <span class="font-weight-bold">Istituto Bancario:</span> xxxxx
                    </div>
                @endif
                @if ( $payment->payment_method_id == 3)
                    <p>
                        Grazie per aver ordinato,
                        <br>Pagerai In contrassegno al ricevimento della merce.

                @endif

                <p>
                       Per qualsiasi informazione ci contatti inserendo nella richiesta il seguente numero ordine: <span class="text-accent">{{$order->order_reference}}</span>
                </p>


            </div>

            @include('flash::notification')

        </div>
    </main>

@endsection
