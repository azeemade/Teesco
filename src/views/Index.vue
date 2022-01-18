<template>
    <div>
        <div class="container">
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
export default {
    name: "Index",
    components: { TeeCard},
    data(){
        return{
            items:[]
        }
    },
    beforeMount(){
        ProductService.ListProducts()
        .then(response => this.items = response.data.data)
    }
}
</script>