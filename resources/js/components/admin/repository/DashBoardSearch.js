import {ref,reactive,onMounted} from 'vue'
export default function useDashBoardSearchApi() {

    const sections = reactive(['Cms', 'Shop','Users']);
    const element= ref('');
    const elements = reactive([
        { label: 'Shop', id: 1 },
        { label: 'Cms', id: 2 },
        { label: 'User', id: 3 },
    ])
    onMounted(() => console.log("mounted"))
    return {
        sections,elements,element
    }
};