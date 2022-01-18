<template>
    <div class="card p-2 shadow-sm">
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
    props: {item: Object}
}
</script>