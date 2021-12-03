<template>
    <div class="row">
        <div class="col-auto">
            <label for="titulo" class="form-label">Título: </label>
        </div>
        <div class="col-auto">
            <input 
                v-model="editarSerie.nome" 
                id="titulo"
                placeholder="Digite o título da série"
                class="form-control"
                required
            />
        </div>
        <div class="col-auto">
            <label for="categoria" class="form-label">Categoria: </label>
        </div>
        <div class="col-auto">
            <select v-model="editarSerie.categoria" id="categoria" class="form-control">
                <option value="" disabled selected>Escolha uma categoria</option>
                <option>Ação</option>
                <option>Aventura</option>
                <option>Comédia</option>
                <option>Drama</option>
                <option>Ficção</option>
                <option>Romance</option>
                <option>Suspense</option>
                <option>Terror</option>
            </select>    
        </div>
        <div class="col-auto">
            <label for="streaming" class="form-label">Streaming: </label>
        </div>
        <div class="col-auto">
            <select v-model="editarSerie.streaming" id="streaming" class="form-control">
                <option disabled value="" selected>Escolha um streaming</option>
                <option>Netflix</option>
                <option>HBO Max</option>
                <option>Amazon Prime</option>
                <option>Disney Plus</option>
            </select>
        </div>        
        <div class="col-auto">
            <button v-if="editarSerie.id" class="btn btn-primary" v-on:click="editar(editarSerie); $emit('limpar')">
                Editar
            </button>
            <button v-else class="btn btn-primary" @click="cadastrarSerie()">
                Cadastrar
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: [ 'editarSerie' ],
    data: function () {
        return {
            serie: {
                titulo: "",
                categoria: "",
                streaming: "",
            },
        }
    },
    methods: {
        cadastrarSerie() {
            this.serie = this.editarSerie
            if (this.existeCampoVazio() === true) {
                return;
            }
            axios.post('api/v1/serie', {
                nome: this.serie.nome,
                categoria: this.serie.categoria,
                streaming: this.serie.streaming
            }).then( response => {
                    if (response.status == '201') {
                        this.$emit('limpar');
                        this.$emit('reloadlist');
                    }
                }) 
                .catch( error => {
                    console.log(error);
                })
        },
        existeCampoVazio() {
            if (this.serie.nome == ''
            || this.serie.categoria == ''
            || this.serie.streaming == ''
            ){
                return true;
            }
            return false;
        },
        editar(eSerie) {
            axios.patch('api/v1/serie/'+ eSerie.id, {
                nome: eSerie.nome,
                categoria: eSerie.categoria,
                streaming: eSerie.streaming
            })
            .then (resp => {
                if (resp.status == '204') {
                    this.$emit('limpar')
                    this.$emit('reloadlist')
                }
            })
            .catch (error => {
                console.log(error)
            })
        }
    },
    created() {
        this.editarSerie.nome = ''
        this.editarSerie.categoria = ''
        this.editarSerie.streaming = ''
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
        margin-bottom: 0px;
    }
</style>
