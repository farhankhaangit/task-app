<template lang="">
    <div class="my-popup-component justify-content-end" style="z-index:9999" @click.self="closeFilters()">
        <div class="bg-white brds-5 py-4 px-2 position-relative me-5" style="width:300px;height:95%">
            <button @click="closeFilters()" class="trans_btn position-absolute" style="right:15px;top:10px;font-size:25px">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="h-10 text-center">
                <h5 class="m-0">Filters</h5>
            </div>
            <div class="h-70 overflow-auto">
                <div class="catBtn mb-2">
                    <div class="pointer bghv py-1 px-2 text-primary" @click="expandToggle('cats')">
                        Categories
                        <i class="mt-1 float-end fa-solid fa-chevron-down" :class="{'inverted' : expanded.cats}" style="color:black;"></i>
                    </div>
                    <div v-show="expanded.cats" class="py-1 px-3">
                        <div class="my-1 text-start" v-for="(cat,index) in categories" :key="index">
                            <input type="checkbox" :id="'cat'+index" class="form-check-input pointer" :value="cat" v-model="selectedCats">
                            <label :for="'cat'+index" class="wb-all ms-2 h7 pointer">{{cat}}</label>
                        </div>
                    </div>
                </div>
                <div class="catBtn mb-2">
                    <div class="pointer bghv py-1 px-2 text-primary" @click="expandToggle('brds')">
                        Brands
                        <i class="mt-1 float-end fa-solid fa-chevron-down" :class="{'inverted' : expanded.brds}" style="color:black;"></i>
                    </div>
                    <div v-show="expanded.brds" class="py-1 px-3">
                        <div class="my-1 text-start" v-for="(brd,index) in brands" :key="index">
                            <input type="checkbox" :id="'brd'+index" class="form-check-input pointer" :value="brd" v-model="selectedBrd">
                            <label :for="'brd'+index" class="wb-all ms-2 h7 pointer">{{brd}}</label>
                        </div>
                    </div>
                </div>
                <div class="catBtn mb-2">
                    <div class="pointer bghv py-1 px-2 text-primary" >
                        Price Range
                    </div>
                    <div class="py-1 px-3 mt-1">
                        <div class="mb-1 text-start">
                            <input type="checkbox" id="vsd" class="form-check-input pointer" :checked="prices.active" @change="prices.active=!prices.active">
                            <label for="vsd" class="ms-2 h7 pointer">Enable</label>
                        </div>
                        <div class="row justify-content-between ps-4">
                            <div class="col-5">
                                <input type="number" class="form-control w-100" v-model="prices.min" :readonly="!prices.active">
                                <p class="m-0"> Min</p>
                            </div>
                            <div class="col-5">
                                <input type="number" class="form-control w-100" v-model="prices.max" :readonly="!prices.active">
                                <p class="m-0"> Max</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="h-20 d-flex flex-column justify-content-center align-items-center">
                <button class="btn btn-primary w-50 my-1 btn-sm" @click="applyFilters()">Apply</button>
                <button class="btn btn-secondary w-50 my-1 btn-sm" @click="resetFilters()">Reset</button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props : ['brands','categories','prefill'],
    data() {
        return {
            selectedCats : [],
            selectedBrd : [],
            expanded: {
                cats : false,
                brds : false,
            },
            prices: {
                active : false,
                min : null,
                max : null
            },
        }
    },
    mounted() {
        this.selectedBrd = this.prefill.brands;
        this.selectedCats = this.prefill.categories;
        this.prices = this.prefill.price_range;
    },
    methods: {
        applyFilters(){
            this.$parent.applyFilters({
                "brands" : this.selectedBrd,
                "categories" : this.selectedCats,
                "price_range" : this.prices
            });
        },
        resetFilters(){
            this.$parent.clearFilters();
        },
        closeFilters(){
            this.$parent.filters.visible = false;
        },
        expandToggle(k){
            this.expanded[k] = !this.expanded[k];
            // if(k=='cats'){
            //     this.expanded.cats = !this.expanded.cats;
            //     this.expanded.brds = false;
            // } else {
            //     this.expanded.brds = !this.expanded.brds;
            //     this.expanded.cats = false;
            // }
        },
    }
}
</script>
<style scoped>
    .trans_btn{
        background: transparent;
        border: none;   
    }
    .brds-5 {
        border-radius: 25px;
    }
    .h-10{
        height: 10%;
    }
    .h-20{
        height: 20%;
    }
    .h-70{
        height: 70%;
    }
    .catBtn {
        width: 85%;
        text-align: center;
        border: 1px solid #B1B0B0;
        background-color: white;
        position: relative;
        margin: auto;
    }
    .bghv:hover{
        background-color: rgb(240, 240, 240);
    }
    .inverted {
        transform: rotate(180deg);
    }
    .my-popup-component{
        position: fixed;
        top: 0;
        left: 0;
        background-color:rgba(0, 0, 0, 0.527);
        z-index:999;
        width: 100vw;
        height: 100vh;
        display: flex;
        align-items: center;
    }
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
</style>