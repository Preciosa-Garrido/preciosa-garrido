<template>
	<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
		<div class="table-responsive">
			<table class="table">
				<tbody>
					<tr v-for="specification in specifications">
						<td>
							<h5>{{ specification.key }}</h5>
						</td>
						<td>
							<h5>{{ specification.value }}</h5>
						</td>
					</tr>

					<tr v-if="specifications.length == 0">
						<td colspan="2">Não há especificações para este produto</td>
					</tr>
				</tbody>
			</table>
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
				specifications: []
			}
		},

		methods: {
			getData() {
				if(this.product.specifications) {
					this.specifications = JSON.parse(this.product.specifications)
				} else { this.specifications = [] }
			}
		}
	}
</script>