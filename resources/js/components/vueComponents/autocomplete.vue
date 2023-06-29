<template>
    <div>
        <input @focus="focus = true" :class="classInput" :placeholder="placeholder" type="text" v-model="query">
        <div v-if="showResults">
            <slot :items="items" name="results">
                TODO, fallback
            </slot>
        </div>
    </div>
</template>


<script>

export default {


    props: ['url', 'classInput', 'placeholder'],

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
                q: this.query
            };

            axios(this.url, { params }).then(response => {
                this.items = response.data;
            });
        },
    },
    computed: {
        showResults() {
            return this.query.length > 2 && this.focus;
        },
    },
    watch: {
        query() {
            this.fetch();
        }
    }
}
</script>