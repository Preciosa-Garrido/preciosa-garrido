<template>

    <!--================Order Details Area =================-->
    <section class="order_details p_150">
        <div class="container">
            <h3 class="title_confirmation">Obrigado por negociar conosco. Os teus produtos serão enviados.</h3>
            <div class="row order_d_inner">
                <div class="col-lg-6">
                    <div class="details_item">
                        <h4>Informações de compra</h4>
                        <ul class="list">
                            <li>
                                <a href="#">
                                    <span>Data</span> : {{ sale.created_at }}
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span>Método de pagamento</span> :
                                        <b v-if="sale.payment == 'deposit'">Depósito</b>
                                        <b v-else-if="sale.payment == 'transfer'">Tranferência</b>
                                        <b v-else>Pagamento a mão</b>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span>Total</span> : {{ sale.amount }} KZs
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="details_item">
                        <h4>Infirmações de residência</h4>
                        <ul class="list">
                            <li>
                                <a href="#">
                                    <span>{{ sale.address }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="order_details_table col-lg-12">
                <h2>Outros detalhes</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><h5>Produto</h5></th>
                                <th scope="col"><h5>Preço</h5></th>
                                <th scope="col"><h5>Quantidade</h5></th>
                                <th scope="col"><h5>Total</h5></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="carrinho in cart">
                                <td><p>{{ carrinho.product }}</p></td>
                                <td><p>{{ carrinho.price }} KZs</p></td>
                                <td><p>x{{ carrinho.qtd }}</p></td>
                                <td><p>{{ carrinho.price * carrinho.qtd }} KZs</p></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Order Details Area =================-->

</template>

<script>
    export default {
        props: ['sale', 'cart']
    }
</script>