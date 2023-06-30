<x-app-layout>
    @section('content')
        <div class="container">
            <h1 class="mt-5 mb-2">Finn sted</h1>
            <form>
                @csrf
                <autocomplete 
                    label="Oppgi postnr"
                    id="postal-code"
                    class-input="autocomplete-input input-text input-text--search"
                    placeholder="6409" 
                    url="api/geodata">
                    <template #results="resultsProps">
                        <div class="autocomplete-results">
                            <ul class="autocomplete-results__list" v-if="resultsProps.items.length">
                                <li class="autocomplete-results__list-item mt-3" v-for="item in resultsProps.items">
                                    <h2>@{{ item.name }}</h2>
                                    @{{ item.code }}, @{{item.county}}
                                </li>
                            </ul>
                            <p class="mt-3" v-else>Ingen resultater, prøv annet postnr</p>
                        </div>
                    </template>
                </autocomplete>
            </form>    
        </div>
    @endsection

</x-app-layout>
