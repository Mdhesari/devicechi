<template>
    <WizardStep
        :backLink="
            route('user.ad.step_phone_price', {
                ad: ad.slug
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
                    accept=".jpg, .jpeg"
                    id="picture-upload-input-file"
                    ref="pictures"
                    @change="updatePhotoList"
                    multiple
                    :drop-placeholder="__('ads.form.placeholder.upload.drop')"
                ></b-form-file>
            </b-form-group>

            <b-row class="upload-previews" v-if="form.pictures.length > 0">
                <UploadPreviewItem
                    v-for="(picture, index) in form.pictures"
                    @changeActivePicture="changeActivePicture(picture.id)"
                    :key="index"
                    :picture="picture"
                    :isActive="form.activePicture == picture.id"
                    @removePicture="removePicture(picture)"
                />
            </b-row>

            <b-alert show variant="info">
                <h6 v-text="__('ads.form.warning.upload.title')"></h6>
                <ul class="list-group">
                    <li>تصویر با کیفیت گرفته شود</li>
                    <li>
                        حجم تصویر کمتر از
                        {{ `${ad_picture_size_limit} مگابایت` }} باشد
                    </li>
                    <li>حداقل ۲ تصویر را آپلود کنید</li>
                </ul>
            </b-alert>

            <b-button
                v-if="form.pictures.length >= pictures_min_count"
                :disabled="isLoading"
                variant="secondary"
                @click.prevent="next"
            >
                {{ isLoading ? __("global.loading") : __("global.next") }}
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
            form: this.$inertia.form({
                activePicture: this.getProp("active_picture"),
                pictures: this.getProp("pictures")
            }),
            uploadForm: this.$inertia.form({
                pictures: []
            }),
            isLoading: false,
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
            if (!this.form.activePicture)
                return this.$to(this.__("ads.form.error.active-picture"));

            this.form
                .post(
                    route("user.ad.step_phone_pictures", {
                        ad: this.ad.slug
                    }),
                    {
                        peserveState: false,
                        preserveScroll: true
                    }
                )
                .then(response => {
                    //
                })
                .catch(error => {
                    this.$to(this.__("global.errors.common.title"));
                });
        },
        changeActivePicture(id) {
            this.form.activePicture = id;
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

            const all_pictures_count = this.form.pictures.length + files.length;

            if (all_pictures_count > this.pictures_limit_count) {
                this.$to(
                    this.__("ads.form.error.pictures.max", {
                        limit: this.pictures_limit_count
                    })
                );
                return false;
            }

            for (let i = 0; i < files.length; i++) {
                if (!this.validateUploadedPicture(files[i])) continue;

                this.uploadForm.pictures.push(files[i]);

                // this.pictures.push({
                //     url: URL.createObjectURL(files[i]),
                //     original_file: files[i]
                // });
            }

            this.isLoading = true;

            this.uploadForm
                .post(
                    route("user.ad.step_phone_pictures_upload", {
                        ad: this.ad.slug
                    }),
                    {
                        peserveState: false,
                        preserveScroll: true
                    }
                )
                .then(response => {
                    let error;

                    this.isLoading = false;

                    if ((error = this.form.error("pictures"))) {
                        this.$to(error);
                    } else {
                        this.uploadForm.pictures = [];
                        this.form.pictures = this.getProp("pictures");

                        if (!this.form.activePicture) {
                            this.form.activePicture = this.form.pictures[0].id;
                        }
                    }
                })
                .catch(error => {
                    this.$to(this.__("global.errors.common"));
                });
        },
        async removePicture(picture) {
            let is_blob = "original_file" in picture;

            if (is_blob) {
                this.uploadForm.pictures = this.uploadForm.pictures.filter(
                    (el, index) => {
                        return (
                            el.name != picture.original_file.name &&
                            el.lastModified !=
                                picture.original_file.lastModified
                        );
                    }
                );
            } else {
                if (this.form.activePicture == picture.id)
                    this.form.activePicture = null;

                const response = await axios.post(
                    route("user.ad.step_phone_pictures", {
                        ad: this.ad.slug
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

            this.form.pictures = this.form.pictures.filter(el => {
                return el.url != picture.url;
            });
        },
        openFileDialog() {
            this.$refs.pictures.$el.childNodes[0].click();
        }
    }
};
</script>
