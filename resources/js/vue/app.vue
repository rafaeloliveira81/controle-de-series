<template>
    <div>
        <nav class="navbar navbar-dark bg-dark">
            <a id="top" class="navbar-brand">Séries</a>
        </nav>
        <modal-series  
            v-if="showModal" 
            :deletar="del"
            @close="showModal = false"
            v-on:reloadlist="getSeries()"
        />
        
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h2>Séries</h2>
                    <form-series 
                        v-on:reloadlist="getSeries()"
                        v-on:limpar="limpar()"
                        :editarSerie="editarSerie"
                    />
                </div>
                <div class="card-body">
                    <table-series 
                        :series="series" 
                        v-on:reloadlist="getSeries()"
                        v-on:edit="editarId($event)"
                        v-on:deletar="deletar($event)"
                    />
                </div>
            </div>    
        </div>
    </div>
</template>

<script>tableSeries
import formSeries from './formSeries.vue';
import tableSeries from './tableSeries.vue';
import modalSeries from './modalSeries.vue';
export default {
    components: {
        formSeries,
        tableSeries,
        modalSeries
    },
    data: function() {
        return {
            series: [],
            editarSerie: [],
            del: 0,
            showModal: false,
        }
    },
    methods: {
        getSeries() {
            axios.get('api/v1/series')
                .then( response => {
                    this.series = response.data
                    console.log(this.series);
                }) 
                .catch( error => {
                    console.log(error);
                })
        },
        editarId(id) {
            axios.get('api/v1/serie/' + id)
                .then ( response => {
                    this.editarSerie = response.data
                })
                .catch ( error => {
                    console.log (error)
                })

        },
        deletar(id) {
            this.del = id
            this.showModal = true
        },
        limpar() {
            this.editarSerie = []
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
</style>
        
