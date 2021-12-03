<template>
    <div class="row">
        <div class="col-auto">
            <label for="nome" class="form-label">Nome: </label>
        </div>
        <div class="col-auto">
            <input 
                class="form-control" 
                id="nome" 
                v-model="temporada.nome"
                required
             />
        </div>
        <div class="col-auto">
            <button 
                v-if="temporada.id"
                class="btn btn-primary"
                v-on:click="editarTemporada(temporada.id)"
            >
                <i class="fa fa-pencil"></i>
            </button>
            <button 
                v-else
                class="btn btn-primary"
                v-on:click="addTemporada()"
            >
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
</template>
<script charset="utf-8">
export default {
    props: [ 'serieTemp', 'temporada' ],
    methods: {
        addTemporada() {
            axios.post('api/v1/temporada', {
                serie_id: this.serieTemp.id,
                nome: this.temporada.nome
            })
                .then( response => {
                    if (response.status == '201') {
                        this.$emit('reloadlist', this.serieTemp)
                        this.$emit('limpar')
                    }
                })
                .catch( error => {
                    console.log(error)
                })
        },
        editarTemporada(id) {
            axios.patch('api/v1/temporada/' + id, {
                nome: this.temporada.nome
            })
                .then (resp => {
                    if (resp.status == '204') {
                        this.$emit('reloadlist', this.serieTemp)
                        this.$emit('limpar')
                    }
                })
                .catch (error => {
                    console.log(error)
                })
        },
    },
    created() {
        this.$emit('reloadlist', this.serieTemp)
    }
}
</script>
<style scoped>
label {
    margin: 0;
}
.row {
    align-items: center;
    align-content: center;
    margin-bottom: 0;
}
</style>
