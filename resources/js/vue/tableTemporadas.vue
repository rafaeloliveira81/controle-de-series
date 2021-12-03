<template>
    <div>
        <div class="header">
            <h3>Temporadas: 
                <a title="Voltar" v-on:click="$emit('sair')">
                    {{ serieTemp.nome }}
                </a>
            </h3>
            <button 
                class="btn" 
                title="Voltar"
                v-on:click="$emit('sair')"
            >
                <i class="fa fa-arrow-left"></i>
            </button>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Temporada</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(temporada, index) in temporadas" :key="index">
                    <th scope="row">{{ temporada.id }}</th>
                    <td>{{ temporada.nome }}</td>
                    <td>
                        <a v-on:click="editarTemporada(temporada.id)">
                            <i class="fa fa-pencil-square-o"> </i>
                        </a>
                        <a v-on:click="$emit('delTemporada', temporada.id)">
                            <i class="fa fa-trash-o"> </i>
                        </a>
                        <a>
                            <i class="fa fa-tv"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script charset="utf-8">
export default {
    props: [ 'temporadas', 'serieTemp' ],
    methods: {
        editarTemporada(id) {
            this.$emit('edit', id)
        }
    },
    created() {
    }
}
</script>
<style scoped>
    ul {
        list-style-type: none;
    }
    .header {
        display: flex;
        justify-content: space-between;
    }
    a {
        cursor: pointer;
    }
</style>
