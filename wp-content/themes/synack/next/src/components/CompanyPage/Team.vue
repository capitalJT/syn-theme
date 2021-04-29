<template>
    <section class="company-page-team">
        <div class="contained lines" v-in-view>
            <span class="line" />
            <span class="line" />
            <span class="line" />
        </div>

        <div class="contained">
            <div class="titles">
                <h5>Our Team</h5>
                <h3 class="large wiv" v-in-view>Leadership</h3>
            </div>

            <company-page-image-grid :items="teamMembers" />
        </div>
    </section>
</template>

<script>
export default {
    props: {
        teamMembers: {
            type: Array,
            required: true
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$line-gray: #e0e2e4;

.company-page-team {
    position: relative;
    padding: 140px 0;

    .contained {
        padding-right: $desktop-padding;
        padding-left: $desktop-padding;
    }

    // background lines
    .lines {
        @include fill;
        margin: auto;

        &.in-view {
            .line {
                transition: bottom 4s $easeInOutQuad;
                bottom: 0;
            }
            .line:nth-child(2) {
                transition-delay: 1000ms;
            }
            .line:nth-child(3) {
                transition-delay: 450ms;
            }
        }

        .line {
            background-color: $line-gray;
            position: absolute;
            content: '';
            width: 1px;
            bottom: 100%;
            top: 0;
        }
        .line:nth-child(1) {
            transition-delay: 200ms;
            left: $desktop-padding;
        }
        .line:nth-child(2) {
            transition-delay: 1000ms;
            left: 50%;
        }
        .line:nth-child(3) {
            transition-delay: 650ms;
            right: $desktop-padding;
        }
    }

    .titles {
        margin-bottom: 120px;
        text-align: center;

        h5 {
            text-transform: uppercase;
            font-weight: 500;
            font-size: 18px;
            margin: 30px 0;
            color: $blue;
        }
        h3 {
            font-size: 60px;
            margin: 0;
        }
    }
}

// mobile breakpoints
@media #{ $lt-phone } {
    .company-page-team {
        padding-bottom: 60px;
        padding-top: 70px;

        .contained {
            padding-right: $mobile-padding;
            padding-left: $mobile-padding;
        }
        .lines {
            .line:nth-child(1) {
                left: $mobile-padding;
            }
            .line:nth-child(3) {
                right: $mobile-padding;
            }
        }

        .titles {
            margin-bottom: 40px;

            h5 {
                font-size: 18px;
                margin: 20px 0;
            }
            h3 {
                font-size: 32px;
            }
        }
    }
}
</style>
