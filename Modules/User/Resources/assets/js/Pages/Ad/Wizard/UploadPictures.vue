<template>
    <WizardStep
        :backLink="
            route('user.ad.step_phone_price', {
                ad: ad.id
            })
        "
    >
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
                <UploadPreviewItem
                    v-for="(picture, index) in pictures"
                    :key="index"
                    :picture="picture"
                    @removePicture="removePicture(picture)"
                />
            </b-row>

            <b-button
                v-if="pictures.length >= pictures_min_count"
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
import UploadPreviewItem from "../../../Components/UploadPreviewItem";

export default {
    components: {
        WizardStep,
        UploadPreviewItem
    },
    data() {
        return {
            pictures: this.getProp("pictures"),
            form: this.$inertia.form({
                pictures: []
            }),
            ad_picture_size_limit: this.getProp("ad_picture_size_limit"),
            pictures_limit_count: this.getProp("ad_pictures_max_count"),
            pictures_min_count: this.getProp("ad_pictures_min_count"),
            label_text: this.__("ads.form.placeholder.upload.init"),
            validFileTypes: this.getProp("ad_pictures_format"),
            ad: this.getProp("ad")
        };
    },
    methods: {
        next(ev) {
            // go to next step
            this.form
                .post(
                    route("user.ad.step_phone_pictures", {
                        ad: this.ad.id
                    }),
                    {
                        peserveState: false,
                        preserveScroll: true
                    }
                )
                .then(response => {
                    let error = null;

                    if ((error = this.form.error("pictures"))) {
                        this.$to(error);
                    }
                })
                .catch(error => {
                    this.$to(this.__("global.errors.common"));
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

            if (!this.validFileTypes.includes(file.type)) {
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

            if (all_pictures_count > this.pictures_limit_count) {
                this.$to(
                    this.__("ads.form.error.pictures.max", {
                        limit: this.pictures_limit_count
                    })
                );
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
                const response = await axios.post(
                    route("user.ad.step_phone_pictures", {
                        ad: this.ad.id
                    }),
                    {
                        _method: "DELETE",
                        picture_id: picture.id
                    }
                );

                if (response.status == 200 && response.data.status) {
                    // success
                } else {
                    // error
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
