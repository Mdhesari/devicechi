<template>
    <div>
        <Header :user="user"></Header>

        <!-- Page Content -->
        <main class="main-site">
            <slot></slot>
        </main>

        <Footer></Footer>
    </div>
</template>

<script>
import Header from "../Section/Header";
import Footer from "../Section/Footer";

export default {
    props: ["user"],
    components: {
        Header,
        Footer
    },
    mounted() {
        if (this.success) {
            this.$to(this.success, "", "s");
        }

        if (this.error) {
            this.$to(this.error);
        }

        if (this.warning) {
            this.$to(this.warning, "", "w");
        }
    },
    data() {
        return {
            success: this.getProp("success"),
            error: this.getProp("error"),
            warning: this.getProp("warning")
        };
    }
};
</script>
