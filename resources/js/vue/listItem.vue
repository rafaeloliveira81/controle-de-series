<template>
  <div class="serie">
    <ul class="item-serie">
      <li class="id-serie">{{ serie.id }}</li>
      <li class="nome-serie">{{ serie.nome }}</li>
      <li class="status-serie">{{ serie.status }}</li>
    </ul>
  </div>
</template>
<script charset="utf-8">
export default {
  props: ['serie'],
}
    
</script>
<style scoped>
  .serie {
    margin: 1px 3px;
    align-items: center;
    border-radius: 2px;
  }

  .item-serie {
    width: 80%;
    height: 100%;
    display: flex;
    list-style-type:none;
  }

  .item-serie li {
    padding: 5px;
    align-self: center;
  }
  .id-serie {
    width: 50px;
    margin-right: 15px;
    text-align: right;
    font-weight: bold;
  }
  .nome-serie {
  }
  .status-serie {
    width: 120px;
    margin: 2px 0;
    background: #E8EEF1;
    color: #3dd;
    font-style: oblique;
    margin-left: auto;
    border-radius: 5px;
    text-align: center;
    box-shadow: inset -2px 2px 4px 0px #1E3D58;
  }

</style>
   
