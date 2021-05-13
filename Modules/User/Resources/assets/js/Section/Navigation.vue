<template>
	<nav
		class="main-menu"
		:class="{
			navActive: showNavbar
		}"
		id="mainMenu"
	>
		<h2 class="d-none">منوی کاربری دیوایس چی</h2>
		<div class="mobile-logo-holder">
			<img :src="url('images/logo.png')" alt="logo" />
		</div>
		<ul>
			<li class="d-block d-md-none">
				<inertia-link :href="route('user.ad.create')" class="add-ads">
					ثبت رایگان آگهی
				</inertia-link>
			</li>
			<MenuItem
				v-for="(item, index) in items"
				:key="index"
				:item="item"
			></MenuItem>

			<li class="user-sign d-block d-md-none">
				<a :href="route('user.login')">ورود یا ثبت نام </a>
			</li>
		</ul>
	</nav>
</template>

<script>
import MenuItem from './../Components/Menu/MenuItem'

export default {
	props: ['showNavbar'],
	components: {
		MenuItem
	},
	data() {
		return {
			// navbar: this.getProp('menu_navbar'),
			items: this.getProp('main_menu_items'),
			user: this.getProp('user')
		}
	}
}
</script>
