<template>
    <div class="container p-horizontal">
        <p class="h2">Add new product</p>
        <div class="mb-5">
            <div class="mb-3">
                <div class="d-flex justify-content-center">
                    <img :src="preview == '' ? '' : preview" :class="preview == '' ? 'holder-image' : '' " class="rounded --img" width="136" heigth="112">
                </div>
                <div class="mt-1 d-flex justify-content-center">
                    <label for="scfile"  class="text-primary btn-sm btn fs-7" title="Upload image">
                        <input type="file" id="scfile" name="scImage" autocomplete="off" @change="attachimage" 
                        class="d-none">
                        Add product image
                    </label>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" placeholder="name@example.com" v-model="data.name">
                <label for="Name">Name</label>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="price" placeholder="name@eximple.com" v-model="data.price">
                        <label for="price">Price</label>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="units" placeholder="name@exapple.com" v-model="data.units">
                        <label for="units">Units</label>
                    </div>
                </div>
            </div>

            <div class="col-md-6 form-floating mb-3">
                <input type="text" class="form-control" id="color" placeholder="name@example.com"  v-model="data.color">
                <label for="color">Color</label>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <p class="fw-bold">Size</p>
                    <div class="d-flex flex-wrap">
                        <div class="shadow-sm me-3 text-secondary border p-2 rounded mb-2" v-for="(size, index) in sizes" :key="index">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sizeRadio" :id="size.size_title+'1'" :value="size.size_title" v-model="data.size">
                                <label class="form-check-label" :for="size.size_title+'1'">
                                    {{size.size_title}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="fw-bold">Imprint</p>
                    <div class="d-flex flex-wrap">
                        <div class="shadow-sm me-3 text-secondary border p-2 rounded mb-2" v-for="(imprint, index) in imprints" :key="index">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="imprintRadio" :id="imprint.imprint_title+'1'" :value="imprint.imprint_title" v-model="data.imprint">
                                <label class="form-check-label" :for="imprint.imprint_title+'1'">
                                    {{imprint.imprint_title}}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" v-model="data.description"></textarea>
                <label for="floatingTextarea2">Description</label>
            </div>

            <button class="btn btn-primary" @click="Create" :disabled="loading">
                <div class="spinner-border" role="status" v-show="loading">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <span v-show="loading == false">Create product</span>
            </button>

            <div class="alert alert-danger alert-dismissible mt-3" role="alert" v-if="message != ''">
                {{message}} 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
</template>
<script>
import ProductService from '../services/product.service';
export default {
    name: "New",
    data(){
        return{
            data: {
                name: null, price: null,
                units: null, color: null,
                size: null, imprint: null,
                description: null
            },
            imprints: [],
            sizes: [],
            message: '',
            preview: '',
            cover: null,
            loading: false
        }
    },
    methods:{
        attachimage(e) {
            e.preventDefault();
            var files = e.target.files
            this.cover = e.target.files[0]

            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            var reader = new FileReader();
            reader.onload = (e) => {
                this.preview = e.target.result;
            };

            reader.readAsDataURL(file);
        },

        Create(){
            this.loading = true

            let formdata = new FormData();
            formdata.append("name", this.data.name);
            formdata.append("price", this.data.price);
            formdata.append("description", this.data.description);
            formdata.append("color", this.data.color);
            formdata.append("size", this.data.size);
            formdata.append("imprint", this.data.imprint);
            formdata.append("units", this.data.units);
            formdata.append("image", this.cover);

            ProductService.AddProduct(formdata)
            .then(response => {
                this.$store.commit('new_message', response.data.message)
                this.$router.push("/")
            })
            .catch(err => {
                console.log(err)
                this.message = err.response.data.message
                this.loading = false
            })
        }
    },
    beforeMount(){
        ProductService.ListImprints()
        .then(response => this.imprints = response.data);

        ProductService.ListSizes()
        .then(response => this.sizes = response.data);
    }
}
</script>
<style scoped>
    .--img{
        max-height: 112px;
    }
    @media (min-width: 768px) {
        .holder-image{
                background-color: lightgray;
                width: 136px;
                height: 112px;
        }
        .p-horizontal{
            padding-left: 172px;
            padding-right: 172px; 
        }
    }
</style>