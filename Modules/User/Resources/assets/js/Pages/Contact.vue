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
                            فرم را پر کنید و تیم ما ظرف 24 ساعت به شما پاسخ می
                            دهد.
                        </div>
                        <div class="contact-us-ways">
                            <ul>
                                <li>
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
                                </li>
                                <li>
                                    <div class="icon">
                                        <i
                                            class="fa fa-life-ring"
                                            aria-hidden="true"
                                        ></i>
                                    </div>
                                    <div class="info">
                                        <a href="mail:info@mfs.com"
                                            >support@mfs.com</a
                                        >
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="contact-us-message">
                            <form action="#">
                                <div class="input-holder">
                                    <label for="">نام شما</label>
                                    <input type="text" />
                                </div>
                                <div class="input-holder">
                                    <label for="">ایمیل</label>
                                    <input type="text" />
                                </div>
                                <div class="input-holder">
                                    <label for="">پیام</label>
                                    <textarea
                                        name=""
                                        id=""
                                        cols="30"
                                        rows="10"
                                        placeholder="پیام"
                                    ></textarea>
                                </div>
                                <div class="btn-message">
                                    <button
                                        class="btn btn-submit"
                                        type="submit"
                                    >
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
import AuthLayout from "../../Layouts/FrontAuthLayout";

export default {
    props: ["user"],
    components: {
        AuthLayout
    }
};
</script>