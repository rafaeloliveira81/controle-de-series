<template>
    <transition name="modal">
        <div class="modal-fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Excluir Episódio</h5>
                        <button class="close" id="close" aria-label="Close" @click="$emit('close')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Deseja realmente excluir o episódio?</p>
                    </div>
                    <div class="modal-footer">
                        <button 
                            type="button"
                            class="btn btn-secondary"
                            @click="$emit('close')"
                        >
                            Não
                        </button>
                        <button 
                            type="button" 
                            class="btn btn-primary" 
                            @click="excluir(delEpisodio)"
                        >
                            Sim
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
<script charset="utf-8">
export default {
    props: [ 'delEpisodio', 'temporada' ],
    methods: {
        excluir(id) {
            axios.delete('api/v1/episodio/' + id)
                .then ( resp => {
                    if (resp.status == '200') {
                        alert("Episódio excluida")
                        this.$emit('reloadlist', this.temporada)
                        this.$emit('close')
                    }
                })
                .catch ( error => {
                    console.log(error)
                })
        },
    },
    created() {
    }
}
</script>
<style scoped>
</style>
