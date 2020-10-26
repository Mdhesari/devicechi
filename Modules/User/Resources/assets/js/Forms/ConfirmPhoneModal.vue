<template>
  <b-modal hide-footer v-model="isActive">
    <h3>تایید کد ۶ رقمی</h3>
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