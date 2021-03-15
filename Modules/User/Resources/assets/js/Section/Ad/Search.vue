<template>
	<section class="search-bar-section">
		<div class="mini-container">
			<div class="search-bar">
				<b-form-input
					type="search"
					v-model="form.search"
					@focus="updateResult"
					@keyup="updateResult"
					@keyup.delete="restore"
					@blur="showResult = false"
					placeholder="دنبال چه گوشی می گردی "
				/>
				<button type="button" class="icon" @click="search">
					<img :src="url('images/search.svg')" alt="Search" />
				</button>
			</div>
			<transition name="fade">
				<div v-show="showResult" class="search-result">
					<ul class="list-group">
						<li class="list-group-item">
							<button
								type="button"
								class="btn btn-secondary"
								v-text="`جستجو عبارت ${form.search}`"
								@click="search"
							></button>
						</li>
						<li
							v-for="(item, index) in resultList"
							:key="index"
							class="list-group-item"
						>
							<a
								:href="
									route('user.ad.show', {
										ad: item.slug
									})
								"
								class="btn btn-link text-lead text-right"
							>
								<h5 v-text="item.title"></h5>
								<p v-text="item.state.city.name"></p>
								<div class="meta">
									<p>
										{{ formatMoney(item.price) }}
										<span>تومان</span>
									</p>
								</div>
							</a>
						</li>
					</ul>
				</div>
			</transition>
		</div>
	</section>
</template>

<script>
export default {
	props: {
		searchURL: {
			type: String,
			default: route('user.ad.home')
		}
	},
	data() {
		return {
			isLoading: false,
			showResult: false,
			form: this.$inertia.form({
				search: this.getProp('search')
			}),
			cityName: this.getProp('cityName', null),
			resultList: []
		}
	},
	methods: {
		updateResult() {
			if (this.form.search.length < 3) {
				this.showResult = false
				return
			}

			if (this.isLoading) return

			this.isLoading = true

			setTimeout(() => {
				axios
					.post(route('user.ad.home'), {
						q: this.form.search,
						city: this.cityName
					})
					.then((response) => {
						const data = response.data

						if (data.ads) this.resultList = data.ads.data

						this.isLoading = false
						this.showResult = true
					})
			}, 1000)
		},
		search() {
			this.$inertia.visit(
				route('user.ad.home', {
					q: this.form.search,
					city: this.cityName
				})
			)
		},
		restore() {
			this.resultList = []

			if (this.form.search.length < 1) this.showResult = false
		}
	}
}
</script>

<style scoped>
.list-group {
	max-height: 22rem;
	overflow-y: scroll;
}

.list-group-item {
	position: relative;
	border: none;
	border-bottom: 1px solid #eee;
}

.list-group-item .meta {
	position: absolute;
	left: 10%;
	top: 50%;
}

.mini-container {
	position: relative;
}

.search-result {
	position: absolute;
	top: 100%;
	width: 80%;
	z-index: 33;
}

.fade-enter-active,
.fade-leave-active {
	transition: opacity 0.3s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
	opacity: 0;
}
</style>
<!-- <section class="search-bar-section py-5">
			<div class="mini-container">
				<div class="search-bar">
					<input type="text" placeholder="دنبال چه گوشی می گردی " />
					<button type="button" class="icon">
						<img :src="url('images/search.svg')" alt="search icon" />
					</button>
				</div>
			</div>
		</section> -->
