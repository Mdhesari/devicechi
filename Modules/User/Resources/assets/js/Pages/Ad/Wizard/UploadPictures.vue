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
                    accept="image/jpeg, image/jpg, image/png"
                    ref="pictures"
                    @change="updatePhotoList"
                    multiple
                    :placeholder="__('ads.form.placeholder.upload.init')"
                    :drop-placeholder="__('ads.form.placeholder.upload.drop')"
                ></b-form-file>
                <p class="text-danger">
                    {{ picture_error ? picture_error : form.error("pictures") }}
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
                    <b-progress
                        v-if="picture.id && picture.id == progress_id"
                        :value="progress_value"
                        :max="100"
                        animated
                    ></b-progress>
                    <div class="actions">
                        <b-button
                        class="btn-delete"
                        @click="removePicture(picture)"
                        >
                            <b-icon
                                icon="x-circle-fill"
                                aria-hidden="true"
                            ></b-icon>
                        </b-button>
                    </div>
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
            progress_id: null,
            progress_value: 0,
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
                peserveState: false,
                preserveScroll: true
            });
            // this.$emit("next");
        },
        updatePhotoList(ev) {
            const files = ev.target.files;

            if (this.pictures.length >= 9 || files.length >= 9) {
                this.picture_error = this.__("ads.form.error.pictures.max");
                return false;
            }

            this.picture_error = null;

            for (let i = 0; i < files.length; i++) {
                this.form.pictures.push(files[i]);

                this.pictures.push({
                    url: URL.createObjectURL(files[i]),
                    original_file: files[i]
                });
            }
        },
        progressTimer() {
            let vm = this;

            let setIntervalRef = setInterval(function() {
                vm.progress_value += 20;
                if (vm.progress_value >= 100) {
                    clearInterval(setIntervalRef);
                }
            }, 50);
        },
        async removePicture(picture) {
            let is_blob = "original_file" in picture;

            if (is_blob) {
                this.form.pictures = this.form.pictures.filter((el, index) => {
                    return (
                        el.name != picture.original_file.name &&
                        el.lastModified != picture.original_file.lastModified
                    );
                });
            } else {
                this.progress_id = picture.id;
                this.progressTimer();

                const response = await axios.post(
                    route("user.ad.step_phone_delete_picture"),
                    {
                        _method: "DELETE",
                        picture_id: picture.id
                    }
                );

                if (response.data.status) {
                    this.progress_value = 0;
                    this.progress_id = null;
                }
            }

            this.pictures = this.pictures.filter(el => {
                return el.url != picture.url;
            });
        }
    }
};
</script>
