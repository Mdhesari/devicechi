<template>
  <b-modal hide-footer v-model="isActive">Simple modal</b-modal>
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