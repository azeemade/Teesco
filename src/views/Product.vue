<template>
    <div class="container p-horizontal mb-5">
        <div v-if="loading" class="card p-2 shadow-sm" aria-hidden="true">
            <div class="row">
                <div class="col-md-6">
                    <img src="#" class="card-img-top rounded">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <p class="h5 card-title placeholder-glow">
                            <span class="placeholder"></span>
                        </p>
                        <p class="card-text placeholder-glow">
                            <span class="placeholder"></span>
                        </p>
                        <div class="d-flex justify-content-between align-items-baseline">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="card p-2 shadow-sm">
            <div class="row">
                <div class="col-md-6">
                    <img :src="require('@/assets/Images/'+item.image)" class="card-img-top rounded">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <p class="h5 card-title">{{item.name}}</p>
                        <p class="card-text">${{item.price}}</p>
                        <div class="d-flex justify-content-between align-items-baseline">
                            <button class="btn btn-outline-danger" @click="removeItem(item.id)">Delete</button>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                        </div>
                        <EditModal />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import ProductService from '../services/product.service';
import EditModal from '../components/EditModal.vue';
export default {
    name: "Product",
    data() {
        return {
            item: {},
            loading: false
        };
    },
    methods: {
        removeItem(id) {
            ProductService.ViewProduct(id)
                .then(response => this.item = response.data);
            this.$router.push("/");
        }
    },
    beforeMount() {
        this.loading = true;
        ProductService.ViewProduct(this.$route.params.id)
            .then(response => this.item = response.data);
        this.loading = false;
    },
    components: { EditModal }
}
</script>
<style scoped>
    @media (min-width: 768px) {
        .p-horizontal{
            padding-left: 172px;
            padding-right: 172px; 
        }
    }
</style>