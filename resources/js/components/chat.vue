<template>
    <div class="popup-bg">
        <div class="popup-content col-11 col-md-6 col-lg-4 col-xl-3">
            <button @click="closePopup()" class="close-btn">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <h3 class="text-center pb-2 border-bottom">Seller Name</h3>
            <div class="bg-light inbox">
                <div class="message mb-2" v-for="msg in msgs" :class="{'othersmsg':msg.sender!=='customer','mymsg':msg.sender==='customer'}">
                    <h6 class="text-muted">{{msg.created_at}}</h6>
                    <p class="m-0 w-75">{{msg.message}}</p>
                </div>
                <!-- <div class="message mymsg mb-2">
                    <h6 class="text-muted">12:35 pm</h6>
                    <p class="m-0 w-75">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatum blanditiis non mollitia velit quisquam</p>
                </div> -->
            </div>
            <div class="send position-relative mt-2">
                <input type="text" class="form-control ps-2 pe-5" placeholder="Type Message..." v-model="msg">
                <button @click="sendMessage()"> > </button>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    props: ['seller'],
    data() {
        return {
            msgs : [],
            msg: ""
        }
    },
    mounted(){
        this.getMessages();
    },
    methods: {
        sendMessage(){
            if(this.msg.trim()==""){
                this.msg = "";
                alert("please write msg");
                this.msg = "";
                return;
            }
            axios.post('/api/send-msg',{'productId':this.seller,'msg':this.msg}).then(res => {
                this.msg = "";
                if(res.data.success){
                    this.getMessages();
                } else {
                    alert("somehting wwent wrong");
                }
            }).catch(er => {
                alert("somehting wwent wrong");
            })
        },
        closePopup(){
            this.$parent.chat.seller = null;
            this.$parent.chat.visible = false;
        },
        getMessages(){
            axios.get('/api/messages/'+this.seller).then(res => {
                if(res.data.success){
                    this.msgs = res.data.data.reverse();;
                } else {
                    alert("somehting wwent wrong");
                }
            }).catch(er => {
                alert("somehting wwent wrong");
            })
        }
    }
}
</script>
<style scoped>
.inbox{
    height: 350px;
    overflow-y: auto;
    padding: 5px;
}
.message h6 {
    font-size: 12px;
    margin-bottom: 3px;
}
.message p {
    padding: 5px;
    border-radius: 10px;
    font-size: 12px;
}

.mymsg p{
    background-color: rgb(142, 181, 255);
    margin-left: auto !important;
}
.mymsg h6{
    text-align: right;
}
.othersmsg p {
    background-color: rgb(179, 179, 179);
}
.send button{
    border: none;
    background-color: rgb(51, 51, 51);
    color: white;
    font-weight: bold;
    position: absolute;
    top: 10px;
    right: 7px;
    width: 20px;
    height: 20px;
    font-size: 12px;
    border-radius:5px
}
    .popup-bg{
        position: fixed;
        top: 0;
        left: 0;
        background-color:rgba(0, 0, 0, 0.527);
        z-index:9999 !important;
        width: 100vw;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .popup-content{
        max-height: 90%;
        overflow-y: auto;
        padding: 20px 10px;
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