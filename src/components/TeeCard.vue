<template>
    <div class="card p-2 shadow-sm" v-if="item == null">
        <img src="" class="holder-image card-img-top rounded">
        <div class="card-body">
            <p class="h5 card-title placeholder col-md-12 col-12"></p>
            <div class="d-flex justify-content-between align-items-baseline placeholder-glow">
                <p class="card-text placeholder col-md-9 col-10"></p>
            </div>
        </div>
    </div>
    <div class="card p-2 shadow-sm" v-else>
        <img :src="require('@/assets/Images/'+item.product_image)" class="card-img-top rounded">
        <div class="card-body">
            <p class="h5 card-title">{{item.product_name}}</p>
            <div class="d-flex justify-content-between align-items-baseline">
                <p class="card-text">${{item.product_price}}</p>
                <router-link :to="`/product/${item.id}`" class="btn rounded-circle btn-dark">
                    <i class="bi bi-arrow-right"></i>
                </router-link>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'TeeCard',
    props: {
        item: Object, 
        default: function () {
            return null
        }
    }
}
</script>
<style scoped>
    .holder-image{
        background-color: lightgray;
        min-width: 300px;
        height: 400px;
    }
</style>