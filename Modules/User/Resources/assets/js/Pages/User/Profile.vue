<template>
  <AuthLayout>
    <h1>Simple Profile of {{ $page.user.name }}</h1>
  </AuthLayout>
</template>

<script>
import AuthLayout from "../../Layouts/FrontAuthLayout";

export default {
  components: {
    AuthLayout,
  },
};
</script>