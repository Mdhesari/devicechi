<template>
	<b-modal v-model="isActive">
		<div class="search-box">
			<input
				v-model="searchText"
				type="text"
				@keyup="searchCities"
				name="searchCity"
				placeholder="جستوجو سریع شهر"
			/>
			<button type="submit" class="search-btn">
				<i class="fas fa-search"></i>
			</button>
		</div>
		<div class="row cities justify-content-center" v-show="!isLoading">
			<b-alert
				variant="warning"
				class="d-block mx-auto"
				:show="cities.length < 1"
			>
				{{
					__('ads.form.warning.nothing.cities', {
						city_name: searchText
					})
				}}
			</b-alert>

			<div
				v-for="(city, index) in cities"
				:key="index"
				class="col-lg-3 col-md-3 col-sm-12 col-xs-12 city"
			>
				<div class="inner">
					<inertia-link
						:href="
							route('user.ad.home', {
								city: city.name
							})
						"
					>
						{{ city.name }}
					</inertia-link>
				</div>
			</div>
		</div>

		<Spinner v-show="isLoading" />

		<template #modal-header>
			<h5 class="modal-title" id="exampleModalLabel">انتخاب شهر</h5>
			<button
				type="button"
				class="close"
				data-dismiss="modal"
				aria-label="Close"
			>
				<span aria-hidden="true">&times;</span>
			</button>
		</template>

		<template #modal-footer class="text-center">
			<span></span>
		</template>
	</b-modal>
</template>

<script>
import Spinner from '../Components/Spinner-progressing'

export default {
	components: {
		Spinner
	},
	data() {
		return {
			isActive: false,
			cities: [],
			searchText: '',
			isLoading: false
		}
	},
	mounted() {
		this.search()
	},
	methods: {
		activateModal() {
			this.isActive = true
		},
		searchCities() {
			if (this.searchText.length < 3) {
				this.showResult = false
				return
			}

			if (this.isLoading) return

			this.isLoading = true

			this.search()
		},
		search() {
			axios
				.get(
					route('user.api.cities.get', {
						search: this.searchText
					})
				)
				.then((response) => {
					this.cities = response.data
				})
				.finally(() => (this.isLoading = false))
		}
	}
}
</script>
