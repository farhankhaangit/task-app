<template>
    <div class="p-2 product border">
        <div class="img-head mb-2 product-img"
            :style="'background-image: url('+(pro.image==='/data/products/images/'?'/assets/images/no-image.jpg':pro.image)+');'">
            <!-- <img :src="pro.image" onerror="this.src='/assets/images/no-image.jpg'" class="img-fluid" alt=""> -->
        </div>
        <div class="">
            <h5 class="m-0 pb-1 border-bottom text-center">{{pro.name}}</h5>
            <p class="mt-1 mb-0"><span class="text-muted">Category: </span><span class="float-end">{{pro.category}}</span></p>
            <p class="m-0"><span class="text-muted">Brand: </span><span class="float-end">{{pro.brand}}</span></p>
            <p class="m-0"><span class="text-muted">Price: </span><strong class="float-end">PKR {{pro.price}}/-</strong></p>
            <Rating :rating="pro.rating" />
        </div>
        <div class="text-center mt-2">
            <button class="btn btn-sm btn-primary mx-2" @click="details()">Details</button>
            <button class="btn btn-sm btn-dark mx-2">Buy</button>
        </div>
    </div>
</template>
<script>
import Rating from './Rating.vue';
export default {
    props: ['pro'],
    components: {Rating},
    methods: {
        details(){
            this.$parent.openProductDetail(this.pro);
        }
    }
}
</script>
<style>
    
</style>