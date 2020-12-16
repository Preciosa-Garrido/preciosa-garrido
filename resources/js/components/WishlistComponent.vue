<template>
	<!--================Cart Area =================-->
	<section class="cart_area">
		<div class="container">
			<h3>Lista de desejos</h3>
			<div class="cart_inner">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Produto</th>
								<th scope="col">Preço</th>
								<th scope="col">Categoria</th>
								<th scope="col">Operações</th>
							</tr>
						</thead>
						<tbody>
                            <tr v-for="wishlist in wishlists">
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img :src="'storage/product/' + wishlist.image" alt="Imagem do produto" width="100px" height="100px" />
                                            <span style="padding: 30px 0 0 20px">{{ wishlist.product }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ wishlist.price }}</td>
                                <td>{{ wishlist.category }}</td>
                                <td>
                                    <a class="main_btn" v-on:click="destroy(wishlist.id)">Remover</a>
                                    <a class="main_btn" v-on:click="addCart(wishlist)"><i class="lnr lnr-cart"></i></a>
                                </td>
                            </tr>
                            <tr v-if="wishlists.length == 0">
                                <td style="text-align: center;" colspan="4">Não há produtos na sua lista de desejos</td>
                            </tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
	<!--================End Cart Area =================-->
</template>

<script>
    export default {
        props: ['auth'],

        mounted() {
            this.getData()
        },

        data() {
            return {
                wishlists: [],
                cart: [],
            }
        },

        methods: {
            getData() {
                axios
                    .get('/api/wishlist/' + this.auth.id)
                    .then(result => {
                        console.log(result)
                        this.wishlists = result.data.wishlists
                    }).catch(error => console.log(error))
            },

            addCart(product) {
                var produtos = {
                    'product_id': product.product_id,
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

            destroy(id) {
                console.log(id);
                axios
                    .delete('api/wishlist/destroy/' + id)
                    .then(result => {
                        swal(result.data.result.title, result.data.result.message, result.data.result.type)
                        this.getData()
                    }).catch(error => console.log(error))
            }
        }
    }
</script>