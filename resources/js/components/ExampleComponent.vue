<template>
    <div class="container">
       
    <input class="form-control" v-model="match" />

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6" id="tr" v-for="product in searchProducts">
            <div class="f_p_item">
                <div class="f_p_img">
                    <img class="img-fluid" :src="'http://preciosa.ces/storage/product/' + product.image" alt="Imagem do produto" :alt="product.product">
                    <div class="p_icon">
                        <a :href="'shop/product/' +product.id">
                            <i class="fa fa-plus"> {{match}}</i>
                        </a>
                    </div>
                    <div class="p_icon">
                        <a href="" @click.prevent="add(product.id)">
                            <i class="fa fa-heart"> </i>
                        </a>
                    </div>
                </div>
                <a :href="'shop/product/' + product.id">
                    <h4>{{ product.product }}</h4>
                </a>
                <h5>{{product.price}} KZs</h5>
            </div>
        </div>
    </div>












    </div>
</template>

<script>
    export default {
        mounted() {
            this.getProdutos()
        },
        data(){
           return {
              produtos: [], 
              match: ''
           } 
        },

        methods:{
            getProdutos(){
                axios.get('api/produtos')
                    .then(result => {
                        this.produtos = result.data.produtos
                        console.log(this.produtos)
                        })
                    .catch(error => console.log(error)) 
            },
            /* add(id){
                axios.post('audshs/' + id, { product: 'produto', preco: this.preco})
            } */
        },

        computed:{
            searchProducts(){
                return this.produtos.filter(produto => {
                    return produto.product.toLowerCase().includes(this.match.toLowerCase())
                })
            }
        }
    }
</script>
