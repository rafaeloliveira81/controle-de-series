<template>
    <div>
        <div v-for="(serie, index) in series" :key="index">
            <list-item :serie="serie"
                class="series"/>
        </div>
    </div>
</template>
<script charset="utf-8">
import listItem from './listItem';
export default {
    props: ['series'],
    components: {
        listItem
    }
}
    
</script>
<style scoped>
.series {
  color: #E8EEF1;
  background: #1E3D58;
  align-content: center;
  box-shadow: -2px 2px 4px 0px #111;
}
</style>
   
