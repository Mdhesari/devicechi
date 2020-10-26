<template>
  <b-modal hide-footer v-model="isActive">
    <h4>کد پیامک شده را وارد کنید.</h4>
  </b-modal>
</template>

<script>
export default {
  data() {
    return {
      isActive: false,
    };
  },

  methods: {
    activateAuth() {
      this.isActive = true;
    },
  },
};
</script>