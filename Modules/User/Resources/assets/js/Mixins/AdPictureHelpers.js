export default {
    methods: {
        renderAdPicture(ad, type = "url") {
            let url = this.url("/images/default_ad_picture.png");

            const pictures = ad.media;

            if (pictures && pictures.length > 0) {
                url = pictures[0][type];
            }

            return url;
        }
    }
};
