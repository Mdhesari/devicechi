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
		<div class="container-md">
			<div class="top-header">
				<div class="right-side">
					<div class="logo-holder">
						<a :href="route('user.home')">
							<img :src="url('images/logo.png')" alt="" />
						</a>
					</div>
					<button
						type="button"
						class="btn city-btn"
						data-toggle="modal"
						@click="$refs.cityModal.activateModal()"
					>
						<i class="fas fa-map-marker-alt"></i>
						<span>
							{{ cityName }}
						</span>
					</button>
				</div>
				<div class="middel-side">
					<Navbar
						:class="{ navActive: showNavbar }"
						:showNavbar="showNavbar"
					></Navbar>
				</div>
				<div class="left-side">
					<div class="user-actions">
						<inertia-link v-if="!user" :href="route('user.login')" class="d-none d-lg-inline-block"
							>ورود یا ثبت نام</inertia-link
						>
						<UserDropDown v-if="user" :user="user"></UserDropDown>
						<inertia-link :href="route('user.ad.create')" class="d-none d-lg-inline-block add-ads">
							ثبت رایگان آگهی
						</inertia-link>
					</div>
					<button class="burger-btn" id="burgerBtn" @click="showNavbar = true">
						<i class="fas fa-bars"></i>
					</button>
				</div>
			</div>
		</div>
		<CityModal ref="cityModal" :isActive="showCityModal"></CityModal>
	</header>
</template>

<script>
import Navbar from './Navigation'
import UserDropDown from '../Components/UserDropDown'
import CityModal from '../Forms/CityModal'

export default {
	props: ['user'],
	data() {
		return {
			showNavbar: false,
			showCityModal: false,
			cityName: this.getProp('cityName', 'انتخاب شهر')
		}
	},
	components: {
		Navbar,
		UserDropDown,
		CityModal
	}
}
</script>
