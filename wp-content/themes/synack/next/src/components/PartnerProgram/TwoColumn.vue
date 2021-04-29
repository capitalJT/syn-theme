<template>
    <section class="partner-program-two-column">
        <div class="left-column" v-html="leftColumn" />
        <div class="right-column" v-html="rightColumn" />
    </section>
</template>

<script>
export default {
    props: {
        leftColumn: String,
        rightColumn: String
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.partner-program-two-column {
    padding: 110px 30px 55px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-column-gap: 200px;
    color: #8694af;
    max-width: 1200px;
    margin: auto;

    @media (max-width: 950px) {
        grid-column-gap: 100px;
    }
    @media (max-width: 800px) {
        grid-template-columns: 100%;
    }

    h3 {
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 500;
        color: $blue;
        font-size: 18px;
    }
    h4 {
        font-size: 60px;
        margin: 0;
        color: $black;
    }
    a {
        @include shortcode-button($blue, $blue);
        transition: opacity 0.3s;

        &:hover,
        &:focus {
            opacity: 0.7;
        }
    }
    b {
        color: $black;
    }
    p {
        margin: 25px 0;
    }
    img {
        display: block;
        margin-top: 25px;

        @media (max-width: 800px) {
            margin-right: auto;
            margin-left: auto;
        }
    }
    ul {
        list-style: none;
        padding: 0;

        @media (max-width: 800px) {
            padding-left: 40px;
        }

        li {
            position: relative;

            &:before {
                content: '';
                background-image: url(/wp-content/themes/synack/next/static/images/checkbox.png);
                background-size: contain;
                width: 24px;
                height: 24px;
                display: block;
                position: absolute;
                right: calc(100% + 15px);
            }
        }
    }
    .right-column {
        margin-top: 70px;
    }
}
</style>
