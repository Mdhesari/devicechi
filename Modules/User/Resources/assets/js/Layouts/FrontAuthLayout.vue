<template>
    <div>
        <Header :user="user"></Header>

        <!-- Page Content -->
        <main class="main-site">
            <b-container>
                <div class="alert alert-success" v-if="success">
                    {{ success }}
                </div>
            </b-container>

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
    data() {
        return {
            success: this.getProp("success"),
            error: this.getProp("error")
        };
    }
};
</script>
