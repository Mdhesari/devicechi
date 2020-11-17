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
                <label class="icon-upload-label" @click="openFileDialog">
                    <span class="mx-2">{{ label_text }}</span>
                    <b-icon-upload></b-icon-upload>
                </label>
                <b-form-file
                    accept="image/*"
                    id="picture-upload-input-file"
                    ref="pictures"
                    @change="updatePhotoList"
                    multiple
                    :drop-placeholder="__('ads.form.placeholder.upload.drop')"
                ></b-form-file>
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
                        v-if="picture.id && progress_ids.includes(picture.id)"
                        :value="progress_value"
                        :max="100"
                        variant="danger"
                        animated
                    ></b-progress>
                    <div class="actions">
                        <b-button
                            :disabled="
                                picture.id && progress_ids.includes(picture.id)
                            "
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

            <b-button
                v-if="pictures.length >= 3"
                variant="secondary"
                @click.prevent="next"
            >
                {{ __("global.next") }}
            </b-button>
        </form>
    </WizardStep>
</template>

<script>
import WizardStep from "../../../Components/WizardStep";
import Vue from "vue";

export default {
    components: {
        WizardStep
    },
    data() {
        return {
            progress_ids: [],
            progress_value: 0,
            pictures: this.getProp("pictures"),
            form: this.$inertia.form({
                pictures: []
            }),
            ad_picture_size_limit: this.getProp("ad_picture_size_limit"),
            files_limit_count: 9,
            label_text: this.__("ads.form.placeholder.upload.init")
        };
    },
    methods: {
        next(ev) {
            // go to next step
            this.form
                .post(route("user.ad.step_phone_pictures"), {
                    peserveState: false,
                    preserveScroll: true
                })
                .then(response => {
                    let error = null;

                    console.log(this.$inertia.page);

                    if ((error = this.form.error("pictures"))) {
                        this.$to(error);
                    }
                })
                .catch(error => {
                    console.log(error);
                });
            // this.$emit("next");
        },
        validateUploadedPicture(file) {
            let result = true;

            const file_size_in_MB = (file.size / 1024 / 1024).toFixed(2);

            if (file_size_in_MB > this.ad_picture_size_limit) {
                this.$to(
                    this.__("global.errors.ad.pictures.upload_limit.title"),
                    this.__("global.errors.ad.pictures.upload_limit.desc", {
                        max: this.ad_picture_size_limit
                    })
                );

                result = false;
            }

            if (
                file.type != "image/png" &&
                file.type != "image/png" &&
                file.type != "image/jpeg"
            ) {
                this.$to(
                    this.__("global.errors.ad.pictures.upload_type.title"),
                    this.__("global.errors.ad.pictures.upload_type.desc", {
                        max: this.ad_picture_size_limit
                    })
                );
                result = false;
            }

            return result;
        },
        updatePhotoList(ev) {
            const files = ev.target.files;

            const all_pictures_count = this.pictures.length + files.length;

            if (all_pictures_count >= this.files_limit_count) {
                this.$to(this.__("ads.form.error.pictures.max"));
                return false;
            }

            for (let i = 0; i < files.length; i++) {
                const validation_result = this.validateUploadedPicture(
                    files[i]
                );

                if (!validation_result) continue;

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
                this.progress_ids.push(picture.id);
                this.progressTimer();

                const response = await axios.post(
                    route("user.ad.step_phone_pictures"),
                    {
                        _method: "DELETE",
                        picture_id: picture.id
                    }
                );

                if (response.status == 200 && response.data.status) {
                    this.progress_value = 0;

                    this.progress_ids = this.progress_ids.filter(id => {
                        return id !== picture.id;
                    });
                }
            }

            this.pictures = this.pictures.filter(el => {
                return el.url != picture.url;
            });
        },
        openFileDialog() {
            this.$refs.pictures.$el.childNodes[0].click();
        }
    }
};
</script>
