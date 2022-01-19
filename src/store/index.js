import { createStore } from 'vuex'

const store = createStore({
    state(){
        return {
            message: null, 
            product: null,
            items: []
        }
    },

    mutations: {
        new_message(state, data){
            state.message = data
        },
        view_product(state, data){
            state.product =data
        },
        load_items(state, data){
            state.items = data
        }
    },

    getters:{
        message: state => {
            return state.message
        },
        product: state => {
            return state.product
        },
        items: state => {
            return state.items
        }
    }

})

export default store
