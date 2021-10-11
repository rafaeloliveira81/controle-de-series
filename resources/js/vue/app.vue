<template>
    <div class="series-container">
        <div class="heading">
            <h2 id="title">Séries</h2>
            <!-- @ todo botão do formulário -->
        </div>
        <list-view :series="series" />
    </div>
</template>

<script charset="utf-8">
import listView from './listView'
export default {
    components: {
        listView
    },
    data: function() {
        return {
            series: [],
        }
    },
    methods: {
        getSeries() {
            axios.get('api/v1/series')
            .then(
                response => {
                    this.series = response.data
                    console.log(this.series)    
            })
            .catch(
                error => {
                console.log(error)    
            })
        }
    },
    created() {
        this.getSeries();
    }
}
    
</script>
<style scoped>
.series-container {
    width: 50%;
    margin: auto;
}
.heading {
    font-family: "Lucida Console", Courier, monospace;
    color: #1E3D58;
    background-color: #E8EEF1;
    padding: 10px;
    margin-top: 30px;
    border-color: #ccc;
    border-radius: 5px;
    box-shadow: 3px 3px 4px 0px #1E3D58;
}
#title {
    text-align: center;
}
</style>
        
