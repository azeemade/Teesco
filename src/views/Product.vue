<template>
    <div class="container p-horizontal mb-5">
        <div v-if="item == null" class="card p-2 shadow-sm" aria-hidden="true">
            <div class="row">
                <div class="col-md-6 placeholder-glow">
                    <img src="#" class="card-img-top rounded placeholder placeholder-lg col-md-12">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <p class="h5 card-title placeholder-glow">
                            <span class="placeholder col-md-6"></span>
                        </p>
                        <p class="card-text placeholder-glow">
                            <span class="placeholder col-md-8"></span>
                        </p>
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
                        <p class="h3 card-title">{{item.name}}</p>
                        <div class="d-flex justify-content-between align-items-baseline">
                            <p class="card-text">
                                <span>{{item.units}}</span> quantities available
                            </p>
                            <p class="card-text">
                                Color: 
                                <span class="text-dark">{{item.color}}</span>
                            </p>
                        </div>
                        <hr>
                        <p class="card-text">
                            Price:  
                            <span class="text-dark">${{item.price}}</span>
                        </p>
                        <div class="d-flex justify-content-between align-items-baseline">
                            <p class="card-text">
                                Size:
                                <span class="text-dark">{{item.size}}</span>
                            </p>
                            <p class="card-text">
                                Print:
                                <span class="text-dark">{{item.imprint}}</span>
                            </p>
                        </div>
                        <hr>
                        <p class="card-text">{{item.description}}</p>
                        
                        <div class="d-flex justify-content-between align-items-baseline">
                            <button class="btn btn-outline-danger" @click="removeItem(item.id)">Delete</button>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                        </div>
                        <EditModal :item="item"/>
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
            item: null,
        };
    },
    methods: {
        removeItem(id) {
            ProductService.DestroyProduct(id)
            .then(response => {
                this.$store.commit('new_message', response.data.message)
            });
            this.$router.push("/");

        }
    },
    beforeMount() {
        ProductService.ViewProduct(this.$route.params.id)
        .then(response => {
            this.item = response.data.data
            this.$store.commit('view_product', response.data.data)
        });

    },
    components: { EditModal }
}
</script>
<style scoped>
    .card-text{
        --bs-text-opacity: 1;
        color: rgba(var(--bs-secondary-rgb),var(--bs-text-opacity))!important;
    }
    @media (min-width: 768px) {
        .p-horizontal{
            padding-left: 172px;
            padding-right: 172px; 
        }
    }
</style>