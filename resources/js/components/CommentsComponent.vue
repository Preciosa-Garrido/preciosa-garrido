<template>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <div class="row">
            <div class="col-lg-6">
                <div class="comment_list">
                    <div v-for="comment in comments">
                        <div v-if="comment.user_id != null">
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex avatar">
                                        <img :src="'/storage/users/' + comment.foto" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <h4>{{ comment.first_name + ' ' + comment.last_name }}</h4>
                                        <h5>{{ comment.created_at }}</h5>
                                    </div>
                                </div>
                                <p class="text-justify">{{ comment.message }}</p>
                            </div>
                        </div>
                        <div v-else>
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex avatar">
                                        <img src="/storage/users/user_man.jpg" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <h4>{{ comment.full_name }}</h4>
                                        <h5>{{ comment.created_at }}</h5>
                                    </div>
                                </div>
                                <p class="text-justify">{{ comment.message }}</p>
                            </div>
                        </div>
                    </div>
                    <p v-if="comments.length == 0">Não há comentários para este produto</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="review_box">
                    <h4>Posta um comentário</h4>
                    <form class="row contact_form">
                        <div v-if="auth != null"></div>
                        
                        <div class="col-md-12" v-else>
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
                                <textarea name="message" v-model="data.message" class="form-control" rows="1" placeholder="Comentário"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="button" v-on:click="storeComment()" class="btn submit_btn">Comentar</button>
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
                comments: [],
                data: {
                    user_id: this.auth,
                    product_id: this.produto,
                    full_name: '',
                    email: '',
                    phone: '',
                    message: ''
                }
            }
        },

        methods: {
            getData() {
                axios.get('../../api/comments/' + this.produto)
                    .then(result => {
                        console.log(result)
                        this.comments = result.data.comments
                    })
                axios.get('../../api/products/' + this.produto)
                    .then(result => {
                        console.log(result)
                        this.product = result.data.product
                    })
            },

            storeComment() {
                axios
                    .post('../../api/comments/store', this.data)
                    .then(result => {
                        console.log(result)
                        if (result.data.success) {
                            this.getData();
                            setTimeout(_ => swal("", result.data.message, "success"), 1000)
                        }

                        this.data.full_name = ''
                        this.data.email = ''
                        this.data.phone = ''
                        this.data.message = ''
                    }).catch(error => console.log(error))
            }
        }
    }
</script>