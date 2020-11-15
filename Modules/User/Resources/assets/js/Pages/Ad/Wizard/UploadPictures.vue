<template>
    <WizardStep :backLink="route('user.ad.step_phone_price')">
        <form class="browse-pictures-form" @submit.prevent="next">
            <p class="form-title">
                {{ __("ads.wizard.upload_picture.title") }}
            </p>
            <p class="form-desc">
                {{ __("ads.wizard.upload_picture.desc") }}
            </p>

            <b-form-group class="picture-upload-input">
                <b-form-file
                    :disabled="picture_error ? true : false"
                    accept="image/jpeg, image/jpg, image/png"
                    ref="pictures"
                    @change="updatePhotoList"
                    multiple
                    :placeholder="__('ads.form.placeholder.upload.init')"
                    :drop-placeholder="__('ads.form.placeholder.upload.drop')"
                ></b-form-file>
                <p class="text-danger">
                    {{ picture_error || form.errors.pictures }}
                </p>
            </b-form-group>

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

            <b-button variant="secondary" @click.prevent="next">
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
            pictures: this.getProp("pictures"),
            form: this.$inertia.form({
                pictures: []
            }),
            picture_error: null
        };
    },
    methods: {
        next(ev) {
            // go to next step
            this.form.post(route("user.ad.step_phone_pictures"), {
                peserveState: false
            });
            // this.$emit("next");
        },
        updatePhotoList(ev) {
            if (this.pictures.length >= 9) {
                this.picture_error = this.__("ads.form.error.pictures.max");
                return false;
            }

            this.picture_error = null;
            const files = ev.target.files;

            for (let i = 0; i < files.length; i++) {
                this.form.pictures.push(files[i]);

                this.pictures.push({
                    url: URL.createObjectURL(files[i])
                });
            }
        }
    }
};
</script>
