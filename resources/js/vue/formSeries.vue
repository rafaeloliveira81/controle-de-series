<template>
    <div class="row">
        <div class="col-auto">
            <label for="titulo" class="form-label">Título:</label>
        </div>
        <div class="col-auto">
            <input 
                type="text" 
                id="titulo" 
                class="form-control" 
                placeholder="Título" 
                v-model="serie.titulo"
                required
            />
        </div>
        <div class="col-auto">
            <label for="categoria-select" class="form-label">Categoria:</label>
        </div>
        <div class="col-auto">
            <select name="categoria" id="categoria-select" class="form-select">
                <option value="">- Categoria -</option>
                <option value="Animação">Animação</option>
                <option value="Aventura">Aventura</option>
                <option value="Comédia">Comédia</option>
                <option value="Romance">Romance</option>
                <option value="Suspense">Suspense</option>
                <option value="Terror">Terror</option>
            </select>
        </div>
        <div class="col-auto">
            <label for="stream-select" class="form-label">Streaming:</label>
        </div>
        <div class="col-auto">
            <select name="streaming" id="stream-select" class="form-select">
                <option value="">- Streaming -</option>
                <option value="Netflix">Netflix</option>
                <option value="HBO Max">HBO Max</option>
                <option value="Amazon Prime">Amazon Prime</option>
                <option value="Disney Plus">Disney Plus</option>
            </select>
        </div>
        <div class="col-auto">
            <button class="btn btn-secondary" @click="cadastrarSerie()">
                Cadastrar
            </button>
        </div>
    </div>
</template>

<script charset="utf-8">
    export default {
        data: function () {
            return {
                serie: {
                    titulo: ""
                }
            }
        },
        methods: {
            cadastrarSerie() {
                if (this.serie.titulo == '') {
                    return;
                }
                axios.post('api/v1/serie', {
                    nome: this.serie.titulo
                }).then( response => {
                    if (response.status == '201') {
                        this.serie.titulo = '';
                        this.$emit('reloadlist');
                    }
                })
                    .catch (error => {
                        console.log(error);
                    })
            },
        },
    }
    
</script>

<style scoped>
.row {
    align-items: center;
}
.col-auto {
    padding: 10px 0 0 8px;
}

input, select, button {
    height: 35px;
}
label {
    margin: 0 0 0 10px;
}

</style>
