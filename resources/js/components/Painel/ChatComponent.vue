<template>
    <section class="container-fluid">
		<div class="row">
			<div class="card col-md-6">
				<div class="card-header">
					<div class="card-title">
						<h4 class="title">Conversar com {{ cliente.first_name }}</h4>
					</div>
				</div>
				<div class="card-body" style="overflow-y: scroll; height: 30em;">
                    <div v-for="layout in layouts">
                        <div v-if="layout.sender == 'user'">
							<div class="alert alert-info col-md-10" style="border-radius: 10px">
								{{ layout.message }}
							</div>
                        </div>
                        <div v-else>
							<div class="alert alert-warning col-md-10 col-md-offset-2" style="border-radius: 10px">
								{{ layout.message }}
							</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card col-md-5 col-md-offset-1">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="title">Responder</h4>
                    </div>
                </div>
                <form v-on:submit.prevent="store" class="card-body">
					<input type="hidden" v-model="data.sender" />
					<textarea class="form-control" v-model="data.message" rows="4" placeholder="Escreva sua mensagem"></textarea>
					<button class="btn btn-primary">
						<span class="icon fa fa-paper-plane"></span>
					</button>
                </form>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['auth', 'cliente'],

        mounted() {
            this.getData()
        },

        data() {
            return {
                layouts: [],
                data: {
                    user_id: this.cliente.id,
                    gestor_id: this.auth.id,
                    sender: 'gestor',
                    message: ''
                }
            }
        },

        methods: {
            getData() {
                axios
                    .get('../../../api/painel/chat/' + this.auth.id + '/' + this.cliente.id)
                    .then(result => {
                        this.layouts = result.data.layouts
                    }).catch(error => console.log(error))
            },
            store() {
                axios
                    .post('../../../api/painel/chat/store', this.data)
                    .then(result => {
                        this.data.message = ''
                        this.getData()
                    }).catch(error => console.log(error))
            }
        }
    }
</script>