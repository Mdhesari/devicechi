<template>
    <authLayout :user="user">
        <section class="demo">
            <b-container>
                <div class="mt-4">
                    <b-alert show variant="info">
                        <h4 class="alert-heading">
                            {{ __("ads.demo.warning.title") }}
                        </h4>
                        <p>
                            {{ __("ads.demo.warning.desc") }}
                        </p>
                    </b-alert>
                </div>
                <SingleAd :ad="ad"></SingleAd>
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
        SingleAd,
    },
    props: ["ad", "user"]
};
</script>
