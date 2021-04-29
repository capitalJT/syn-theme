<template>
    <section class="company-page-landing">
        <div class="pattern" />
        <div class="shadow shadow-1" />
        <div class="shadow shadow-2" />

        <transition name="load-fade" appear>
            <div class="contained">
                <div class="col col-1 title">
                    <split-text wrapper="h2" :text="title" />
                </div>
                <wp-content class="col col-2 entry" :html="content" />
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

.company-page-landing {
    -webkit-clip-path: polygon(100% 0, 110% 80%, 75% 100%, -10% 92%, 0 0);
    clip-path: polygon(100% 0, 110% 80%, 75% 100%, -10% 92%, 0 0);
    position: relative;
    background: $navy;
    overflow: hidden;
    color: $white;
    background: linear-gradient(
        59deg,
        rgba(6, 17, 35, 1) 0%,
        rgba(15, 39, 72, 1) 100%
    );
    padding: 200px 0;

    .contained {
        display: flex;

        .col-1 {
            width: 55%;
        }
    }

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
    }
    .title h2 {
        font-size: 160px;
        line-height: 1;
        margin: 0;
    }
    .title .line {
        white-space: nowrap;
        display: block;
    }
    .title .line-2 {
        margin-top: -0.43em;
        color: rgba($white, 0.7);
        text-shadow: 0 6px 24px rgba($navy, 0.6);
    }
    .entry {
        padding: 0 50px;
        line-height: 1.4;
        font-size: 20px;
        color: $sky;

        strong {
            text-transform: uppercase;
            font-weight: 400;
            color: $white;
        }
    }

    // loading fade transition
    .load-fade-enter-active,
    .load-fade-leave-active {
        transition: opacity 350ms;
    }
    .load-fade-enter,
    .load-fade-leave-to {
        opacity: 0;
    }

    // mobile
    @media #{$lt-phone} {
        -webkit-clip-path: polygon(100% 0, 110% 90%, 65% 100%, -10% 100%, 0 0);
        clip-path: polygon(100% 0, 110% 90%, 65% 100%, -10% 100%, 0 0);
        padding: 90px 0 100px;

        .contained {
            display: block;
            .col-1 {
                width: 100%;
            }
        }
        .shadow-2 {
            left: 15vw;
        }
        .title {
            h2 {
                font-size: 52px;
                text-align: center;
            }
            .line-2 {
                margin-top: -0.4em;
            }
        }
    }
}
</style>
