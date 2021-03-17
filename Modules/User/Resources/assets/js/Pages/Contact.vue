<template>
	<AuthLayout :user="user">
		<section class="contact-us-holder">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-12">
						<div class="heading-holder">
							<h1 class="page-title">تماس با ما</h1>
						</div>
						<div class="des">
							فرم را پر کنید و تیم ما ظرف 24 ساعت به شما پاسخ می دهد.
						</div>
						<div class="contact-us-ways">
							<ul>
								<!-- <li>
                                    <div class="icon">
                                        <i
                                            class="fa fa-phone"
                                            aria-hidden="true"
                                        ></i>
                                    </div>
                                    <div class="info">
                                        <a href="tel:0123456">0123456</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i
                                            class="fa fa-envelope-open"
                                            aria-hidden="true"
                                        ></i>
                                    </div>
                                    <div class="info">
                                        <a href="mail:info@mfs.com"
                                            >info@mfs.com</a
                                        >
                                    </div>
                                </li> -->
								<li>
									<div class="info">
										<a href="mail:support@mobileforsale.ir">
											<span class="icon">
												<b-icon icon="mailbox"></b-icon>
											</span>
											<span>
												support@mobileforsale.ir
											</span>
										</a>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-6 col-md-12">
						<div class="contact-us-message">
							<form @submit.prevent="submitForm">
								<div class="input-holder">
									<label for="name">نام شما</label>
									<input
										required
										id="name"
										name="name"
										v-model="form.name"
										type="text"
									/>
									<p class="text-danger" v-text="form.errors.name"></p>
								</div>
								<div class="input-holder">
									<label for="mobile">موبایل</label>
									<input
										required
										id="mobile"
										name="mobile"
										v-model="form.mobile"
										type="tel"
									/>
									<p class="text-danger" v-text="form.errors.mobile"></p>
								</div>
								<div class="input-holder">
									<label for="subject">موضوع</label>
									<b-form-select
										id="subject"
										name="subject"
										required
										v-model="form.subject"
										:options="subjects"
									></b-form-select>
									<p class="text-danger" v-text="form.errors.subject"></p>
								</div>
								<div class="input-holder">
									<label for="text">پیام</label>
									<textarea
										id="text"
										name="text"
										required
										v-model="form.text"
										cols="30"
										rows="10"
										placeholder="پیام"
									></textarea>
									<p class="text-danger" v-text="form.errors.text"></p>
								</div>
								<div class="btn-message">
									<button class="btn btn-submit" type="submit">
										ثبت
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</AuthLayout>
</template>

<script>
import AuthLayout from '../Layouts/FrontAuthLayout'

export default {
	props: ['user'],
	components: {
		AuthLayout
	},
	data() {
		return {
			form: this.$inertia.form({
				name: '',
				mobile: '',
				subject: null,
				text: ''
			}),
			subjects: [
				{
					value: null,
					text: this.__('contact-us.subjects.default')
				},
				{
					value: 'adv',
					text: this.__('contact-us.subjects.adv')
				},
				{
					value: 'bug_report',
					text: this.__('contact-us.subjects.bug_report')
				},
				{
					value: 'suggestions',
					text: this.__('contact-us.subjects.suggestion')
				},
				{
					value: 'participate',
					text: this.__('contact-us.subjects.participate')
				},
				{
					value: 'abuse_report',
					text: this.__('contact-us.subjects.abuse_report')
				}
			]
		}
	},
	methods: {
		submitForm() {
			this.form.post(route('contact-us'), {
				preserveScroll: true,
				preserveState: (page) =>
					Object.keys(this.$inertia.page.props.errors).length
			})
		}
	}
}
</script>
