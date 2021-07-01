import {ref} from 'vue'
import {HTTP} from '../../../mixins/http-common';
import notifier from '../../../mixins/notifier';

export default  function useFetch(url,params={}) {

    const response = ref(null);
    const data = ref(null);
    const error = ref(null);
    const loading = ref(null)

    const fetch = async() =>{

        loading.value = true;
        try {
            const result = await HTTP.get(url,{params})
            response.value = result;
            data.value = result.data.data;
        }
        catch (ex){
            error.value = ex

        }
        finally {
            loading.value = false
        }
        return data.value
    }
    fetch().then( () =>  console.log(response.value) );
    return {response,error,loading,fetch,data}
}