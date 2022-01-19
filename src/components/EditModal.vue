<template>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update {{product.name}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-5">
                    <div class="mb-3">
                        <div class="d-flex justify-content-center">
                            <img id="Img1" :src="preview == '' ? require('@/assets/Images/'+product.image) : preview" class="rounded --img" width="136" heigth="112">
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
                        <input type="text" class="form-control" id="name" placeholder="name@example.com" v-model="product.name">
                        <label for="Name">Name</label>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="price" placeholder="name@eximple.com" v-model="product.price">
                                <label for="price">Price</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="units" placeholder="name@exapple.com" v-model="product.units">
                                <label for="units">Units</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 form-floating mb-3">
                        <input type="text" class="form-control" id="color" placeholder="name@example.com"  v-model="product.color">
                        <label for="color">Color</label>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <p class="fw-bold">Size</p>
                            <div class="d-flex flex-wrap">
                                <div class="shadow-sm me-3 text-secondary border p-2 rounded mb-2" v-for="(size, index) in sizes" :key="index">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sizeRadio" :id="size.size_title+'1'" :value="size.size_title" v-model="product.size">
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
                                        <input class="form-check-input" type="radio" name="imprintRadio" :id="imprint.imprint_title+'1'" :value="imprint.imprint_title" v-model="product.imprint">
                                        <label class="form-check-label" :for="imprint.imprint_title+'1'">
                                            {{imprint.imprint_title}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" v-model="product.description"></textarea>
                        <label for="floatingTextarea2">Description</label>
                    </div>
                </div>
                <div :class="success == true ? 'alert-success' : 'alert-danger' " class="alert alert-dismissible mt-3" role="alert" v-if="message != ''">
                    {{message}} 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" @click="Update" :disabled="loading">
                    <div class="spinner-border" role="status" v-show="loading">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <span v-show="loading == false">Update product</span>
                </button>
            </div>
            </div>
        </div>
    </div>
</template>
<script>
import ProductService from '../services/product.service';
import { mapGetters } from 'vuex'
export default {
    name: "EditModal",
    data(){
        return{
            imprints: [],
            sizes: [],
            message: '',
            preview: '',
            cover: null,
            loading: false,
            success: false
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

        toBase64(){
            var c = document.createElement('canvas');
            var img = document.getElementById('Img1');
            c.height = img.naturalHeight;
            c.width = img.naturalWidth;
            var ctx = c.getContext('2d');

            ctx.drawImage(img, 0, 0, c.width, c.height);
            var base64String = c.toDataURL();

            return base64String
        },

        dataURLtoFile() {
            var b64 = this.toBase64()
            var arr = b64.split(','), mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
            while(n--){
                u8arr[n] = bstr.charCodeAt(n);
            }
            return new File([u8arr], this.product.image, {type:mime});
        },

        Update(){
            this.loading = true

            let formdata = new FormData();
            formdata.append("id", this.product.id);
            formdata.append("name", this.product.name);
            formdata.append("price", this.product.price);
            formdata.append("description", this.product.description);
            formdata.append("color", this.product.color);
            formdata.append("size", this.product.size);
            formdata.append("imprint", this.product.imprint);
            formdata.append("units", this.product.units);

            if(this.product.cover != null){
                formdata.append("image", this.product.cover);
            }
            else{
                var url = this.dataURLtoFile()
                formdata.append("image", url);
            }

            ProductService.UpdateProduct(formdata)
            .then(response => {
                this.message = response.data.message
                this.success = response.data.status
                this.loading = false
            })
            .catch(err => {
                console.log(err)
                this.message = err.response.data.message
                this.loading = false
            })
        }
    },
    computed: {
        ...mapGetters([
            'product'
        ])
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
</style>