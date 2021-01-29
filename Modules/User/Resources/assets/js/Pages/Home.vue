<template>
    <front-layout>
        <IntroductionSection></IntroductionSection>
        <HomeLoginSection></HomeLoginSection>
        <HomeIntroSection></HomeIntroSection>
    </front-layout>
</template>

<script>
import IntroductionSection from "./../Section/Introduction";
import HomeLoginSection from "./../Section/HomeLogin";
import HomeIntroSection from "./../Section/HomeIntro";
import FrontLayout from "./../Layouts/FrontLayout";
import AppSection from "./../Components/AppSection";

export default {
    components: {
        FrontLayout,
        IntroductionSection,
        AppSection,
        HomeLoginSection,
        HomeIntroSection
    }
};
</script>
