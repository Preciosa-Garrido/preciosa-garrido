<template>

    <!-- Start Count Down Area -->
    <div class="countdown-area">
        <div class="container">
            <div class="countdown-content">
                <div class="title text-center">
                    <h1 class="mb-10">Nossa melhor promoção</h1>
                    <p>Veja o que nós temos de melhor para si.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-4"></div>
                <div class="col-xl-6 col-lg-7">
                    <div class="countdown d-flex justify-content-center justify-content-md-end" id="js-countdown">
                        <div class="countdown-item">
                            <div class="countdown-timer js-countdown-days time" aria-labelledby="day-countdown">
                                5
							</div>

                            <div class="countdown-label" id="day-countdown">Dias</div>
                        </div>

                        <div class="countdown-item">
                            <div class="countdown-timer js-countdown-hours" aria-labelledby="hour-countdown">
                                10
                            </div>

                            <div class="countdown-label" id="hour-countdown">Horas</div>
                        </div>

                        <div class="countdown-item">
                            <div class="countdown-timer js-countdown-minutes" aria-labelledby="minute-countdown">
                                56
                            </div>

                            <div class="countdown-label" id="minute-countdown">Minutos</div>
                        </div>

                        <div class="countdown-item">
                            <div class="countdown-timer js-countdown-seconds" aria-labelledby="second-countdown">
                                12
                            </div>

                            <div class="countdown-label text" id="second-countdown">Segundos</div>
                        </div>
                        
                        <a @click="storeCart(product)" class="view-btn primary-btn2">
                            <span class="lnr lnr-cart"></span>
                            <span>Carrinho</span>
                        </a>
                        <img src="" style="padding-top: 50px" class="img-fluid cd-img" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Count Down Area -->

</template>

<script>
    export default {
        props: ['product', 'time', 'data'],

        mounted() {
            this.getData()
        },

        data() {
            return {
                
            }
        },
        
        methods: {
            getData() {
                console.log(this.data.data[0])
            },

            storeCart(product) {
                var produtos = {
                    'product_id': product.id,
                    'product': product.product,
                    'price': product.price,
                    'stock': product.stock,
                    'barcode': product.barcode,
                    'image': product.image,
                    'description': product.description,
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

            calculaFimPromocao() {
                
            }
        },
    }
</script>