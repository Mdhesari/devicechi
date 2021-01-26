<template>
    <authLayout :user="user">
        <section class="demo">
            <b-container>
                <SingleAd :ad="ad" :accessories="accessories"></SingleAd>
            </b-container>
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
    props: ["ad", "user", "accessories"]
};
</script>
