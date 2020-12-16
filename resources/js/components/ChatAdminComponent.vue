<template>
    <section class="p_150 container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4 class="panel-title">Conversar com {{ admin.name }}</h4>
                    </div>
                    <div class="panel-body" style="overflow-y: scroll; height: 30em;">
                        <div v-for="layout in layouts">
                            <div v-if="layout.sender == 'user'">
                                <div class="alert alert-info col-md-10" style="border-radius: 10px">
                                    {{ layout.message }}
                                </div>
                            </div>
                            <div v-else>
                                <div class="alert alert-warning col-md-10" style="border-radius: 10px">
                                    {{ layout.message }}
                                </div>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-md-5 col-md-offset-1">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">Responder</h4>
                    </div>
                    <form v-on:submit.prevent="store" class="card-body">
                        <div class="form-group">
                            <textarea class="form-control" name="message" v-model="data.message" rows="4" placeholder="Escreva sua mensagem"></textarea>
                        </div>
                        <button class="btn btn-primary">
                            <span class="icon fa fa-paper-plane"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['admin', 'auth'],

        mounted() {
           this.getData()
        }, 

        data() {
            return {
                layouts: [],
                data: {
                    user_id: this.auth.id,
                    admin_id: this.admin.id,
                    gestor_id: null,
                    sender: 'user',
                    message: ''
                }
            }
        },

        methods: {
            getData(){
                axios
                    .get('../../api/chat/admin/' + this.auth.id + '/' + this.admin.id)
                    .then(result => {
                        console.log(result)
                        this.layouts = result.data.layouts
                    }).catch(error => console.log(error))
            },

            store() {
                axios
                    .post('../../api/chat/admin/store', this.data)
                    .then(result => {
                        console.log(result);
                        this.data.message = ''
                        this.getData()
                    }).catch(error => console.log(error))
            }
        }
    }
</script>