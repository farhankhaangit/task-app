<template>
    <div class="p-2 product border">
        <div class="img-head mb-2 product-img"
            :style="'background-image: url('+(pro.image==='/data/products/images/'?'/assets/images/no-image.jpg':pro.image)+');'">
            <!-- <img :src="pro.image" onerror="this.src='/assets/images/no-image.jpg'" class="img-fluid" alt=""> -->
        </div>
        <div class="text-center">
            <h5 class="m-0 pb-1 border-bottom">{{pro.name}}</h5>
            <p class="mt-1 mb-0 text-muted">{{pro.category}}</p>
            <p class="m-0">{{pro.brand}}</p>
            <p class="m-0 text-success"><strong>PKR {{pro.price}}/-</strong></p>
            <Rating :rating="pro.rating" />
        </div>
        <div class="text-center mt-2">
            <button class="btn btn-sm btn-primary mx-2">Add To Cart</button>
            <button class="btn btn-sm btn-dark mx-2">Buy</button>
        </div>
    </div>
</template>
<script>
import Rating from './Rating.vue';
export default {
    props: ['pro'],
    components: {Rating}
}
</script>
<style>
    
</style>