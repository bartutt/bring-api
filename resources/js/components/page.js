import { createApp } from "vue";
import Autocomplete from "./vueComponents/autocomplete.vue";

function initPage() {
    const el = document.querySelector("#js-page");

    if (!el) {
        return; 
    }

    createApp({
        components: {
            Autocomplete,
        },

        data() {
            return {
                
            };
        },

        watch: {

        },

        computed: {
          
        },

        methods: {

        },
        mounted(){
            
        },

        created() {

        },
    }).mount(el);

}


export { initPage };
