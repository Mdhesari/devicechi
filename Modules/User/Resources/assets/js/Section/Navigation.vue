<template>
	<nav
		class="main-menu"
		:class="{
			navActive: showNavbar
		}"
		id="mainMenu"
	>
		<div class="mobile-logo-holder">
			<img :src="url('images/logo.png')" alt="logo" />
		</div>
		<ul>
			<MenuItem
				v-for="(item, index) in items"
				:key="index"
				:item="item"
			></MenuItem>

			<li class="user-sign d-block d-md-none">
				<a :href="route('user.login')">ورود یا ثبت نام </a>
			</li>

			<!-- <li><a href="#">صفحه اصلی</a></li>
			<li><a href="#">همه آگهی ها</a></li>
			<li><a href="#">تماس با ما</a></li>
			<li><a href="#">شرایط ثبت آگهی</a></li>
			<li><a href="#">اعلان ها</a></li> -->
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
