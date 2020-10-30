<template>
  <AuthLayout>
    <Panel :user="user"></Panel>
  </AuthLayout>
</template>

<script>
import AuthLayout from "../../Layouts/FrontAuthLayout";
import Panel from "../../Section/Dashboard/Panel";
export default {
  data() {
    return {
      user: this.$inertia.page.props.user,
    };
  },
  components: {
    AuthLayout,
    Panel,
  },
};
</script>