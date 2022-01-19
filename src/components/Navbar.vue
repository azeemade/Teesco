<template>
    <nav class="navbar navbar-light bg-light mb-4">
        <div class="container-fluid">
            <div class="nav-item">
                <span class="navbar-brand mb-0 h1">Teesco</span>
            </div>
            <div class="nav-item d-flex">
                <div class="me-3" v-if="$route.name == 'Product'">
                    <button class="btn btn-outline-secondary" @click="ExportCSV($route.params.id)">Export CSV</button>
                </div>
                <div  v-if="$route.name == 'Index'">
                    <router-link to="/new" class="btn btn-primary">Create Product</router-link>
                </div>
            </div>
        </div>
    </nav>
</template>
<script>
import ProductService from '../services/product.service';
export default {
    name: 'Navbar',
    methods:{
        ExportCSV(Id){
            ProductService.exportCSV(Id)
            .then(response => {
                let csvContent = "data:text/csv;charset=utf-8,";
                csvContent += [response.data]
                const data = encodeURI(csvContent);
                const link = document.createElement("a");
                link.setAttribute("href", data);
                link.setAttribute("download", "ProductsData.csv");
                link.click();
            });
        }
    }
}
</script>