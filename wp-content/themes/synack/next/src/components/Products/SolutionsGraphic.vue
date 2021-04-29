<template>
    <section class="products-solutions-graphic">
        <div class="pattern" />
        <div class="gradient" />

        <div class="contained">
            <div class="meta">
                <h5>Solutions</h5>
                <h3>{{ solutionsTitle }}</h3>
            </div>

            <div class="product-link-wrap">
                <a href="/solutions" class="to-products shortcode-button">
                    Compare all Product Solutions

                    <svg-arrow-right class="arrow" alt="" />
                </a>
            </div>

            <div class="solutions-step-indicator">
                <products-solution-indicator
                    class="step-indicator"
                    v-for="(step, i) in steps"
                    :active="activeStep === i"
                    @click.native="setActive(i)"
                    @focus.native="setActive(i)"
                    :step="step"
                    :key="i"
                />
                <!-- <products-solution-indicator
                    class="step-indicator show-all"
                    :step="{ color: '#535F75', name: 'Show All' }"
                    :active="activeStep === 'ALL'"
                    @click.native="setActive('ALL')"
                    @focus.native="setActive('ALL')"
                /> -->
            </div>

            <transition name="fade" mode="out-in">
                <div
                    class="solutions-visual"
                    v-in-view="{ onEnterBelow: startTimer }"
                    v-if="activeStep !== 'ALL'"
                    key="visual"
                >
                    <div class="graphic">
                        <products-solutions-vector
                            @layer-click="setActive($event)"
                            :active-index="activeStep"
                        />
                    </div>
                    <div class="information">
                        <transition name="fade" mode="out-in">
                            <h4
                                class="step-title"
                                :key="activeTitle"
                                :style="titleStyle"
                            >
                                {{ activeTitle }}
                            </h4>
                        </transition>
                        <transition name="fade" mode="out-in">
                            <wp-content
                                class="entry"
                                :html="activeContent"
                                :key="activeTitle"
                            />
                        </transition>
                    </div>
                </div>
                <products-solutions-all v-else :steps="steps" />
            </transition>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            pageData: pageData,
            timerKilled: false,
            timer: null,
            activeStep: 0,
            steps: [
                {
                    name: 'Synack Platform',
                    color: '#ffad39'
                },
                {
                    name: 'Disclose',
                    color: '#48d895'
                },
                {
                    name: 'SmartScan',
                    color: '#3dcbdc'
                },
                {
                    name: 'Discover',
                    color: '#0f61ff'
                },
                {
                    name: 'Certify',
                    color: '#b39cff'
                },
                {
                    name: 'Synack365',
                    color: '#e70040'
                }
            ]
        }
    },
    mounted() {
        // kick timer if component is already
        // in view on mount
        setTimeout(() => {
            if (
                !this.timer &&
                this.$el.querySelector('.solutions-visual.in-view')
            ) {
                this.startTimer()
            }
        }, 200)
    },
    watch: {
        timerKilled(isKilled) {
            if (isKilled) this.killTimer()
        }
    },
    computed: {
        solutionsTitle() {
            return _get(this.pageData, 'meta.solutions_title', '')
        },
        activeContent() {
            if (this.activeStep < 0) return ''
            else if (this.activeStep === 0)
                return _get(this.pageData, 'acf.step_platform_content')
            else if (this.activeStep === 1)
                return _get(this.pageData, 'acf.step_disclose_content')
            else if (this.activeStep === 2)
                return _get(this.pageData, 'acf.step_smartscan_content')
            else if (this.activeStep === 3)
                return _get(this.pageData, 'acf.step_discover_content')
            else if (this.activeStep === 4)
                return _get(this.pageData, 'acf.step_certify_content')
            else if (this.activeStep === 5)
                return _get(this.pageData, 'acf.step_defend_content')
        },
        activeTitle() {
            return _get(this.steps, `[${this.activeStep}].name`, '')
        },
        activeColor() {
            return _get(this.steps, `[${this.activeStep}].color`, '')
        },
        titleStyle() {
            if (this.activeColor) {
                return {
                    color: this.activeColor
                }
            }
        }
    },
    beforeDestroy() {
        this.killTimer()
    },
    methods: {
        startTimer() {
            if (this.timer || this.timerKilled) return
            const goNext = () => {
                this.activeStep = (this.activeStep + 1) % this.steps.length
            }
            this.timer = setInterval(goNext, 2500)
        },
        killTimer() {
            clearInterval(this.timer)
            this.timer = null
        },
        setActive(i) {
            this.activeStep = i
            this.timerKilled = true
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$border-gray: #e7eaef;
$text-gray: #535f75;

.products-solutions-graphic {
    overflow: hidden;
    position: relative;
    padding: 110px $desktop-padding;

    // background pattern and gradient
    @include background-pattern-decoration;

    // titles
    @include products-solutions-titles;

    .product-link-wrap {
        text-align: center;
        margin-top: 25px;

        .to-products {
            color: $blue;
            display: inline-block;
            border-color: $blue;
            transition: background 0.3s, color 0.3s;

            .not-mobile &:not(.primary):hover {
                border-color: $blue;

                background: $blue;
                color: $white;

                svg path {
                    fill: $white;
                }
            }
            svg {
                width: 15px;
                height: 15px;
                position: relative;
                top: 1px;
                left: 15px;

                path {
                    fill: $blue;
                    transition: fill 0.3s;
                }
            }
        }
    }

    // step indicator
    .solutions-step-indicator {
        border-bottom: 1px solid $border-gray;
        margin-top: 30px;
        padding: 30px;
        display: flex;
    }
    .step-indicator {
        flex: 1;

        &.show-all {
            border-left: 1px solid $border-gray;
        }
    }

    // Solutions graphic area
    .solutions-visual {
        padding-top: 100px;
        display: flex;
    }
    .solutions-visual .graphic,
    .solutions-visual .information {
        width: 50%;
    }
    .solutions-visual .graphic {
        position: relative;
    }
    // .products-solutions-legend {
    //     transform: translateY(-50%);
    //     position: absolute;
    //     margin-right: 35px;
    //     left: 0;
    //     top: 50%;
    // }
    .solutions-visual .information {
        box-sizing: border-box;
        padding-left: 80px;

        .step-title {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 500;
            font-size: 18px;
            margin: 0 0 25px;
        }
        .entry {
            min-height: 660px;
            color: $text-gray;
            font-size: 20px;

            p {
                line-height: 1.3;
            }
        }
        .entry h3 {
            font-weight: 500;
            font-size: 40px;
            margin: 30px 0;
            color: $navy;
        }
        .entry ul {
            list-style-type: none;
            color: rgba($text-gray, 0.75);
            font-size: 18px;
            margin: 30px 0;
            padding: 0;
            margin: 0;
        }
        .entry ul li {
            position: relative;
            padding-left: 40px;
        }
        .entry ul li::before {
            background-image: url('images/checkmark-blue.svg');
            content: '';
            position: absolute;
            display: block;
            height: 24px;
            width: 24px;
            left: 0;
            top: 2px;
        }
        .entry strong {
            font-weight: 500;
            font-size: 18px;
        }
        .entry .shortcode-button.primary {
            background-color: $blue;
            color: $white;
        }
        .entry .shortcode-button {
            margin: 40px 0;
        }
        .entry > *:first-child {
            margin-top: 0;
        }
        .entry > *:last-child {
            margin-bottom: 0;
        }
    }
}

// mobile breakpoints
@media #{ $lt-phone } {
    .products-solutions-graphic {
        padding-right: 0;
        padding-left: 0;
        padding-bottom: 0;
        padding-top: 50px;

        .meta {
            padding-right: $mobile-padding;
            padding-left: $mobile-padding;
        }
        .meta h5 {
            font-size: 18px;
        }
        .meta h3 {
            font-size: 28px;
            margin: 30px 0;
        }

        // Indicator
        .solutions-step-indicator {
            padding-right: 10px;
            padding-left: 10px;
            margin-right: auto;
            margin-left: auto;
            padding-top: 10px;
            grid-template-columns: 1fr 1fr;
            grid-gap: 50px 20px;
            display: grid;
            max-width: 300px;
            border: none;
        }
        .step-indicator.show-all {
            border: none;
        }

        // Visual
        .solutions-visual {
            flex-direction: column;
            margin-right: $mobile-padding;
            margin-left: $mobile-padding;
            padding-right: 20px;
            padding-left: 20px;
            padding-bottom: 60px;
            border-top: 1px solid $border-gray;

            .graphic,
            .information {
                padding: 0;
                width: 100%;
            }
            .information {
                text-align: center;
                margin-top: 40px;

                ul {
                    text-align: left;
                }
                .shortcode-button {
                    box-sizing: border-box;
                    margin-bottom: 0;
                    width: 100%;
                }
            }
        }
    }
}
</style>
