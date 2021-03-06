<template>
	<header class="header-site">
		<div
			class="dark-back"
			:class="{
				active: showNavbar
			}"
			id="darkBack"
			@click="showNavbar = false"
		></div>
		<div class="container">
			<div class="top-header">
				<div class="right-side">
					<div class="logo-holder">
						<a href="#">
							<img src="../../img/mobile-logo.png" alt="" />
						</a>
					</div>
					<button
						type="button"
						class="btn city-btn"
						data-toggle="modal"
						data-target="#exampleModal"
					>
						<i class="fas fa-map-marker-alt"></i>
						<span>
							انتخاب شهر
						</span>
					</button>
				</div>
				<div class="middel-side">
					<nav
						class="main-menu"
						:class="{
							navActive: showNavbar
						}"
						id="mainMenu"
					>
						<div class="mobile-logo-holder">
							<img src="img/mainlogo.png" alt="" />
						</div>
						<ul>
							<li class="user-sign"><a href="#">ورود یا ثبت نام </a></li>
							<li class="user-sign"><a href="#">ثبت رایگان آگهی </a></li>
							<li><a href="#">صفحه اصلی</a></li>
							<li><a href="#">همه آگهی ها</a></li>
							<li><a href="#">تماس با ما</a></li>
							<li><a href="#">شرایط ثبت آگهی</a></li>
							<li><a href="#">اعلان ها</a></li>
						</ul>
					</nav>
				</div>
				<div class="left-side">
					<div class="user-actions">
						<a href="#">ورود یا ثبت نام</a>
						<a href="#" class="add-ads">ثبت رایگان آگهی</a>
					</div>
					<button class="burger-btn" id="burgerBtn" @click="showNavbar = true">
						<i class="fas fa-bars"></i>
					</button>
				</div>
			</div>
		</div>
	</header>
</template>

<script>
import Navbar from './Navigation'
import UserDropDown from '../Components/UserDropDown'

export default {
	props: ['user'],
	data() {
		return {
			showNavbar: false
		}
	},
	components: {
		Navbar,
		UserDropDown
	}
}
</script>
