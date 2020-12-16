<template>
	<div class="container-fluid">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						<h4 class="title">Registrar especificações para <span style="color: red">{{ product.product }}</span></h4>
					</div>
				</div>
				<div class="card-body">
					<div class="alert alert-warning" v-if="message != ''">
						{{ message }}
					</div>

					<form>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<input type="text" placeholder="Tipo de especificação" class="form-control" v-model="data.key" />
								</div>
								<div class="col-md-6">
									<input type="text" placeholder="Valor da especificação" class="form-control" v-model="data.value" />
								</div>
							</div>
						</div>

						<div class="form-group">
							<a class="btn btn-info btn-sm" @click.prevent="addSpecifications()">Adicionar especificações</a>
						</div>
					</form>

					<div class="sub-title">
						Especificações
					</div>

					<div class="table-responsive">
						<table class="table table-condensed">
							<thead>
								<tr>
									<th>Tipo de especificação</th>
									<th>Valor da especificação</th>
								</tr>
							</thead>

							<tbody>
								<tr v-for="specification in specifications">
									<td>{{ specification.key }}</td>
									<td>{{ specification.value }}</td>
									<td>
										<a @click.prevent="removeSpecifications(specification.key)" class="btn btn-danger btn-sm">Remover especificação</a>
									</td>
								</tr>
							</tbody>
						</table>	
					</div>
					<a @click.prevent="update()" class="btn btn-primary btn-sm">Actualizar</a>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['product'],

		mounted() {
			this.getData()
		},

		data() {
			return {
				categories: [],
				specifications: [],
				message: '',
				data: {
					key: '',
					value: ''					
				}
			}
		},

		methods: {
			getData() {
				this.specifications = JSON.parse(this.product.specifications)
			},

			addSpecifications() {
				if (!this.specifications) {this.specifications = []}
				this.specifications.push({key: this.data.key, value: this.data.value})
				this.data.key = ''
				this.data.value = ''
			},

			removeSpecifications(specification) {
				var remove = this.specifications

				this.specifications = []

				remove.forEach(key => {
					if (key.key != specification) {
						this.specifications.push(key)
					}
				})

				this.data.key = ''
				this.data.value = ''
			},

			update() {
				axios
					.put('/api/specifications/update/' + this.product.id, {'data': JSON.stringify(this.specifications)})
					.then(result => {
						this.message = result.data.message
					}).catch(error => console.log(error))
			}
		}
	}
</script>