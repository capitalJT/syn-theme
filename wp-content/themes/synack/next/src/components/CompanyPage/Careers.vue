<template>
    <section class="company-page-careers">
        <div class="contained">
            <img
                src="/wp-content/themes/synack/next/static/images/logo-debossed.png"
                class="logo-debossed"
                height="186px"
                width="218px"
                alt="Synack logo"
            />
            <wp-content class="entry wiv" :html="content" v-in-view />
        </div>
    </section>
</template>

<script>
export default {
    props: {
        content: {
            type: String,
            default: ''
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.company-page-careers {
    padding: 100px $desktop-padding;
    background-color: $blue;
    color: $white;

    .logo-debossed {
        display: block;
        margin: auto;
        margin-bottom: 65px;
    }
    .entry {
        text-align: center;
        max-width: 550px;
        font-size: 20px;
        margin: auto;

        h3 {
            font-size: 60px;
            margin: 30px auto;
        }
        p {
            margin: 30px auto;
        }
        .shortcode-button {
            padding-bottom: 23px;
            padding-top: 23px;
            font-weight: 500;
            font-size: 14px;
        }
    }
}

// mobile breakpoints
@media #{ $lt-phone } {
    .company-page-careers {
        padding-bottom: 60px;
        padding-top: 60px;
        padding-right: $mobile-padding;
        padding-left: $mobile-padding;

        .logo-debossed {
            margin-bottom: 50px;
        }
        .entry {
            h3 {
                font-size: 28px;
            }
            .shortcode-button {
                box-sizing: border-box;
                width: 100%;
            }
        }
    }
}
</style>
