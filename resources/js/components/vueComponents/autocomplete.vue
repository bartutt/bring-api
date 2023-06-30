<template>
    <div>
        <label class="mb-1" for="id">{{ label }}</label>
        <input id="id" @focus="focus = true" :class="classInput" :placeholder="placeholder" type="text" v-model="query">
        <div v-if="showResults">
            <slot :items="items" name="results">
                TODO, fallback
            </slot>
        </div>
    </div>
</template>


<script>

export default {


    props: ['url', 'classInput', 'placeholder', 'id', 'label'],

    data() {
        return {
            items: [],
            query: '',
            focus: false,
        }
    },

    created() {
    },

    methods:
    {
        hide(){
            this.focus = false;
        },
        fetch() {
            const params = {
                code: this.query
            };

            axios.post(this.url, { params }).then(response => {
                this.items = response.data;
            });
        },
    },
    computed: {
        showResults() {
            return this.query.length > 3 && this.focus;
        },
    },
    watch: {
        query() {
            if(this.query.length > 3){
                this.fetch();
            }
            
        }
    }
}
</script>