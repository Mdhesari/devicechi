export default {
    methods: {
        renderAdPicture(ad) {
            let url = this.url("/images/default_ad_picture.png");

            const pictures = ad.pictures;

            if (pictures && pictures.length > 0) {
                url = pictures[0].url;
            }

            return url;
        }
    }
};
