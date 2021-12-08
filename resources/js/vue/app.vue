<template>
    <div>
        <nav class="navbar navbar-dark bg-dark">
            <a id="top" class="navbar-brand" v-on:click="goHome()">
                <i class="fa fa-video-camera fa-2x"></i>
            </a>
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
        <modal-episodios
            v-if="showDelEp"
            :delEpisodio="del"
            :temporada="temporada"
            @close="showDelEp = false"
            v-on:reloadlist="getEpisodios($event)"
        />
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h2>Séries</h2>
                    <form-series 
                        v-if="!showTemp && !showEp"
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
                    <form-episodios
                        v-if="showEp"
                        v-on:limpar="limpar()"
                        v-on:reloadlist="getEpisodios($event)"
                        :temporada="temporada"
                        :episodio="episodio"
                    />
                </div>
                <div class="card-body">
                    <table-episodios 
                        v-if="showEp"
                        v-on:sair="exitEpisodios()"
                        v-on:edit="editarEpisodio($event)"
                        v-on:delEpisodio="delEpisodio($event)"
                        :temporada="temporada"
                        :episodios="episodios"
                    />
                    <table-temporadas 
                        v-if="showTemp"
                        v-on:listEpisodios="showEpisodios($event)"
                        v-on:edit="editarTemporadaId($event)"
                        v-on:sair="exitTemporadas()"
                        v-on:delTemporada="delTemporada($event)"
                        :temporadas="temporadas"
                        :serieTemp="serieTemp"
                    />
                    <table-series 
                        v-if="!showTemp && !showEp"
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
import tableEpisodios from './tableEpisodios.vue';
import formTemporadas from './formTemporadas.vue';
import formSeries from './formSeries.vue';
import formEpisodios from './formEpisodios.vue';
import modalSeries from './modalSeries.vue';
import modalTemporadas from './modalTemporadas.vue';
import modalEpisodios from './modalEpisodios.vue';
export default {
    components: {
        formSeries,
        formTemporadas,
        formEpisodios,
        tableSeries,
        tableTemporadas,
        tableEpisodios,
        modalSeries,
        modalTemporadas,
        modalEpisodios,
    },
    data: function() {
        return {
            editarSerie: [],
            editarTemporada: [],
            del: 0,
            episodio: [],
            episodios: [],
            series: [],
            serieTemp: [],
            showDelSerie: false,
            showDelTemp: false,
            showDelEp: false,
            showEp: false,
            showFormTemp: false,
            showTemp: false,
            temporadas: [],
            temporada: [],
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
        getEpisodios(temp) {
            this.temporada = temp
            axios.get('api/v1/episodios', {
                params: { "temporada_id": temp.id }
            })
                .then (resp => {
                    this.episodios = resp.data
                })
                .catch (error => {
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
        editarEpisodio(id) {
            axios.get('api/v1/episodio/' + id)
                .then ( resp => {
                    this.episodio = resp.data
                })
                .catch ( error => {
                    console.log(error)
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
        delEpisodio(id) {
            this.del = id
            this.showDelEp = true
        },
        limpar() {
            this.editarSerie = []
            this.temporada = []
            this.episodio = []
        },
        showTemporadas(serieId) {
            this.editarSerieId(serieId.id)
            this.getTemporadas(serieId)
            this.showTemp = true;
        },
        showEpisodios(temporada) {
            this.getEpisodios(temporada);
            this.showEp = true;
            this.showTemp = false;
        },
        exitTemporadas() {
            this.showTemp = false;
            this.limpar()
        },
        exitEpisodios() {
            this.showTemp = true;
            this.showEp = false;
            this.limpar()
        },
        goHome() {
            this.showEp = false
            this.showTemp = false
            this.limpar()
        }
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
    a {
        cursor: pointer;
    }
</style>
        
