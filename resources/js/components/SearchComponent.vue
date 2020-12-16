<template>
	<div class="nav-items">
		<div class="search-area" style="float: left">
			<div>
				<input type="text" placeholder="Pesquisar" v-model="search" class="form-control" />
			</div>
		</div>

		<span class="icons item-menu" id="search-close">
			<i class="fa fa-close"></i>
		</span>

		<span class="icons item-menu" id="search-link">
			<i class="fa fa-search"></i>
		</span>

		<div class="resultados">
			<h3 align="center" class="title">Resultados da pesquisa</h3>
			<div style="padding: 10px" v-for="result in searchResults">
				<div>
					<h4><a :href="'/shop/product/' + result.id">{{ result.product }}</a></h4>
					<p>{{ result.description }}</p>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		mounted() {
			this.getData()
		},

		data() {
			return {
				results: [],
				search: ''
			}
		},

		methods: {
			getData() {
                axios
                    .get('/api/produtos')
                    .then(result => {
                        this.results = result.data
                        console.log(this.results)
                    }).catch(error => console.log(error))
                }
		}, 

		computed: {
            searchResults() {
                return this.results.filter(result => {
                    return(
                    	result.product.toLowerCase().includes(this.search.toLowerCase()) ||
                    	result.barcode.includes(this.search) ||
                    	result.description.toLowerCase().includes(this.search.toLowerCase())
                    );
                })
            }
		}
	}
</script>