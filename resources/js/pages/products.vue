<template>
    <div class="container">
    <Filters v-if="filters.visible" :categories="filters.categories" :brands="filters.brands" :prefill="filters.prefills"/>
        <h1 class="mt-5 text-center">Ecommerce Website</h1>
        <div class="mt-5 product-box">
            <div class="products-header bg-dark py-3 px-3">
                <div class="row text-white">
                    <h4 class="m-0 col-12 col-md-6 col-lg-8">Available Products</h4>
                    <div class="d-flex justify-content-between col-12 col-md-6 col-lg-4">
                        <div class="d-flex">
                            <span class="me-4">Sort By:</span>
                            <select @change="sortData()" v-model="sortBy" class="py-1 px-2 border-0" style="width: 180px;">
                                <option value="">-- select --</option>
                                <option value="name_asc">Name</option>
                                <option value="name_dsc">Name (desc)</option>
                                <option value="price_asc">Price</option>
                                <option value="price_dsc">Price (desc)</option>
                                <option value="rating_asc">Rating</option>
                                <option value="rating_dsc">Rating (desc)</option>
                            </select>
                        </div>
                        <div class="ms-3">
                            <button class="btn btn-light btn-sm" @click="openFilters()">Filters</button>
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
import Product from '../components/Product.vue';
import Filters from '../components/Filters.vue';
export default {
    components: {Product,Filters},
    data() {
        return {
            products: [],
            visibleProducts: [],
            sortBy: "",
            filters: {
                brands : [],
                categories : [],
                visible: false,
                prefills: {
                    "brands" : [],
                    "categories" : [],
                    "price_range" : {
                        "active" : false,
                        "min" : null,
                        "max" : null
                    },
                }
            }
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
        },
        sortData(){
            const sortDetail = this.sortFieldAndOrder();
            const field = sortDetail.field;
            const order = sortDetail.order;
            if(order==="asc"){
                this.visibleProducts.sort((a, b) => (a[field] > b[field])?1:-1);
                console.log(order);
            }
            else {
                this.visibleProducts.sort((a, b) => (a[field] < b[field])?1:-1);
                console.log(order);
            }
        },
        sortFieldAndOrder(){
            const inputString = this.sortBy;
            const wordsArray = inputString.split('_');
            return {
                "field" : wordsArray[0],
                "order" : wordsArray[1]
            }
        },
        openFilters(){
            if(this.filters.brands.length===0){
                axios.get('/api/brands').then(res => {
                    if(res.data.success){
                        this.filters.brands = res.data.data;
                    } else {
                        alert("Something went wrong");
                        console.log("brands fetching error: ",res.data.message);
                        return;
                    }
                }).catch(er => {
                    alert("Something went wrong");
                    console.log("brands fetching error: ",er.message);
                    return;
                })
            }
            if(this.filters.categories.length===0){
                axios.get('/api/categories').then(res => {
                    if(res.data.success){
                        this.filters.categories = res.data.data;
                    } else {
                        alert("Something went wrong");
                        console.log("categories fetching error: ",res.data.message);
                        return;
                    }
                }).catch(er => {
                    alert("Something went wrong");
                    console.log("categories fetching error: ",er.message);
                    return;
                })
            }
            this.filters.visible = true;
        },
        applyFilters(applied){
            this.filters.prefills = applied;
            this.filters.visible = false;
            const filteredProducts = this.products.filter(product => {
                if (applied.categories.length > 0 && !applied.categories.includes(product.category)) {
                    return false;
                }
                if (applied.brands.length > 0 && !applied.brands.includes(product.brand)) {
                    return false;
                }
                if(applied.price_range.active){
                    if (((applied.price_range.min != null && applied.price_range.min != ""  && product.price < applied.price_range.min) || 
                        (applied.price_range.max != null && applied.price_range.max != "" && product.price > applied.price_range.max))) {
                        return false;
                    }
                }
                return true;
            });
            this.visibleProducts = filteredProducts;
            if(this.sortBy!=="")
            this.sortData();
        },
        clearFilters(){
            this.filters.visible = false;
            this.filters.prefills = {
                "brands" : [],
                "categories" : [],
                "price_range" : {
                    "active" : false,
                    "min" : null,
                    "max" : null
                },
            }
            this.visibleProducts = this.products;
            if(this.sortBy!=="")
            this.sortData();
        }
    },
}
</script>
<style>
    
</style>