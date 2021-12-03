<template>
    <div>
        <nav class="navbar navbar-dark bg-dark">
            <a id="top" class="navbar-brand">Séries</a>
        </nav>
        <modal-series  
            v-if="showDelSerie" 
            :deletar="del"
            @close="showDelSerie = false"
            v-on:reloadlist="getSeries()"
        />
        <modal-temporadas  
            v-if="showDelTemp" 
            :delTemporada="del"
            :serieTemp="serieTemp"
            @close="showDelTemp = false"
            v-on:reloadlist="getTemporadas($event)"
        />
        
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h2>Séries</h2>
                    <form-series 
                        v-if="!showTemp"
                        v-on:reloadlist="getSeries()"
                        v-on:limpar="limpar()"
                        :editarSerie="editarSerie"
                    />
                    <formTemporadas
                        v-if="showTemp"
                        v-on:reloadlist="getTemporadas($event)"
                        v-on:limpar="limpar()"
                        :serieTemp="serieTemp"
                        :temporada="temporada"
                    />
                </div>
                <div class="card-body">
                    <table-temporadas 
                        v-if="showTemp"
                        v-on:edit="editarTemporadaId($event)"
                        v-on:sair="exitTemporadas()"
                        v-on:delTemporada="delTemporada($event)"
                        :temporadas="temporadas"
                        :serieTemp="serieTemp"
                    />
                    <table-series 
                        v-else
                        :series="series" 
                        v-on:reloadlist="getSeries()"
                        v-on:edit="editarSerieId($event)"
                        v-on:deletar="deletar($event)"
                        v-on:listTemporadas="showTemporadas($event)"
                    />
                </div>
            </div>    
        </div>
    </div>
</template>

<script>tableSeries
import tableSeries from './tableSeries.vue';
import tableTemporadas from './tableTemporadas.vue';
import formTemporadas from './formTemporadas.vue';
import formSeries from './formSeries.vue';
import modalSeries from './modalSeries.vue';
import modalTemporadas from './modalTemporadas.vue';
export default {
    components: {
        formSeries,
        formTemporadas,
        tableSeries,
        tableTemporadas,
        modalSeries,
        modalTemporadas,
    },
    data: function() {
        return {
            series: [],
            editarSerie: [],
            editarTemporada: [],
            temporadas: [],
            temporada: [],
            serieTemp: [],
            del: 0,
            showDelSerie: false,
            showDelTemp: false,
            showTemp: false,
            showFormTemp: false,
            geraTemp: [],
        }
    },
    methods: {
        getSeries() {
            axios.get('api/v1/series')
                .then( response => {
                    this.series = response.data
                }) 
                .catch( error => {
                    console.log(error);
                })
        },
        getTemporadas(serie) {
            this.serieTemp = serie
            axios.get('api/v1/temporadas', {
                params: { "serie_id": serie.id }
            })
                .then( response => {
                    this.temporadas = response.data
                }) 
                .catch( error => {
                    console.log(error);
                })
        },
        editarSerieId(id) {
            axios.get('api/v1/serie/' + id)
                .then ( response => {
                    this.editarSerie = response.data
                })
                .catch ( error => {
                    console.log (error)
                })

        },
        editarTemporadaId(id) {
            axios.get('api/v1/temporada/' + id)
                .then ( response => {
                    this.temporada = response.data
                })
                .catch ( error => {
                    console.log (error)
                })

        },
        deletar(id) {
            this.del = id
            this.showDelSerie = true
        },
        delTemporada(id) {
            this.del = id
            this.showDelTemp = true
        },
        limpar() {
            this.editarSerie = []
            this.temporada = []
        },
        showTemporadas(serieId) {
            this.editarSerieId(serieId.id)
            this.getTemporadas(serieId)
            this.showTemp = true;
        },
        exitTemporadas() {
            this.showTemp = false;
        },
    },
    created() {
        this.getSeries();
    }
}
</script>

<style scoped>
    nav {
        margin-bottom: 10px;
    }
    .card {
        margin: 20px 30px;
    }
    .navbar-brand {
        margin-left: 20px;
    }
</style>
        
