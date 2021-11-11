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
                <option disabled value="">Escolha uma categoria</option>
                <option>Ação</option>
                <option>Ficção</option>
                <option>Terror</option>
                <option>Comédia</option>
                <option>Aventura</option>
            </select>    
        </div>
        <div class="col-auto">
            <label for="streaming" class="form-label">Streaming: </label>
        </div>
        <div class="col-auto">
            <select v-model="editarSerie.streaming" id="streaming" class="form-control">
                <option disabled value="">Escolha um streaming</option>
                <option>Netflix</option>
                <option>HBO Max</option>
                <option>Amazon Prime</option>
                <option>Disney Plus</option>
            </select>
        </div>        
        <div class="col-auto">
            <button class="btn btn-primary" @click="cadastrarSerie()">
                Cadastrar
            </button>
            <button class="btn btn-primary" @click="editar(editarSerie)">
                Editar
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
            if (existeCampoVazio() === true) {
                return;
            }
            axios.post('api/v1/serie', {
                nome: this.serie.titulo,
                categoria: this.serie.categoria,
                streaming: this.serie.streaming
            }).then( response => {
                    if (response.status == '201') {
                        this.serie.titulo = '';
                        this.serie.categoria = "";
                        this.serie.streaming = "";
                        this.$emit('reloadlist');
                    }
                }) 
                .catch( error => {
                    console.log(error);
                })
        },
        existeCampoVazio() {
            if (this.serie.titulo == ''
            || this.serie.categoria == '' 
            || this.serie.streaming == ''
            ){
                return true;
            }
            return false;
        },
        editar(eSerie) {
            alert(eSerie.id)
        }
    },
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
