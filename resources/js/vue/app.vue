<template>
<<<<<<< HEAD
    <div class="series-container">
       <div class="heading">
           <h2 id="title">Séries</h2>
           <!--- Todo botão do formulário --->
       </div> 
       <list-view :series="series"/>   
=======
    <div class="seriesContainer">
        <div class="heading">
            <h2 id="title">Séries</h2>
            <!-- @ todo botão do formulário -->
        </div>
        <!-- @ todo componete para listagem das séries -->
>>>>>>> d7b8b46388a6d75cc75a365983e64be2e9ce8635
    </div>
</template>

<script charset="utf-8">
import listView from './listView.vue'

export default {
<<<<<<< HEAD
  components: { listView },
    Components: {
        listView
    },

    data: function() {
        return {
            series: []
        }
=======
    components: {
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
>>>>>>> d7b8b46388a6d75cc75a365983e64be2e9ce8635
    }
}
    
</script>
<style scoped>
<<<<<<< HEAD
</style>
=======
.seriesContainer {
    width: 50%;
    margin: auto;
}
.heading {
    font-family: "Lucida Console", Courier, monospace;
    color: #1E3D58;
    background-color: #E8EEF1;
    padding: 10px;
    margin-top: 30px;
    vertical-align: middle;
    border-color: #ccc;
    border-radius: 5px;
    box-shadow: 3px 3px 4px 0px #1E3D58;
}
#title {
    text-align: center;
}
</style>
        
>>>>>>> d7b8b46388a6d75cc75a365983e64be2e9ce8635
