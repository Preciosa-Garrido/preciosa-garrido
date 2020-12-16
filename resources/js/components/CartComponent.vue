<template>
	<!--================Cart Area =================-->
	<section class="cart_area">
		<div class="container">
			<div class="cart_inner">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Produto</th>
								<th scope="col">Preço</th>
								<th scope="col">Quantidade</th>
								<th scope="col">Operações</th>
							</tr>
						</thead>

						<tbody>
                            <tr v-for="cart in carts">
                                <td>
                                    <div class="media">
                                        <div class="d-flex">
                                            <img :src="'storage/product/' + cart.image" alt="" width="100px" height="100px" />
                                            <span style="padding: 30px 0 0 20px">{{ cart.product }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ cart.price }} KZs</td>
                                <td>{{ cart.qtd }}</td>
                                <td>
                                    <a class="main_btn" @click="destroy(cart)">Eliminar</a>
                                </td>
                            </tr>
                            <tr v-if="carts.length == 0" align="center">
                                <td colspan="4">Carrinho vazio</td>
                            </tr>
							<tr align="center">
								<td colspan="3">
									<h5><b class="text-info">Total</b></h5>
								</td>
								<td>
									<h5>{{ total }} KZs</h5>
								</td>
							</tr>
							<tr v-if="carts.length != 0" class="out_button_area" align="center">
								<td colspan="4">
									<div class="checkout_btn_inner">
										<a class="main_btn" href="cart/product/checkout">Proceder para compra</a>
									</div>
								</td>
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
        mounted() {
            this.getData(),
            this.calculaTotal()
        },

        data() {
            return{
                carts: [],
                total_product: 0,
                total: 0
            }
        },

        methods: {
            getData() {
                if(JSON.parse(localStorage.getItem('cart')))
                    this.carts = JSON.parse(localStorage.getItem('cart'))
                else
                    this.carts = []
            },

            calculaTotal() {
                this.total_product = 0
                this.total = 0
                
                this.carts.forEach(key => {
                    this.total_product = key.price * key.qtd
                    this.total += this.total_product
                })
            },

            destroy(product) {
                var vector = []
                var carrinho = JSON.parse(localStorage.getItem('cart'))

                localStorage.setItem('cart', [])

                carrinho.forEach(key => {
                    if(product.product != key.product) 
                        vector.push(key)
                })

                if(!localStorage.setItem('cart', JSON.stringify(vector))){
                    this.carts = vector;
                    swal('Sucesso', 'Produto removido do carrinho', 'success')
                } else {
                    swal('Erro', 'Produto não removido do carrinho', 'error')
                }

                this.calculaTotal()
            }
        }
    }
</script>