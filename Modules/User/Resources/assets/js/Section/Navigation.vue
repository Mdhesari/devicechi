<template>
	<!-- Primary Navigation Menu -->
	<nav class="main-menu" id="mainMenu">
		<!-- Navigation Links -->
		<ul class="p-2">
			<li v-if="user">
				<inertia-link
					:href="route('user.ad.create')"
					class="btn btn-success btn-rounded-high btn-mobilesale"
				>
					<b-icon icon="plus-circle"></b-icon>
					<span class="btn-title">{{ __('ads.create.btn_title') }}</span>
				</inertia-link>
			</li>

			<li v-for="(nav, item) in navbar" :key="item">
				<inertia-link
					:class="{
						active: nav.is_active
					}"
					:href="nav.route"
				>
					{{ nav.title }}
				</inertia-link>
			</li>
		</ul>
	</nav>
</template>

<script>
export default {
	data() {
		return {
			navbar: this.getProp('menu_navbar'),
			user: this.getProp('user')
		}
	}
}
</script>
