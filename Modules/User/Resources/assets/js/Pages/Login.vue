<template>
    <AuthLayout :user="user">
        <IntroductionSection></IntroductionSection>
        <HomeLoginSection></HomeLoginSection>
        <HomeIntroSection></HomeIntroSection>
    </AuthLayout>
</template>

<script>
import IntroductionSection from "./../Section/Introduction";
import HomeLoginSection from "./../Section/HomeLogin";
import HomeIntroSection from "./../Section/HomeIntro";
import AuthLayout from "./../Layouts/FrontAuthLayout";
import AppSection from "./../Components/AppSection";

export default {
    props: ["user"],
    components: {
        AuthLayout,
        IntroductionSection,
        AppSection,
        HomeLoginSection,
        HomeIntroSection
    }
};
</script>
