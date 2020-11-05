<template>
  <AuthLayout>
    <Panel :user="user" :routes="routes"></Panel>
  </AuthLayout>
</template>

<script>
import AuthLayout from "../../Layouts/FrontAuthLayout";
import Panel from "../../Section/Dashboard/Panel";
export default {
  data() {
    return {
      user: this.$inertia.page.props.user,
      routes: this.$inertia.page.props.routes
    };
  },
  components: {
    AuthLayout,
    Panel,
  },
};
</script>