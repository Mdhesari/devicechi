<template>
  <front-layout class="blob-0">
    <AppSection class="introduction">
      <b-container fluid="md">
        <div class="home-title">
          <h1>موبایل خود را بصورت آنلاین بفروشید</h1>
          <h2 class="sub-title">
            در سریعترین زمان ممکن موبایل کار کرده خود را به فروش برسانید و یا
            گوشی کارکرده بخرید.
          </h2>
        </div>
      </b-container>
    </AppSection>
    <login></login>

    <AppSection class="about-us">
      <b-container>
        <b-row>
          <b-col md="6">
            <h3>درباره ما بیشتر بدانید</h3>
            <p>
              وبسایت موبایل فور سل یک پلتفرم برای خرید و فروش گوشی های کارکرده
              میباشد.
            </p>
          </b-col>
          <b-col md="6">
            <div class="vector">
              <img
                src="../../assets/img/vectors/questions.svg"
                alt="About Us"
              />
            </div>
          </b-col>
        </b-row>
      </b-container>
    </AppSection>
  </front-layout>
</template>

<script>
// import AppLayout from './../Layouts/AppLayout'
import FrontLayout from "./../Layouts/FrontLayout";
import Login from "./../Forms/Login";
import AppSection from "./../Components/AppSection";

export default {
  components: {
    // AppLayout,
    FrontLayout,
    Login,
    AppSection,
  },
};
</script>
