<template>
    <div class="d-flex justify-content-center">
        <i class="fa-solid fa-star gold" v-for="count in parseInt(rating)"></i>
        <i class="fa-solid fa-star silver" v-for="count in 5-parseInt(rating)"></i>
    </div>
</template>
<script>
export default {
    props: ['rating'],
    mounted() {
        
    },
}
</script>
<style>
    .gold{
        color: gold;
    }
    .silver {
        color: silver;
    }
</style>