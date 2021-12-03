<template>
    <transition name="modal">
        <div class="modal-fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button class="close" id="close" aria-label="Close" @click="$emit('close')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Deseja realmente excluir a série <strong>{{ this.deletar.nome }}</strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="$emit('close')">Não</button>
                        <button type="button" class="btn btn-primary" @click="deletarSerie(deletar)">
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
    props: [ 'deletar' ],
    methods: {
        deletarSerie(id) {
            axios.delete('api/v1/serie/' + id)
                .then ( resp => {
                    if (resp.status == '200') {
                        alert("Série excluida")
                        this.$emit('reloadlist')
                        this.$emit('close')
                    }
                })
                .catch (error => {
                    console.log(error)
                })
        },
    },
    created () {
    }
}
</script>
<style type="text/css" media="screen">
    .modal-fade {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #close {
        border: none;
        box-shadow: none;
        background-color: #fff;
        
    }
</style>
