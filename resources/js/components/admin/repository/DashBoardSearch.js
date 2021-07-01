import {ref} from 'vue'
export default function useDashBoardSearchApi() {
    const sections = ref(['Cms', 'Shop','Users']);
    return { sections }
};