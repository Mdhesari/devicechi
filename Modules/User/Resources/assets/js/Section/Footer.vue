<template>
	<footer class="footer-site" ref="footer">
		<div class="container">
			<div class="row">
				<!-- <div class="col-md-2">
                    <div class="social">
                        <a href="#" target="_blank" class="linkedin">
                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                        </a>
                        <a href="#" target="_blank" class="instagram">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="menu" class="text-center">
                        <ul>
                            <li>
                                <a href="#">درباره ی ما </a>
                            </li>
                            <li>
                                <a href="#">تماس با ما </a>
                            </li>
                            <li>
                                <a href="#">قوانین </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="copy-right">
                        کلیه حقوق مادی و معنوی این وبسایت محفوظ می باشد
                    </div>
                </div> -->
				<div class="col-md-3">
					<div class="footer-list">
						<div class="footer-list-heading">
							<h3>خدمات</h3>
						</div>
						<ul class="footer-list-links">
							<MenuItem
								v-for="(item, index) in navbar.main"
								:key="index"
								:item="item"
							></MenuItem>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer-list">
						<div class="footer-list-heading">
							<h3>آموزش</h3>
						</div>
						<ul class="footer-list-links">
							<MenuItem
								v-for="(item, index) in navbar.news"
								:key="index"
								:item="item"
							></MenuItem>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer-list">
						<div class="footer-list-heading">
							<h3>دسترسی سریع</h3>
						</div>
						<ul class="footer-list-links">
							<MenuItem
								v-for="(item, index) in navbar.help"
								:key="index"
								:item="item"
							></MenuItem>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer-list">
						<div class="footer-list-heading">
							<h3>شبکه های اجتماعی</h3>
						</div>
						<ul class="footer-social-links">
							<li>
								<a href="#"
									><i class="fa fa-linkedin" aria-hidden="true"></i
								></a>
							</li>
							<li>
								<a href="https://instagram.com/devicechi">
									<i class="fa fa-instagram" aria-hidden="true"></i
								></a>
							</li>
							<li>
								<a href="https://t.me/devicechi">
									<i class="fa fa-paper-plane-o" aria-hidden="true"></i
								></a>
							</li>
						</ul>
					</div>
					<div class="footer-logo">
						<inertia-link :href="route('user.home')">
							<img :src="url('images/mainlogo.png')" alt="Devicechi Logo" />
						</inertia-link>
					</div>
				</div>
			</div>
		</div>
	</footer>
</template>

<script>
import MenuItem from './../Components/Menu/MenuItem'

export default {
	components: {
		MenuItem
	},
	data() {
		return {
			navbar: this.getProp('footer_navbar'),
			user: this.getProp('user')
		}
	}
}
</script>
