<template>
    <div class="tab-panel fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
        <div class="row">
            <div class="col-lg-6">
                <div class="row total_rate">
                    <div class="col-12">
                        <div class="box_total">
                            <h5>{{ product.product }}</h5>
                            <h4>Tem</h4>
                            <h6>({{ count }} avaliações)</h6>
                        </div>
                    </div>
                </div>
                <div class="review_list">
                    <div v-for="review in reviews" class="review_item">
                        <div class="media" v-if="review.user_id != null">
                            <div class="d-flex avatar">
                                <img :src="'/storage/users/' + review.foto" alt="" />
                            </div>
                            <div class="media-body">
                                <h4>
                                    {{ review.first_name }} 
                                    {{ review.last_name }}
                                </h4>

                                <ul class="list avalia" id="avaliacao">
                                    <li v-for="cycle in 5" style="float: left">
                                        <span>
                                            <i v-if="review.stars_number < cycle" style="color: blue" class="fa fa-star"></i>
                                            <i v-else style="color: #fbd600" class="fa fa-star"></i>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="media" v-else>
                            <div class="d-flex avatar">
                                <img src="/storage/users/user_man.jpg" alt="" />
                            </div>
                            <div class="media-body">
                                <h4>
                                    {{ review.full_name }}
                                </h4>

                                <ul class="list avalia" id="avaliacao">
                                    <li v-for="cycle in 5" style="float: left">
                                        <span>
                                            <i v-if="review.stars_number < cycle" style="color: blue" class="fa fa-star"></i>
                                            <i v-else style="color: #fbd600" class="fa fa-star"></i>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        {{ review.review }}
                    </div>
                    <div v-if="reviews.length == 0">
                        Não há avaliações para este produto
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="review_box">
                    <h4>Adicionar uma avaliação</h4>
                    <p>Tua classificação: </p>
                    <ul class="list avalia" id="avaliacao">
                        <li v-for="cycle in 5">
                            <span class="avaliacao" v-on:click="marca(cycle)" :data-avaliacao="cycle">
                                <i class="fa fa-star"></i>
                            </span>
                        </li>
                    </ul>

                    <form class="row contact_form">
                        <div class="col-md-12" v-if="auth == null">
                            <div>
                                <div class="form-group">
                                    <input type="text" name="full_name" v-model="data.full_name" class="form-control" placeholder="Insira o teu nome completo">
                                </div>
                            </div>
                            <div>
                                <div class="form-group">
                                    <input type="email" name="email" v-model="data.email" class="form-control" placeholder="Endereço de e-mail">
                                </div>
                            </div>
                            <div>
                                <div class="form-group">
                                    <input type="text" name="phone" v-model="data.phone" class="form-control" placeholder="Nº de telefone">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="review" v-model="data.review" class="form-control" rows="1" placeholder="Comentário"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="button" v-on:click="storeReview()" class="btn submit_btn">Postar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['produto', 'auth'],

        mounted() {
            this.getData()
        },

        data() {
            return {
                product: [],
                reviews: [],
                count: null,
                id: [],
                cycle: 0,
                data: {
                    user_id: this.auth,
                    product_id: this.produto,
                    full_name: '',
                    email: '',
                    phone: '',
                    review: '',
                    stars_number: 0,
                }
            }
        },
        methods: {
            getData(){
                axios
                    .get('../../api/reviews/' + this.produto)
                    .then(result => {
                        this.reviews = result.data.reviews
                        this.count = result.data.count
                    })
                    .catch(error => console.log(error))
                axios
                    .get('../../api/products/' + this.produto)
                    .then(result => {
                        this.product = result.data
                    }).catch(error => console.log(error))
            },

            storeReview() {
                axios
                    .post('../../api/reviews/store', this.data)
                    .then(result => {
                        console.log(result)
                        if (result.data.success) {
                            this.getData();
                            setTimeout(_ => swal("", result.data.message, "success"), 1000)
                        }

                        $('.review_box ul.list')
                            .removeClass('star1')
                            .removeClass('star2')
                            .removeClass('star3')
                            .removeClass('star4')
                            .removeClass('star5')

                        this.data.full_name = ''
                        this.data.email = ''
                        this.data.phone = ''
                        this.data.review = ''
                        this.data.stars_number = 0
                    }).catch(error => console.log(error))
            },

            marca(number) {
                this.data.stars_number = number
            }
        }
    }
</script>

<style>
    .review_list {
        overflow: scroll;
        height: 40em;
    }
</style>