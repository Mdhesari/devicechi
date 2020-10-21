<template>
  <front-layout>
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
