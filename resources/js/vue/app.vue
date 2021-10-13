<template>
    <div class="series-container">
       <div class="heading">
           <h2 id="title">Séries</h2>
           <!--- Todo botão do formulário --->
       </div> 
       <list-view :series="series"/>   
    </div>
</template>

<script charset="utf-8">
import listView from './listView.vue'

export default {
  components: { listView },
    Components: {
        listView
    },

    data: function() {
        return {
            series: []
        }
    }
}
    
</script>
<style scoped>
</style>