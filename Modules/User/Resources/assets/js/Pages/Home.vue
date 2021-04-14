<template>
	<AuthLayout :user="user">
		<section class="banner-site">
			<div class="container">
				<div class="row">
					<div class="h1holder">
						<h1>دیوایس چی مرجع تخصصی</h1>
						<h3>خرید، فروش و تعمیرات لوازم الکترونیکی</h3>
					</div>
				</div>
			</div>
		</section>
		<SearchSection class="py-5" />
		<section class="step-section py-5">
			<div class="container">
				<div class="main-title">
					<h2>
						گام های خرید و فروش
					</h2>
				</div>
				<div class="row steps">
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 step">
						<div class="inner">
							<div class="icon">
								<img :src="url('images/get-price.png')" alt="" />
							</div>
							<div class="title">
								<h3>
									جستجو و بررسی
								</h3>
							</div>
							<div class="desc">
								<p>
									بررسی گوشی های متنوع و مورد علاقه موجود در وبسایت یا اگر قصد
									فروش دارید وارد کردن اطلاعات گوشی
								</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 step">
						<div class="inner">
							<div class="icon">
								<img :src="url('images/book-pickup.png')" alt="" />
							</div>
							<div class="title">
								<h3>
									انتخاب و تماس
								</h3>
							</div>
							<div class="desc">
								<p>
									انتخاب گوشی مورد نظر و تماس با دارنده برای دریافت گوشی یا اگر
									فروشنده هستید توافق نهایی برای ارسال کالا به خریدار
								</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 step">
						<div class="inner">
							<div class="icon">
								<img :src="url('images/get-paid.png')" alt="" />
							</div>
							<div class="title">
								<h3>
									پرداخت و دریافت
								</h3>
							</div>
							<div class="desc">
								<p>
									پرداخت مبلغ و دریافت نهایی کالا یا اگر فروشنده هستید توافق
									نهایی برای ارسال کالا و هزینه
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<NormalAdsSection :ads="ads"></NormalAdsSection>
		<section class="why-us-section py-5">
			<div class="container">
				<div class="main-title">
					<h2>
						چرا ما ؟
					</h2>
				</div>
				<div class="row why-us-boxes">
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 why-us-box">
						<div class="inner">
							<div class="right-layout">
								<i class="fa fa-star" aria-hidden="true"></i>
							</div>
							<div class="left-layout">
								<div class="title">
									<h3>
										محصولات خاص و با کیفیت
									</h3>
								</div>
								<div class="desc">
									<p>
										اگر به دنبال محصولاتی خاص با بهترین کیفیت‌اید، در این سایت
										بهترین گزینه‌ها را مشاهده خواهیدکرد.
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 why-us-box">
						<div class="inner">
							<div class="right-layout">
								<i class="fa fa-check" aria-hidden="true"></i>
							</div>
							<div class="left-layout">
								<div class="title">
									<h3>
										خرید و فروش مطمئن
									</h3>
								</div>
								<div class="desc">
									<p>
										در دیوایس‌چی می توانید در کوتاه ترین مدت و با اطمینان کامل،
										دستگاهتان را خرید و فروش کنید.
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 why-us-box">
						<div class="inner">
							<div class="right-layout">
								<i class="fa fa-usd" aria-hidden="true"></i>
							</div>
							<div class="left-layout">
								<div class="title">
									<h3>
										قیمت مناسب
									</h3>
								</div>
								<div class="desc">
									<p>
										چه برای خرید و چه برای فروش، با قیمت های بسیار مناسب و عالی،
										رو به رو خواهید شد.
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 why-us-box">
						<div class="inner">
							<div class="right-layout">
								<i class="fa fa-thumbs-up" aria-hidden="true"></i>
							</div>
							<div class="left-layout">
								<div class="title">
									<h3>
										سهولت در انتخاب
									</h3>
								</div>
								<div class="desc">
									<p>
										با وجود تعدد گزینه‌ها در این سایت، اما می توانید به سادگی
										محصول مورد نظرتان را پیدا کنید.
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 why-us-box">
						<div class="inner">
							<div class="right-layout">
								<i class="fa fa-tag" aria-hidden="true"></i>
							</div>
							<div class="left-layout">
								<div class="title">
									<h3>
										مشاوره رایگان
									</h3>
								</div>
								<div class="desc">
									<p>
										با مشاوران حرفه‌ای این مجموعه، می‌توانید در خصوص خرید و فروش
										گوشیتان مشاوره رایگان دریافت کنید.
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 why-us-box">
						<div class="inner">
							<div class="right-layout">
								<i class="fa fa-headphones" aria-hidden="true"></i>
							</div>
							<div class="left-layout">
								<div class="title">
									<h3>
										پشتیبانی حرفه ای
									</h3>
								</div>
								<div class="desc">
									<p>
										تیم پشتیبانی مجموعه دیوایس‌چی، به صورت حرفه‌ای آماده
										پاسخگویی به شما در هر زمان و مکانی هستند.
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<BrandsSection :brands="brands"></BrandsSection>
		<!-- <section class="blog-lists py-5">
			<div class="container">
				<div class="main-title">
					<h2>
						بلاگ ها
					</h2>
				</div>
				<div class="row blogs">
					<div class="col-lg-4 col-md-6 col-sm-4 col-xs-12 blog">
						<div class="inner">
							<a href="#" class="fulllink"></a>
							<div
								class="thumbnail"
								style="background-image: url('https://images.unsplash.com/photo-1574675904801-eb2cca16af12?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1451&q=80');"
							></div>
							<div class="details">
								<div class="title">
									<h3>پرچمدار های سال جدید</h3>
								</div>
								<div class="meta-holder">
									<span class="date">
										16 اسفند 1399
									</span>
									<span class="time-duration">
										<i class="fa fa-clock-o" aria-hidden="true"></i>
										خواندن : 5 دقیقه
									</span>
								</div>
								<div class="desc">
									<p>
										از آنجا که لورم ایپسوم، شباهت زیادی به متن های واقعی دارد،
										طراحان معمولا از لورم ایپسوم استفاده میکنند تا فقط به مشتری
										یا کار فرما نشان دهند که قالب طراحی شده بعد از اینکه متن در
										آن قرار میگرد چگونه خواهد بود و فونت ها و اندازه ها چگونه در
										نظر گرفته شده است.
									</p>
								</div>
							</div>
							<div class="read-more">
								<a href="#">مشاهده بیشتر</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-4 col-xs-12 blog">
						<div class="inner">
							<a href="#" class="fulllink"></a>
							<div
								class="thumbnail"
								style="background-image: url('https://images.unsplash.com/photo-1574675904801-eb2cca16af12?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1451&q=80');"
							></div>
							<div class="details">
								<div class="title">
									<h3>پرچمدار های سال جدید</h3>
								</div>
								<div class="meta-holder">
									<span class="date">
										16 اسفند 1399
									</span>
									<span class="time-duration">
										<i class="fa fa-clock-o" aria-hidden="true"></i>
										خواندن : 5 دقیقه
									</span>
								</div>
								<div class="desc">
									<p>
										از آنجا که لورم ایپسوم، شباهت زیادی به متن های واقعی دارد،
										طراحان معمولا از لورم ایپسوم استفاده میکنند تا فقط به مشتری
										یا کار فرما نشان دهند که قالب طراحی شده بعد از اینکه متن در
										آن قرار میگرد چگونه خواهد بود و فونت ها و اندازه ها چگونه در
										نظر گرفته شده است.
									</p>
								</div>
							</div>
							<div class="read-more">
								<a href="#">مشاهده بیشتر</a>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-4 col-xs-12 blog">
						<div class="inner">
							<a href="#" class="fulllink"></a>
							<div
								class="thumbnail"
								style="background-image: url('https://images.unsplash.com/photo-1574675904801-eb2cca16af12?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1451&q=80');"
							></div>
							<div class="details">
								<div class="title">
									<h3>پرچمدار های سال جدید</h3>
								</div>
								<div class="meta-holder">
									<span class="date">
										16 اسفند 1399
									</span>
									<span class="time-duration">
										<i class="fa fa-clock-o" aria-hidden="true"></i>
										خواندن : 5 دقیقه
									</span>
								</div>
								<div class="desc">
									<p>
										از آنجا که لورم ایپسوم، شباهت زیادی به متن های واقعی دارد،
										طراحان معمولا از لورم ایپسوم استفاده میکنند تا فقط به مشتری
										یا کار فرما نشان دهند که قالب طراحی شده بعد از اینکه متن در
										آن قرار میگرد چگونه خواهد بود و فونت ها و اندازه ها چگونه در
										نظر گرفته شده است.
									</p>
								</div>
							</div>
							<div class="read-more">
								<a href="#">مشاهده بیشتر</a>
							</div>
						</div>
					</div>
					<div class="more">
						<a href="#">
							مشاهده بیشتر
							<i class="fa fa-arrow-left" aria-hidden="true"></i>
						</a>
					</div>
				</div>
			</div>
		</section> -->
	</AuthLayout>
</template>

<script>
import AuthLayout from './../Layouts/FrontAuthLayout'
import BrandsSection from './../Components/Sections/BrandsSection'
import SearchSection from './../Section/Ad/Search'
import NormalAdsSection from './../Components/Sections/NormalAdsSection'

export default {
	props: ['user', 'brands', 'ads'],
	components: {
		AuthLayout,
		BrandsSection,
		SearchSection,
		NormalAdsSection
	}
}
</script>
