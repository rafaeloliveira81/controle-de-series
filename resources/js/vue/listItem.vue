<template>
    <div class="serie">
        <label :class="serie-id">{{ serie.id }}</label>
        <label :class="serie-name">{{ serie.nome }}</label>
        <label :class="serie-status">{{ serie.status }}</label>
    </div>
</template>
<script charset="utf-8">
export default {
    props: ['serie'],
}
    
</script>
<style scoped>
    .serie {
        display: flex;
        justify-content: center;
        align-content: center;
        border-radius: 3px;
    }
    .serie-id {
        width: 10%;
        align-content: left;
    }
    .serie-name {
        width: 50%;
        align-content: left;
    }
    .serie-status {
        width: 40%;
        align-content: left;
    }

</style>
   
