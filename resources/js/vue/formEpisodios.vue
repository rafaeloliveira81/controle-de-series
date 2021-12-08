<template>
    <div class="row">
        <div class="col-auto">
            <label for="nome" class="form-label">Título: </label>
        </div>
        <div class="col-auto">
            <input 
             class="form-control"
             id="nome"
             v-model="episodio.nome"
             required
            />
        </div>
        <div class="col-auto">
            <label for="sinopse" class="form-label">Sinópse: </label>
        </div>
        <div class="col-auto">
            <input 
             class="form-control"
             id="sinopse"
             v-model="episodio.sinopse"
            />
        </div>
        <div class="col-auto">
            <button
                class="btn btn-primary"
                v-if="episodio.id"
                v-on:click="editarEpisodio(episodio.id)"
            >
                <i class="fa fa-pencil"></i>
            </button>
            <button
                class="btn btn-primary"
                v-on:click="addEpisodio(episodio)"
                v-else
            >
                <i class="fa fa-plus"></i>
            </button>
        </div>
    </div>
</template>
<script charset="utf-8">
export default {
    props: [ 'episodio', 'temporada' ],
    methods: {
        addEpisodio(Ep) {
            axios.post('api/v1/episodio', {
                temporada_id: this.temporada.id,
                nome: Ep.nome,
                sinopse: Ep.sinopse
            })
                .then (resp => {
                    if (resp.status == '201') {
                        this.$emit('reloadlist', this.temporada)
                        this.$emit('limpar')
                    }
                })
                .catch (error => {
                    console.log(error)
                })
        },
        editarEpisodio(id) {
            axios.patch('api/v1/episodio/' + id, {
                nome: this.episodio.nome,
                sinopse: this.episodio.sinopse
            })
                .then (resp => {
                    if (resp.status == '204') {
                        this.$emit('limpar')
                        this.$emit('reloadlist', this.temporada)
                    }
                })
                .catch ( error => {
                    console.log(error)
                })
        }
    },
    created() {
        this.$emit('reloadlist', this.temporada)
    }
}
</script>
