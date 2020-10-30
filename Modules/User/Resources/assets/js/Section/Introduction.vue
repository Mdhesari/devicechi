<template>
  <AppSection class="introduction">
    <b-container fluid="md">
      <div class="home-title">
        <h1>
          {{ $t.get("home.intro.title") }}
        </h1>
        <h2 class="sub-title text-muted">
          {{ $t.get("home.intro.desc") }}
        </h2>
      </div>
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