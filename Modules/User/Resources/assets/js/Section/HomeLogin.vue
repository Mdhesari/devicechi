<template>
  <AppSection class="login-form-section">
    <b-container>
      <Login></Login>
    </b-container>
  </AppSection>
</template>

<script>
import AppSection from "./../Components/AppSection";
import Login from "./../Forms/Login";

export default {
  components: {
    AppSection,
    Login,
  },
};
</script>