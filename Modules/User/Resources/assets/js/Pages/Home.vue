<template>
  <front-layout class="home-bg">
    <IntroductionSection></IntroductionSection>
    <HomeLoginSection></HomeLoginSection>
  </front-layout>
</template>

<script>
import IntroductionSection from "./../Section/Introduction";
import HomeLoginSection from "./../Section/HomeLogin";
import FrontLayout from "./../Layouts/FrontLayout";
import AppSection from "./../Components/AppSection";

export default {
  components: {
    FrontLayout,
    IntroductionSection,
    AppSection,
    HomeLoginSection,
  },
};
</script>
