<template>

	<!--================Checkout Area =================-->
	<section class="checkout_area section_gap">
		<div class="container">
            <div style="display: flex">
                <div class="returning_customer col-md-6" v-if="auth == null">
                    <div class="check_title">
                        <h2>Cliente cadastrado?
                            <a role="button" data-toggle="collapse" href="#login" aria-expanded="false" aria-controls="login">Clique aqui para iniciar sessão</a>
                        </h2>
                    </div>
                    <div class="collapse" id="login" style="padding-top: 10px">
                        <form class="row contact_form" action="../../login" method="post" novalidate="novalidate" >
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="email" name="email" />
                                <span class="placeholder" data-placeholder="E-mail"></span>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="password" class="form-control" id="password" name="password" value="">
                                <span class="placeholder" data-placeholder="Senha"></span>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" value="submit" class="btn submit_btn">Login</button>
                                <div class="creat_account">
                                    <input type="checkbox" id="f-option" name="selector">
                                    <label for="f-option">Manter-me autenticado</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="cupon_area col-md-5">
                    <div class="check_title">
                        <h2>Tem um cupão?
                            <a role="button" data-toggle="collapse" href="#cupao" aria-expanded="false" aria-controls="cupao">Clique para adicionar o código</a>
                        </h2>
                    </div>
                    <div class="collapse" id="cupao">
                        <input type="text" placeholder="Código" v-model="data.cupao" />
                        <a @click="addCode()" class="tp_btn">{{ button }}</a>
                    </div>
                </div>
            </div>
			<div class="billing_details">
				<div class="row">
					<div class="col-lg-8">
						<h3>Informações pessoais</h3>
						<form class="row contact_form">
							<div class="col-md-6 form-group p_star" v-if="auth == null">
								<input type="text" class="form-control" id="first_name" v-model="data.first_name" />
								<label for="first_name" class="placeholder" data-placeholder="Primeiro nome"></label>
							</div>
							<div class="col-md-6 form-group p_star" v-if="auth == null">
								<input type="text" class="form-control" id="last_name" v-model="data.last_name" />
								<label for="last_name" class="placeholder" data-placeholder="Último nome"></label>
							</div>
							<div class="col-md-6 form-group p_star" v-if="auth == null">
								<input type="text" class="form-control" id="phone" v-model="data.phone" />
								<label for="phone" class="placeholder" data-placeholder="Número de telefone"></label>
							</div>
							<div class="col-md-6 form-group p_star" v-if="auth == null">
								<input type="email" class="form-control" id="email" v-model="data.email" />
								<label for="email" class="placeholder" data-placeholder="E-mail"></label>
							</div>
							<div class="col-md-12 form-group" v-if="auth != null">
								<div class="creat_account">
									<label for="f-option3">Adicionar um outro endereço?</label>
								</div>
								<textarea class="form-control" rows="1" placeholder="Endereço" v-model="data.address" ></textarea>
							</div>

							<div class="col-md-12 form-group" v-else>
								<div class="creat_account">
									<label for="f-option3">Adicionar um endereço?</label>
								</div>
								<textarea class="form-control" rows="1" placeholder="Endereço"v-model="data.address" ></textarea>
							</div>
						</form>
					</div>
					<div class="col-lg-4">
						<div class="order_box">
							<h2>Produtos</h2>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="cart in carts">
                                        <td>{{ cart.product }}</td>
                                        <td>{{ cart.qtd }}</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        <th>{{ total }} KZs</th>
                                    </tr>
                                </tfoot>
                            </table>
							<div class="payment_item">
								<div class="radion_btn">
									<input type="radio" id="transfer" v-model="data.payment" value="transfer" />
									<label for="transfer">Transferência</label>
                                    <div class="radio-content">
                                        <p>IBAN: <strong>AO06.0000.0349.5839.1011.8</strong></p>
                                    </div>
									<div class="check"></div>
								</div> 
                                                               
								<div class="radion_btn">
									<input type="radio" id="deposit" v-model="data.payment" value="deposit" />
									<label for="deposit">Depósito</label>
                                    <div class="radio-content">
                                        <p>Banco: <strong>BAI</strong>
                                        <br />Conta: <strong>0349.5839.10.11</strong></p>
                                    </div>
									<div class="check"></div>
								</div>
                                
								<div class="radion_btn">
									<input type="radio" id="cash" v-model="data.payment" value="cash" />
									<label for="cash">Pagamento a mão</label>
									<div class="check"></div>
								</div>
							</div>
							<a class="main_btn" @click="buy()">Terminar compra</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Checkout Area =================-->

</template>

<script>
    export default {
        props: ['auth'],
        mounted() {
            this.verificaCarrinho(),
            this.getData(),
            this.calculaTotal(),
            this.verificaAutenticacao()
        },

        data() {
            return {
                carts: [],
                total: 0,
                button: 'Aplicar cupão',
                data: {
                    user_id: null,
                    first_name: '',
                    last_name: '',
                    address: '',
                    phone: '',
                    email: '',
                    status: 'start',
                    cupao: '',
                    cart: [],
                    payment: '',
                    amount: 0
                }
            }
        },

        methods: {
            getData() {
                if(JSON.parse(localStorage.getItem('cart')))
                    this.carts = JSON.parse(localStorage.getItem('cart'))
                else
                    this.carts = []

            },

            addCode() {
                this.button = 'Alterar cupão'
                swal('Sucesso', 'Código enviado', 'success')
            },

            calculaTotal() {
                this.carts.forEach(key => {
                    this.total_product = key.price * key.qtd
                    this.total += this.total_product
                    this.data.amount = this.total
                })
            },

            verificaAutenticacao() {
                if(this.auth != null){
                    this.data.user_id = this.auth.id
                    return true
                } else {
                    return false
                }
            },

            verificaCarrinho() {
                if(localStorage.getItem('cart') == [])
                    window.location = '/'
            },

            buy() {
                this.data.cart = this.carts
                axios
                    .post('../../api/checkout/buy', this.data)
                    .then(result => {
                        localStorage.setItem('cart', [])
                        swal(result.data.result.title, result.data.result.message, result.data.result.type)
                        window.location = "../../product/confirmation/?cart=" + JSON.stringify(result.data.result.cart) + "&sale=" + JSON.stringify(result.data.result.sale)
                    }).catch(error => console.log(error))
            }
        }
    }
</script>