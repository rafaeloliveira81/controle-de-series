<template>
    <div>
        <div class="header">
            <h3>Episódios:</h3>
            <button class="btn"
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
                    <th scope="col">Episódio</th>
                    <th scope="col">Sinopse</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(episodio, index) in episodios" :key="index">
                    <td>{{ episodio.id }}</td>
                    <td>{{ episodio.nome }}</td>
                    <td>{{ episodio.sinopse }}</td>
                    <td>
                        <a v-on:click="$emit('edit', episodio.id)" >
                            <i class="fa fa-pencil-square-o"></i>
                        </a>
                        <a v-on:click="$emit('delEpisodio', episodio.id)" title="episodio">
                            <i class="fa fa-trash-o"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script charset="utf-8">
export default {
    props: ['temporada', 'episodios'],
    methods: {
    },
    created() {
    }
}
</script>
<style scoped>
.header {
    display: flex;
    justify-content: space-between;
}
a {
    cursor: pointer;
}
</style>
