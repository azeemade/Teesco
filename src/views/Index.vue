<template>
    <div>
        <div class="container">
            <div class="alert alert-success alert-dismissible mt-3" role="alert" v-if="message != null">
                {{message}} 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div class="row">
                <div class="col-md-4 col-6 mb-3" v-for="item, index in items" :key="index">
                    <TeeCard :item="item"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import ProductService from '../services/product.service';
import TeeCard from "../components/TeeCard.vue";
import {mapGetters} from 'vuex'
export default {
    name: "Index",
    components: { TeeCard },
    data(){
        return{
        }
    },
    computed:{
        ...mapGetters([
            'message', "items"
        ])
    },
    beforeMount(){
        ProductService.ListProducts()
        .then(response => {
            this.$store.commit('load_items', response.data.data)
        })
    }
}
</script>