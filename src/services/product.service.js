import axios from 'axios'
const API_URL = 'http://127.0.0.1:8000/api/v1/';

class ProductService {
    ListProducts(){
        var config = {
            method: 'get',
            url: API_URL + 'products'
        };
        return axios(config)
    }

    ViewProduct(productId){
        var config = {
            method: 'get',
            url: API_URL + `products/${productId}`
        };
        return axios(config)
    }

    AddProduct(product){
        var config = {
            method: 'post',
            url: API_URL + `product`,
            data: JSON.stringify(product)
        };
        return axios(config)
    }

    UpdateProduct(product){
        var config = {
            method: 'post',
            url: API_URL + `product`,
            data: JSON.stringify(product)
        };
        return axios(config)
    }

    DestroyProduct(productId){
        var config = {
            method: 'delete',
            url: API_URL + `products/${productId}`
        };
        return axios(config)
    }

    exportCSV(){
        var config = {
            method: 'get',
            url: API_URL + `csv`
        };
        return axios(config)
    }
}

export default new ProductService();