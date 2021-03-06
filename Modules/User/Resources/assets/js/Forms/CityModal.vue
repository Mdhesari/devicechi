<template>
	<b-modal v-model="isActive">
		<div class="search-box">
			<input type="text" name="" id="" placeholder="جستوجو سریع شهر" />
			<button type="submit" class="search-btn">
				<i class="fas fa-search"></i>
			</button>
		</div>
		<div class="row cities">
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 city">
				<div class="inner">
					<a href="#">
						تهران
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-6 city">
				<div class="inner">
					<a href="#">
						مشهد
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-6 city">
				<div class="inner">
					<a href="#">
						اصفهان
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 city">
				<div class="inner">
					<a href="#">
						شیراز
					</a>
				</div>
			</div>
		</div>

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
export default {
	data() {
		return {
			isActive: false
		}
	},
	methods: {
		activateModal() {
			this.isActive = true
		}
	}
}
</script>
