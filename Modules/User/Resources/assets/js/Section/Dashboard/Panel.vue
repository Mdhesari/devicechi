<template>
    <section class="user-panel-section">
        <div class="container">
            <div class="row user-panel-main">
                <div class="col-md-4">
                    <div class="sidebar">
                        <inertia-link
                            :href="route('user.ad.create')"
                            class="btn btn-success btn-rounded-high btn-mobilesale"
                            >{{ __("ads.create.btn_title") }}</inertia-link
                        >
                        <ul class="tabs">
                            <li class="tab-profile">
                                <div class="avatar">
                                    <img src="img/person" alt="" />
                                </div>
                                <div class="username">
                                    {{ user.name }}
                                </div>
                            </li>
                            <li class="tab-item" :class="renderItemClass(null)">
                                <div class="tab-item-content">
                                    <a href="#" @click.prevent="updateAds(null)"
                                        >همه آگهی ها</a
                                    >
                                </div>
                            </li>
                            <li
                                class="tab-item"
                                :class="renderItemClass(allStatus.available)"
                            >
                                <div class="tab-item-content">
                                    <a
                                        @click.prevent="
                                            updateAds(allStatus.available)
                                        "
                                        href="#"
                                        >آگهی های ثبت شده</a
                                    >
                                </div>
                            </li>
                            <li
                                class="tab-item"
                                :class="renderItemClass(allStatus.pending)"
                            >
                                <div class="tab-item-content">
                                    <a
                                        @click.prevent="
                                            updateAds(allStatus.pending)
                                        "
                                        href=""
                                        >آگهی های در صف انتظار
                                    </a>
                                </div>
                            </li>
                            <li
                                class="tab-item"
                                :class="renderItemClass(allStatus.rejected)"
                            >
                                <div class="tab-item-content">
                                    <a
                                        @click.prevent="
                                            updateAds(allStatus.rejected)
                                        "
                                        href=""
                                        >آگهی های رد شده</a
                                    >
                                </div>
                            </li>
                            <li
                                class="tab-item"
                                :class="renderItemClass(allStatus.unavailable)"
                            >
                                <div class="tab-item-content">
                                    <a
                                        @click.prevent="
                                            updateAds(allStatus.unavailable)
                                        "
                                        href="#"
                                        >آگهی های منقضی شده</a
                                    >
                                </div>
                            </li>
                            <li
                                class="tab-item"
                                :class="renderItemClass(allStatus.uncompleted)"
                            >
                                <div class="tab-item-content">
                                    <a
                                        @click.prevent="
                                            updateAds(allStatus.uncompleted)
                                        "
                                        href="#"
                                        >آگهی های نا تمام</a
                                    >
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="content">
                        <div class="row" v-if="ads && !isLoading">
                            <div
                                class="col-md-6 blog adver"
                                v-for="ad in ads"
                                :key="ad.id"
                            >
                                <div class="inner">
                                    <div
                                        class="thumbnail"
                                        :style="
                                            `background-image: url('${renderAdPicture(
                                                ad
                                            )}')`
                                        "
                                    ></div>
                                    <div class="details">
                                        <div class="title">
                                            <h2>
                                                {{ renderTitle(ad.title) }}
                                            </h2>
                                        </div>
                                        <div
                                            :class="
                                                `status ${renderStatusClass(
                                                    ad.status
                                                )}`
                                            "
                                        >
                                            {{ renderStatusLabel(ad.status) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-6"></div> -->
                        </div>

                        <spinner v-if="isLoading" />

                        <!-- No Content -->
                        <b-alert
                            v-if="!isLoading"
                            :show="ads.length < 1"
                            variant="info"
                            class="text-center mt-4"
                            >هیچ آگهی موجود نیست!</b-alert
                        >
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import spinner from "../../Components/Spinner";

export default {
    components: {
        spinner
    },
    props: ["user", "allStatus"],
    data() {
        return {
            ads: [],
            activeItem: null,
            isLoading: false
        };
    },
    mounted() {
        this.updateAds(null, false);
    },
    methods: {
        renderAdPicture(ad) {
            let url = this.url("/images/default_ad_picture.png");

            const pictures = ad.pictures;

            if (pictures && pictures.length > 0) {
                url = pictures[0].url;
            }

            return url;
        },
        async updateAds(status, loadOnce = true) {
            console.log(status == this.activeItem, status, this.activeItem);
            if (loadOnce) if (status === this.activeItem) return 0;

            this.isLoading = true;

            let endpoint =
                isNaN(status) || status == null
                    ? route("user.ad.get")
                    : route("user.ad.get.status", {
                          status: status
                      });

            const response = await axios.get(endpoint);

            response.request.onProgress = function() {};

            if (response.status) {
                this.isLoading = false;
                if (response.status == 200) {
                    this.activeItem = response.data.ad_status
                        ? Number(response.data.ad_status)
                        : null;

                    this.ads = response.data.ads;
                }
            }

            console.log(response);
        },
        renderItemClass(status = null) {
            return {
                active: status == this.activeItem
            };
        },
        renderStatusLabel(status) {
            return this.__(`ads.status.${status}.label`);
        },
        renderStatusClass(status) {
            return this.__(`ads.status.${status}.class`);
        },
        renderTitle(title) {
            return title !== null && title.length > 0
                ? title
                : this.__("ads.defaults.title");
        }
    }
};
</script>
