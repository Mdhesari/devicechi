<template>
  <AppSection class="about-us">
    <b-container>
      <b-row>
        <b-col md="6">
          <h3>درباره ما بیشتر بدانید</h3>
          <p>
            وبسایت موبایل فور سل یک پلتفرم برای خرید و فروش گوشی های کارکرده
            میباشد.
          </p>
        </b-col>
        <b-col md="6">
          <div class="vector">
            <img :src="url('/images/img/vectors/questions.svg')" alt="About Us" />
          </div>
        </b-col>
      </b-row>
    </b-container>
  </AppSection>
</template>

<script>
import AppSection from "./../Components/AppSection";

export default {
  components: {
    AppSection,
  },
};
</script>
