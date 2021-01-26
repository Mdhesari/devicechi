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
                            <form @submit.prevent="submitForm">
                                <div class="input-holder">
                                    <label for="name">نام شما</label>
                                    <input
                                        required
                                        id="name"
                                        v-model="form.name"
                                        type="text"
                                    />
                                </div>
                                <div class="input-holder">
                                    <label for="mobile">موبایل</label>
                                    <input
                                        required
                                        id="mobile"
                                        v-model="form.mobile"
                                        type="tel"
                                    />
                                </div>
                                <div class="input-holder">
                                    <label for="">موضوع</label>
                                    <b-form-select
                                        required
                                        v-model="form.subject"
                                        :options="subjects"
                                    ></b-form-select>
                                </div>
                                <div class="input-holder">
                                    <label for="text">پیام</label>
                                    <textarea
                                        required
                                        v-model="form.text"
                                        id="text"
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
import AuthLayout from "../Layouts/FrontAuthLayout";

export default {
    props: ["user"],
    components: {
        AuthLayout
    },
    data() {
        return {
            form: this.$inertia.form({
                name: "",
                mobile: "",
                subject: null,
                text: ""
            }),
            subjects: [
                {
                    value: null,
                    text: this.__("contact-us.subjects.default")
                },
                {
                    value: "adv",
                    text: this.__("contact-us.subjects.adv")
                },
                {
                    value: "bug_report",
                    text: this.__("contact-us.subjects.bug_report")
                },
                {
                    value: "participate",
                    text: this.__("contact-us.subjects.participate")
                },
                {
                    value: "abuse_report",
                    text: this.__("contact-us.subjects.abuse_report")
                }
            ]
        };
    },
    methods: {
        submitForm() {
            alert("hurraay!");
        }
    }
};
</script>
