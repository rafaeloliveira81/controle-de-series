<template>
    <div class="series-container">
        <div class="heading">
            <h2 id="title">Minhas Séries</h2>
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
  font-family: Titillium Web, sans-serif;
  width: 60%;
  padding: 3px 50px;
  margin: auto;
  background: #E8EEF1;
}
.heading {
  color: #E8EEF1;
  background-color: #1E3D58;
  padding: 5px;
  margin-top: 30px;
  margin-bottom: 20px;
  border-color: #ccc;
  border-radius: 5px;
  box-shadow: -3px 3px 4px 0px #1E3D58;
}
#title {
    text-align: center;
}
</style>
        
