<template>
	<!--================Category Product Area =================-->
	<section class="cat_product_area section_gap">
		<div class="container-fluid">
			<div class="row flex-row-reverse">
				<div class="col-lg-9">
					<div class="product_top_bar">
						<div class="left_dorp">
							<select class="sorting" @change="selecionar" v-model="order">
                                <option value="Ordenar por">Ordenar por</option>
								<option value="min">Mais barato</option>
								<option value="max">Mais caro</option>
							</select>

							<select class="show" @change="showing" v-model="number">
								<option value="12">Mostrar 12</option>
								<option value="24">Mostrar 24</option>
								<option value="36">Mostrar 36</option>
								<option value="48">Mostrar 48</option>
							</select>
							<input class="form-control show pesquisar" placeholder="Pesquisar" v-model="match" />
						</div>
					</div>
    
                    <div class="latest_product_inner row">
                        <div class="col-lg-3 col-md-3 col-sm-6" v-for="product in searchProducts">
                            <div class="f_p_item">
                                <div class="f_p_img">
                                    <img :src="'storage/product/' + product.image" :alt="'Imagem do produto ' + product.product" class="img-fluid" style="width: 100%; height: 13em" />
                                    <div class="p_icon">
                                        <a :href="'shop/product/' + product.id">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <a v-on:click="storeCart(product)">
                                            <i class="lnr lnr-cart"></i>
                                        </a>
                                        <a v-if="auth != null" v-on:click="storeWishlist(product.id)">
                                            <i class="lnr lnr-heart"></i>
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
                    <div v-if="produtos.length == 0" class="latest_product_inner row">
                        Ainda não há produtos para serem apresentados na loja
                    </div>
                </div>
                
				<div class="col-lg-3">
					<div class="left_sidebar_area">
						<aside class="left_widgets cat_widgets">
							<div class="l_w_title">
								<h3>Categorias</h3>
							</div>
							<div class="widgets_inner">
								<ul class="list">
                                    <li>
                                        <a href="" @click.prevent="filtra(0)">Todas</a>
                                    </li>
                                    <li  v-for="category in categories">
                                        <span>
                                            <a href="" @click.prevent="filtra(category.id)">{{ category.category }}</a>
                                        </span>
                                    </li>
									<li v-if="categories.length == 0">Ainda não há categorias para serem apresentadas</li>
								</ul>
							</div>
						</aside>
						<aside class="left_widgets p_filter_widgets">
							<div class="l_w_title">
								<h3>Filtro</h3>
							</div>
							<div class="widgets_inner">
                                <a href="" @click.prevent="filtra(-1)">Em promoção</a>
                                <h4>Preço</h4>
                                <div class="range_item">
                                    <div id="slider-range"></div>
                                    <div class="row m0">
                                        <label for="amount">Preço : </label>
                                        <input type="text" id="amount" readonly>
                                    </div>
                                </div>
							</div>
						</aside>
					</div>
				</div>
            </div>

			<div class="row">
				<nav class="cat_page mx-auto" aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item">
							<a class="page-link" v-on:click="fetchProducts(pagination.prev_page)" :disabled="!pagination.prev_url">
								<i class="fa fa-chevron-left" aria-hidden="true"></i>
							</a>
						</li>
						<li v-for="key in pagination.last_page_number">
                            <span class="page-item" v-bind:class="verify(key, pagination.current_page)">
							    <a class="page-link" href="#">{{ key }}</a>
                            </span>
						</li>
						<li class="page-item">
							<a class="page-link" v-on:click="fetchProducts(pagination.next_page)" :disabled="!pagination.next_url">
								<i class="fa fa-chevron-right" aria-hidden="true"></i>
							</a>
						</li>
					</ul>
				</nav>
			</div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['auth'],

        mounted() {
            this.getData()
        },
        data(){
            return {
                categories: [],
                produtos: [],
                cart: [],
                match: '',
                url: 'api/produtos/',
                order: 'Ordenar por',
                number: '12',
                data: {
                    user_id: this.auth,
                    product_id: null
                },
                pagination: {
                    current_page: null,
                    prev_page: null,
                    next_page: null,
                    first_page: null,
                    last_page_number: null,
                    last_page: null
                }
            } 
        },

        methods: {
            getData(){
                axios
                    .get('api/produtos/' + this.number)
                    .then(result => {
                        this.produtos = result.data.produtos.data
                        console.log(result)
                        this.paginate(result.data.produtos)
                    }).catch(error => console.log(error)) 

                axios.get('api/categories')
                    .then(result => {
                        this.categories = result.data.categories
                    }).catch(error => console.log(error))
            },

            paginate(pages) {
                this.pagination.current_page = pages.current_page
                this.pagination.prev_page = pages.prev_page_url
                this.pagination.next_page = pages.next_page_url
                this.pagination.first_page = pages.first_page_url
                this.pagination.last_page = pages.last_page_url
                this.pagination.last_page_number = pages.last_page
            },

            fetchProducts(url) {
                console.log(url);

                axios
                    .get(url)
                    .then(result => {
                        this.produtos = result.data.produtos.data
                        this.paginate(result.data.produtos)
                    }).catch(error => console.log(error))
            },

            storeCart(product) {
                var produtos = {
                    'product_id': product.id,
                    'product': product.product,
                    'price': product.price,
                    'image': product.image,
                    'qtd': 1
                }

                if(!localStorage.getItem('cart')) {
                    this.cart.push(produtos)

                    if(!localStorage.setItem('cart', JSON.stringify(this.cart)))
                        swal('Sucesso', 'Produto adicionado ao carrinho com sucesso', 'success')
                    else
                        swal('Erro', 'Produto não adicionado ao carrinho', 'error')

                    console.log(JSON.parse(localStorage.getItem('cart')))
                } else {
                    var vector = []
                    var finded = null
                    var carrinho = JSON.parse(localStorage.getItem('cart'))

                    localStorage.setItem('cart', [])

                    carrinho.forEach(key => {
                        if(key.product == produtos.product){
                            key.qtd += 1
                            finded = true  
                        }

                        vector.push(key)
                    })

                    if(!finded) vector.push(produtos)

                    if(!localStorage.setItem('cart', JSON.stringify(vector)))
                        swal('Sucesso', 'Produto adicionado ao carrinho com sucesso', 'success')
                    else
                        swal('Erro', 'Produto não adicionado ao carrinho', 'error')
                        
                    console.log(JSON.parse(localStorage.getItem('cart')))
                }
            },

            storeWishlist(id) {
                this.data.product_id = id
                axios
                    .post('/api/wishlist/store', this.data)
                    .then(result => {
                        console.log(result)
                        swal(result.data.result.title, result.data.result.message, result.data.result.type)
                    }).catch(error => console.log(error))
            },
            
            filtra(id) {
                axios.get('api/products/category/'+id)
                    .then(result => {
                        console.log(result)
                        if (result.data.produtos.data) {
                            this.produtos = result.data.produtos.data
                        } else if(result.data.produtos) {
                            this.produtos = result.data.produtos
                        } else {
                            this.produtos = []
                        }
                    }).catch(error => console.log(error)) 
            },

            showing() {
                axios
                    .get(this.url + this.number)
                    .then(result => {
                        console.log(result);
                        this.produtos = result.data.produtos.data
                        this.paginate(result.data.produtos)
                    }).catch(error => console.log(error))
            },

            verify(now, current) {
                if(now == current)
                    return 'active'
                else
                    return false
            },

           selecionar: _.debounce(function() {
               
                 switch(this.order){
                    case 'min':
                        this.produtos = this.produtos.sort((a, b) => {
                            return a.price - b.price;
                        })
                    break;

                    case 'max':
                        this.produtos = this.produtos.sort((a, b) => {
                            return b.price - a.price;
                        })
                    break;
                } 
            }, 1000)
        },

        computed: {
            searchProducts() {
                return this.produtos.filter(produto => {
                    return produto.product.toLowerCase().includes(this.match.toLowerCase())
                })

                //produto.price >= this.min_price && produto.price <= this.max_price
            }
        }
    }
</script>

<style>
    a {
        cursor: pointer
    }
</style>