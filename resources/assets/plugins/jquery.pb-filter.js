// PB filter
// mostra o nasconde elemnti del dom mentre digiti
//
// UTILIZZO:
// 1.	Associare la classe "filter-group" al contenitore di un gruppo di input o select
// 2.	Allo stesso elemento associare l'attributo "data-filter" contenente il selettore jquery degli elementi del dom che si desidera filtrare
// 3.	Associare ad ogni input o select una delle seguenti classi:
// 			filter			-	Filtro per valore esatto
// 			filter-like		-	Filtro per somiglianza (come %like%)
// 			filter-checked	-	Filtro per checkbox
// 			filter-limit	-	Filtro per tutti i valori superiori o inferiori a una soglia
// 		Gli input con "filter-limit" necessitano anche del'attributo "data-limit" con valore "min" o "max" a seconda se si vuole filtrare per valori superiori o inferiori al valore inserito, rispettivamente
// 		Ogni input deve avere anche l'attributo "name".
// 4.	Facoltativo - se l'operazione richiesta dal filtro non è un "and" ma un "or", è sufficiente aggiungere l'attributo "data-filter-operation" con valore "or"
// 4.	Se vengono utilizzati i filter e i filter-checked, gli elementi del dom che devono essere filtrati devono avere una serie di classi formattate come segue: [nome filtro]-[valore filtro].
//	 	Ad esempio, se la select ha name="user" e option con valori 1, 2 e 3, un elemento associato all'utente 2 avrà la classe "user-2"
//	 	Se vengono utilizzati i filter-like e i filter-limit, gli elementi del dom che devono essere filtrati devono avere un data attribute formattato come segue: data-[nome filtro]="[valore-filtro]".
//	 	Ad esempio, se l'input ha name="description", ogni elemento dovrà avere un attributo data-description contenente il testo nel quale si vuole cercare la descrizione digitata dall'utente.
//	 	I filter limit funzionano in modo analogo, ma accettano solo valori numerici.
// 5.	Associare ad un elemento che funge da "invio" la classe "filter-button"
// 6.	Facoltativo - un elemento con la classe "filter-reset" causa la pulizia di tutti i filtri, se premuto
//
// Quando il filtro viene avviato, per la pressione del controllo dedicato o perché vengono cambiati i valori nei campi di input, il sistema nasconde tutti gli elementi e mostra solo quelli che rispondono ai valori inseriti dall'utente

//	costanti di configurazione
var GROUPS			= ".filter-group",
	FILTERS			= ".filter",
	FILTER_LIKE		= ".filter-like",
	FILTER_CHECKED	= ".filter-checked",
	FILTER_LIMIT	= ".filter-limit",
	BUTTONS			= ".filter-button",
	RESETS			= ".filter-reset";

function init_filters() {
	//	recupero i gruppi
	$(GROUPS).each(function() {
		var elem = $(this);
		//	recupero il selettore degli elementi da filtrare
		var target = elem.data("filter");
		//	trovo il pulsante che attiva il filtro
		var button = elem.find(BUTTONS);
		//	trovo il pulsante che reimposta il filtro
		var reset = elem.find(RESETS);
		//	evento click
		button.click(function(e) {
			e.preventDefault();

			var classes = "";
			var classes_or = [];

			//	costruisco una lista di classi da filtrare
			elem.find(FILTERS).each(function() {
				if ($(this).val() != "")
					if ($(this).data('filter-operation') == 'or')
						classes_or[classes_or.length] = "." + $(this).val();
					else
						classes += "." + $(this).val();
			});

			elem.find(FILTER_CHECKED).each(function() {
				if ($(this).is(':checked')) {
					if ($(this).data('filter-operation') == 'or')
						classes_or[classes_or.length] = "." + $(this).val();
					else
						classes += "." + $(this).val();
				}
			});

			//	nascondo tutti gli elementi e mostro le classi trovate
			if (classes || classes_or.length) {
				$(target).addClass('hidden');
				if (classes_or.length)
					$.each(classes_or, function(k,v) {
						$(target + classes + v).removeClass('hidden');
						console.log(target + classes + v);
					});
				else
					$(target + classes).removeClass('hidden');
			}
			else {
				$(target).removeClass('hidden');
			}

			//	filtro ulteriormente per i filtri limite
			elem.find(FILTER_LIMIT).each(function() {
				var filter = $(this);
				var filter_value = parseInt(filter.val(), 10);
				var filter_name = filter.attr('name');
				var filter_limit = filter.data('limit');
				$(target).each(function() {
					var item_value = parseInt($(this).data(filter_name), 10);
					switch (filter_limit) {
						case 'min':
							if (item_value < filter_value)
								$(this).addClass('hidden');
							break;
						case 'max':
							if (item_value > filter_value)
								$(this).addClass('hidden');
							break;
					}
				});
			});

			// filtro ulteriormente per i filtri like
			elem.find(FILTER_LIKE).each(function() {
				var filter = $(this);
				var filter_value = filter.val().toLowerCase();
				var filter_name = filter.attr('name');
				if (filter_value)
					$(target).each(function() {
						if ($(this).data(filter_name) != null) {
							var item_value = $(this).data(filter_name).toLowerCase();
							if (item_value.toString().indexOf(filter_value) == -1)
								$(this).addClass('hidden');
						}
					});
			});
		});

		elem.find(FILTERS+','+FILTER_CHECKED+','+FILTER_LIMIT).change(function () {
			elem.find(BUTTONS).click();
		});

		elem.find(FILTER_LIKE).keyup(function () {
			elem.find(BUTTONS).click();
		});

		reset.click(function(e) {
			e.preventDefault();
			elem.find(FILTERS).each(function() {
				$(this).val("");
			});
			button.click();
		});
	});
}

$(function() {
	init_filters();
});
