<x-app-layout>
    @section('content')
        <div class="container">
            <h1 class="mt-10 mb-5">Finn postnr</h1>
            <form class="homepage__form">
                @csrf
                <autocomplete class-input="autocomplete-input input-text input-text--search"
                    placeholder="Søk" url="api/geodata">

                    <template #results="resultsProps">
                        <div class="autocomplete-results">
                            <ul class="autocomplete-results__list">
                                <li class="autocomplete-results__list-item" v-for="item in resultsProps.items">
                                    <a :href="item.url">@{{ item.city }}</a>
                                </li>
                            </ul>
                        </div>
                    </template>

                </autocomplete>

                <button aria-label="søk" type="submit"></button>
            </form>
        </div>
    @endsection

</x-app-layout>
