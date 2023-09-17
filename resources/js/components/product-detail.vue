<template>
    <Chat :seller="chat.seller" v-if="chat.visible" />
    <div class="popup-bg">
        <div class="popup-content col-11 col-md-10 col-xl-9">
            <button @click="closePopup()" class="close-btn">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <h3 class="text-center">{{product.name}}</h3>
            <div class="text-center mt-3">
                <img :src="product.image" class="img-fluid" onerror="this.src='/assets/images/no-image.jpg'">
            </div>
            <div class="text-center mt-3" v-show="product.stock<10">
                <p class="text-danger m-0">Hurry up! Only {{product.stock}} left</p>
            </div>
            <div class="details mt-5">
                <div class="row w-100 m-0">
                    <div class="col-12 col-md-6 border-start border-end px-2">
                        <p class="mb-1"><span class="text-muted">Category</span><span class="float-end">{{product.category}}</span></p>
                        <p class="mb-1"><span class="text-muted">Brand</span><span class="float-end">{{product.brand}}</span></p>
                    </div>
                    <div class="col-12 col-md-6 border-start border-end px-2">
                        <p class="mb-1"><span class="text-muted">Rating</span><span class="float-end"><Rating :rating="product.rating"></Rating></span></p>
                        <p class="mb-1"><span class="text-muted">Price</span><span class="float-end">PKR {{product.price}}/-</span></p>
                    </div>
                </div>
                <div class="desc mt-3">
                    <h5>Description: </h5>
                    <p style="white-space:pre-line">{{product.description}}</p>
                </div>
                <div class="specs mt-3">
                    <h5>Specification: </h5>
                    <ul>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga inventore quo doloremque, ducimu</li>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga inventore quo doloremque, ducimu</li>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga inventore quo doloremque, ducimu</li>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga inventore quo doloremque, ducimu</li>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga inventore quo doloremque, ducimu</li>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga inventore quo doloremque, ducimu</li>
                    </ul>
                </div>
                
                <div class="ftrs mt-3">
                    <h5>Features: </h5>
                    <div class="row m-0 w-100">
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">--> dummy feature</div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">--> dummy feature</div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">--> dummy feature</div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">--> dummy feature</div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">--> dummy feature</div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">--> dummy feature</div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">--> dummy feature</div>
                    </div>
                </div>
                <div class="act mt-3 text-center">
                    <button class="btn btn-primary mx-2">Add to Cart</button>
                    <button class="btn btn-secondary mx-2" @click="chatSeller(product.id)">Chat Seller</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Rating from './Rating.vue';
import Chat from './chat.vue';
export default {
    props: ['product'],
    components : {Rating,Chat},
    data() {
        return {
            chat: {
                visible: false,
                seller: null
            }
        }
    },
    methods: {
        closePopup(){
            this.$parent.productDetail.product = null;
            this.$parent.productDetail.visible = false;
        },
        chatSeller(productId){      // no seller data, seller id will be used if seler data exist
            this.chat.visible = true;
            this.chat.seller = productId;
        }
    }
}
</script>
<style scoped>
    .popup-bg{
        position: fixed;
        top: 0;
        left: 0;
        background-color:rgba(0, 0, 0, 0.527);
        z-index:99;
        width: 100vw;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .popup-content{
        max-height: 90%;
        overflow-y: auto;
        padding: 40px 20px;
        border-radius: 30px;
        background-color: white;
        box-shadow: 0px 0px 40px 10px #ffffffba;
        position: relative;
        font-size: 20px;
    }
    img {
        max-height: 400px;
    }
    .close-btn{
        background: transparent;
        border: none;
        position: absolute;
        top: 15px;
        right: 20px;
        color:  black;
        z-index: 9999999999;
    }
</style>