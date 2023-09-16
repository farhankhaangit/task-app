<template>
    <div class="container">
        <h1 class="mt-5 text-center">Ecommerce Website</h1>
        <div class="mt-5 product-box">
            <div class="products-header bg-dark py-3 px-3">
                <div class="row text-white">
                    <h4 class="m-0 col-12 col-md-6 col-lg-8">Available Products</h4>
                    <div class="d-flex justify-content-between col-12 col-md-6 col-lg-4">
                        <div class="d-flex">
                            <span class="me-4">Sort By:</span>
                            <select class="py-1 px-2 border-0" style="width: 180px;">
                                <option value="name">Name</option>
                                <option value="price">Price</option>
                                <option value="rating">Rating</option>
                            </select>
                        </div>
                        <div class="ms-3">
                            <button class="btn btn-light btn-sm">Filters</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="products-body p-3 bg-white border mb-5">
                <div class="row justify-content-center">
                    <div class="p-2 col-12 col-sm-6 col-lg-4 col-xl-3" v-for="pro in visibleProducts">
                        <Product :pro="pro" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import Product from '../components/Product.vue'
export default {
    components: {Product},
    data() {
        return {
            products: [],
            visibleProducts: []
        }
    },
    mounted() {
        this.getProducts();
    },
    methods: {
        getProducts(){
            axios.get('/api/products').then(res => {
                if(res.data.success){
                    this.products = res.data.data;
                    this.visibleProducts = res.data.data;
                }
            }).catch(er => {
                alert("Something went wrong");
                console.log("products fetching error: ",er.message);
            })
        }
    },
}
</script>
<style>
    
</style>