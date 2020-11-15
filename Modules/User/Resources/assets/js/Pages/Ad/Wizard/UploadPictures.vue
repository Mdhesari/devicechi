<template>
    <WizardStep :backLink="route('user.ad.step_phone_price')">
        <form class="browse-pictures-form" @submit.prevent="next">
            <p class="form-title">
                {{ __("ads.wizard.upload_picture.title") }}
            </p>
            <p class="form-desc">
                {{ __("ads.wizard.upload_picture.desc") }}
            </p>

            <b-form-file
                accept="image/jpeg, image/jpg, image/png"
                ref="pictures"
                @change="updatePhotoList"
                multiple
                v-model="form.pictures"
                :state="Boolean(form.pictures)"
                :placeholder="__('ads.form.placeholder.upload.init')"
                :drop-placeholder="__('ads.form.placeholder.upload.drop')"
            ></b-form-file>

            <b-row class="upload-previews" v-if="pictures.length > 0">
                <b-col
                    class="preview-item"
                    sm="6"
                    md="4"
                    lg="2"
                    v-for="(picture, index) in pictures"
                    :key="index"
                >
                    <img class="fluid" :src="picture.url" alt="Image" />
                </b-col>
            </b-row>

            <b-button variant="secondary" @click.preven="next">
                {{ __("global.next") }}
            </b-button>
        </form>
    </WizardStep>
</template>

<script>
import WizardStep from "../../../Components/WizardStep";

export default {
    components: {
        WizardStep
    },
    data() {
        return {
            pictures: [],
            form: this.$inertia.form({
                pictures: []
            })
        };
    },
    methods: {
        next(variant_id) {
            // upload pictures
            // go to next step
            // this.$emit("next");
        },
        updatePhotoList(ev) {
            const files = ev.target.files;

            for (let i = 0; i < files.length; i++) {
                console.log(URL.createObjectURL(files[i]));

                this.pictures.push({
                    file: files[i],
                    url: URL.createObjectURL(files[i])
                });
            }
        }
    }
};
</script>
