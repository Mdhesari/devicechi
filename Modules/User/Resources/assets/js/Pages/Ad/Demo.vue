<template>
    <authLayout>
        <section class="demo">
            <SingleAd :ad="ad"></SingleAd>
        </section>
    </authLayout>
</template>

<script>
import AuthLayout from "../../Layouts/FrontAuthLayout";
import SingleAd from "../../Components/SingleAd";

export default {
    components: {
        AuthLayout,
        SingleAd
    },
    props: ["ad"]
};
</script>
