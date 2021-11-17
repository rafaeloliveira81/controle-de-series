<template>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Título da Série</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Streaming</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(serie, index) in series" :key="index">
                    <th scope="row">{{ serie.id }}</th>
                    <td>{{ serie.nome }}</td>
                    <td>{{ serie.categoria }}</td>
                    <td>{{ serie.streaming}}</td>
                    <td>{{ serie.status }}</td>
                    <td>
                        <a href="#top" v-on:click="$emit('edit', serie.id)">
                            <i class="fa fa-pencil-square-o"> </i>
                        </a>
                        <a v-on:click="deleteSerie(serie)">
                            <i class="fa fa-trash-o"> </i>
                        </a>
                        <a v-on:click="atualizaSerie(serie.id)">
                            <i class="fa fa-check-square-o"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: [ 'series' ],
    methods: {
        deleteSerie(serie) {
            let del = confirm("Deseja realmente excluir a Série: " + serie.nome + "?")
            if (del) {
                axios.delete('api/v1/serie/' + serie.id)
                    .then ( resp => {
                        if (resp.status == '200') {
                            alert("Série excluida")
                            this.$emit('reloadlist')
                        }
                    })
                    .catch (error => {
                        console.log(error)
                    })
            }
        },
        atualizaSerie(id) {
            axios.put('api/v1/serie/status/' + id)
                .then (resp => {
                    if (resp.status == '204') {
                        this.$emit('reloadlist')
                    }
                })
                .catch (error => {
                    console.log(error)
                })
        },
    },

}
</script>

<style scoped>
    a {
        text-decoration: none;
        color: #333;
    }
    i {
        cursor: pointer;
    }
</style>
