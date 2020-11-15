<template>
  <AuthLayout>
    <Panel :user="user"></Panel>
  </AuthLayout>
</template>

<script>
import AuthLayout from "../../Layouts/FrontAuthLayout";
import Panel from "../../Section/Dashboard/Panel";
export default {
  props:['user'],
  components: {
    AuthLayout,
    Panel,
  },
};
</script>