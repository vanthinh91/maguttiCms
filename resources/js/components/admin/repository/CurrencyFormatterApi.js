import {ref} from 'vue'
export default function currencyFormatter() {
    const amount = ref(null);
    const currency = ref('EUR')
    const locale = ref(window.__LOCALE)

    function formatCurrency(amount){
        return new Intl.NumberFormat( locale.value , {
            style: 'currency',
            currency: currency.value,
        }).format(amount)
    }
    return {formatCurrency}
};