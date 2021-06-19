<?php

return [
    'product' => [
        'code' => 'Codice',
        'price' => 'Prezzo',
        'sku'   => 'SKU/Codice',
    ],

    'cart' => [
        'checkout' => 'Visualizza Carrello',
        'continue' => 'Continua',
        'confirm' => 'Conferma Dati',
        'optional' => 'optional',
        'title' => 'Il mio carrello',
        'total' => 'Totale',
        'empty' => 'Il carrello è vuoto',
        'buy' => 'Checkout',
        'show_detail' => 'mostra dettagli',
        'number_of_items' => 'Articoli',
        'with_tax' => 'Iva Incl.',
        'back' => 'Torna allo store',
        'table' => [
            'code' => 'Codice',
            'name' => 'Prodotto',
            'quantity' => 'Quantità',
            'price' => 'Prezzo',
            'total' => 'Totale',
            'actions' => 'Azioni'
        ],
        'step' => [
            'next_payment' => 'Prossimo Step: Pagamento & Spedizione',
            'next_send' => 'Prossimo Step: Acquista ',
            'next_confirm' => 'Prossimo Step: Conferma Dati ',
            'shipping_and_payment' => 'Pagamento & Spedizione',
            'edit'=>'Modifica',
            'edit_address' => 'Modifica Indirizzi',
            'edit_payment_method' => 'Modifica pagamento',
            'edit_shipping_and_payment' => 'Modifica'

        ]
    ],

    'shipping' => [
        'free_label' => 'Gratuita',
        'free' => 'Spedizione gratuita',
        'free_from' => 'Spedizione gratuita per ordini superiori a :AMOUNT',
        'method' => 'Metodo di spedizione',
        'disclaimer' => 'Consegna gratuita in Italia , 7 euro Europa,per le altre nazioni contattaci',
    ],

    'items' => [
        'add' => 'Aggiungi al carrello',
        'are_you_sure_to_remove' => 'Sei sicuro di voler rimuovere questo articolo dal carrello?',
        'remove' => 'Rimuovi dal carrello',
    ],

    'alerts' => [
        'add_success' => 'Prodotto aggiunto al carrello',
        'add_fail' => 'Impossibile aggiungere il prodotto al carrello',
        'remove_success' => 'Prodotto rimosso dal carrello',
        'remove_fail' => 'Impossibile rimuovere il prodotto dal carrello',
        'cart_invalid' => 'Carrello non valido',
        'cart_empty' => 'Il carrello è vuoto',
        'order_success' => 'Ordine inviato correttamente',
        'order_fail' => 'Impossibile inviare l\'ordine',
        'payment_fail' => 'Pagamento fallito',
        'payment_already_paid' => 'Ordine Già pagato',
        'payment_success' => 'Pagamento avvenuto con successo',
        'payment_cancel' => 'La tua richiesta di pagamento è stato annullata',
        'shipping_address_invalid' => 'Indirizzo di spedizione non valido<br> :ERROR',
    ],

    'order' => [
        'guard' => 'Per proseguire è necessario essere registrati',
        'success' => 'Ordine concluso con successo. ',
        'reference' => 'Riferimento ordine: ',
        'info' => 'Per qualsiasi informazione ci contatti inserendo nella richiesta il seguente numero ordine:',
        'number' => 'Numero d\'ordine',
        'login' => 'Login',
        'register' => 'Crea un nuovo account',
        'title' => 'Ordine',
        'date' => 'Data',
        'order' => 'Ordine',
        'back' => 'Torna al carrello',
        'resume' => 'Riepilogo prodotti',
        'addresses' => 'Indirizzi',
        'totals' => 'Riepilogo costi',
        'confirm' => 'Invia Ordine',

        'payment' => 'Modalità di pagamento',
        'billing' => 'Indirizzo di fatturazione',
        'billing_different_address' => 'L\'indirizzo di fatturazione è uguale all\'indirizzo di spedizione',
        'shipping' => 'Indirizzo di spedizione',
        'products_cost' => 'Costo dei prodotti',
        'shipping_cost' => 'Spese di spedizione',

        'registered_user' => 'Utente Registrato',
        'registered_user_login_message' => 'Effettua il login per richiamare i tuoi dati e completare più velocemente l\'acquisto.',
        'guest_checkout' => 'Checkout come ospite',
        'guest_checkout_countinue' => 'Continua come Ospite',
        'guest_checkout_message' => 'Non hai un account? Puoi passare al pagamento senza esserti registrato. Se vuoi, puoi registrarti dopo aver completato l\'ordine, così potrai usufruire delle procedure di pagamento più rapide e controllare tutti i dettagli del tuo acquisto..',
        'vat_cost' => 'Iva',
        'total_cost' => 'Totale ordine',
        'discount' => [
            'title' => 'Coupon sconto',
            'insert' => 'Hai un codice di sconto? Inseriscilo qui.',
            'valid' => 'Coupon valido: sconto %s%%',
            'invalid' => 'Questo codice non è valido.',
            'add' => 'Hai un codice di sconto?',
            'enter' => 'Inserisci codice di sconto',
            'apply' => 'Applica codice di sconto',
            'delete' => 'Elimina',
            'delete_coupon' => 'Elimina Coupon',
            'coupon_deleted' => 'Coupon rimosso dal carrello',
            'are_you_sure_to_remove' => 'Sei sicuro di voler annullare il tuo codice di sconto?'
        ]
    ],

    'payment' => [
        'title' => 'Esito del pagamento',
        'pay' => 'Paga l\'ordine',
        'method' => 'Metodo di pagamento',
        'paid' => 'Pagato',
        'unpaid' => 'Non pagato',
        'back' => 'Torna all\'ordine',
        'payment_fee' => 'Questo metodo di pagamento ha un costo aggiuntivo:'
    ],

    'address' => [
        'new' => 'Aggiungi un nuovo indirizzo',
        'fields' => [
            'street' => 'Via',
            'number' => 'Numero civico',
            'zip_code' => 'CAP',
            'city' => 'Città',
            'province' => 'Provincia',
            'country' => 'Nazione',
            'phone' => 'Telefono',
            'mobile' => 'Cellulare',
            'email' => 'Email',
            'vat' => 'Partita IVA'
        ],
        'save' => 'Salva'
    ],

    'dashboard' => [
        'orders' => 'Ordini',
        'orders_empty' => 'Non ci sono ancora ordini, vai allo shop ',
        'welcome' => 'Ciao',
        'addresses' => 'Indirizzi',
        'table' => [
            'products' => 'Prodotti',
            'total' => 'Totale',
            'payment' => 'Pagamento',
            'paid' => 'Pagato',
            'date' => 'Data'
        ]
    ],

    'paypal' => [
        'items_total' => 'Totale prodotti'
    ]
];
