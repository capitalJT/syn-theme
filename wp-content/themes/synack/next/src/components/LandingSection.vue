<template>
    <section class="landing-section">
        <div class="pattern" />
        <div class="shadow shadow-1" />
        <div class="shadow shadow-2" />

        <transition name="load-fade" appear>
            <div class="info">
                <h1 class="title" v-html="title" />
                <wp-content class="entry" :html="content" />
            </div>
        </transition>
    </section>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: ''
        },
        content: {
            type: String,
            default: ''
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.landing-section {
    -webkit-clip-path: polygon(100% 0, 110% 80%, 55% 100%, -10% 92%, 0 0);
    clip-path: polygon(100% 0, 110% 80%, 55% 100%, -10% 92%, 0 0);
    position: relative;
    background: $navy;
    overflow: hidden;
    color: $white;
    background: linear-gradient(
        59deg,
        rgba(6, 17, 35, 1) 0%,
        rgba(15, 39, 72, 1) 100%
    );
    padding: 120px 0 130px;

    .shadow {
        transform-origin: bottom left;
        transform: rotate(-25deg);
        position: absolute;
        height: 40px;
        height: 200vh;
        width: 200vw;
        bottom: 0;
        left: 0;
        box-shadow: 0px 0px 50px $black;
    }
    .shadow-2 {
        bottom: -400px;
    }

    .pattern {
        background-image: url('images/patterns/triangles.png');
        background-size: 50px;
        opacity: 0.07;
        @include fill;
        bottom: -100vh;
    }
    .info {
        padding: 0 $desktop-padding;
        position: relative;
        text-align: center;
        max-width: 800px;
        margin: auto;
    }
    .title {
        text-transform: uppercase;
        font-size: 140px;
        margin: 0;
    }
    .entry {
        line-height: 1.4;
        font-size: 20px;
        color: $sky;

        a {
            color: $white;
        }
    }

    // fade transition
    .load-fade-enter-active,
    .load-fade-leave-active {
        transition: opacity 850ms;
    }
    .load-fade-enter,
    .load-fade-leave-to {
        opacity: 0;
    }
}

// mobile breakpoints
@media #{ $lt-phone } {
    .landing-section {
        padding-bottom: 70px;
        padding-top: 100px;

        .info {
            padding-right: $mobile-padding;
            padding-left: $mobile-padding;
        }
        .title {
            font-size: 50px;
        }
        .entry {
            font-size: 18px;
        }
    }
}
</style>
