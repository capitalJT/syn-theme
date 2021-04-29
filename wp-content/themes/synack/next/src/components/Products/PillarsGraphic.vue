<template>
    <section class="products-pillars-graphic">
        <div class="gradient" />
        <shared-light-dots />

        <div class="contained">
            <div class="titles mobile-only">
                <h5>Technology</h5>
                <h3>Technology pillars of the Synack Platform</h3>
            </div>
            <div class="graphic">
                <products-pillars-vector :active="activeColumnName" />
            </div>
            <div class="information">
                <div class="titles desktop-only">
                    <h5>Technology</h5>
                    <h3>Technology pillars of the Synack Platform</h3>
                </div>
                <div class="pillars-controls">
                    <button
                        @click="activeColumn = 0"
                        :class="[
                            'btn-pillar',
                            'hydra',
                            { active: activeColumn == 0 }
                        ]"
                    >
                        <div class="mask" />
                        <svg-hydra-icon />
                        <span>Hydra</span>
                    </button>
                    <button
                        @click="activeColumn = 1"
                        :class="[
                            'btn-pillar',
                            'apollo',
                            { active: activeColumn == 1 }
                        ]"
                    >
                        <div class="mask" />
                        <svg-apollo-icon />
                        <span>Apollo</span>
                    </button>
                    <button
                        @click="activeColumn = 2"
                        :class="[
                            'btn-pillar',
                            'launchpoint',
                            { active: activeColumn == 2 }
                        ]"
                    >
                        <div class="mask" />
                        <svg-space-ship />
                        <span>LaunchPoint</span>
                    </button>
                </div>
                <transition name="fade" mode="out-in">
                    <wp-content
                        :key="activeColumn"
                        class="entry"
                        :html="activeContent"
                    />
                </transition>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            pageData: pageData,
            activeColumn: 0
        }
    },
    computed: {
        activeContent() {
            if (this.activeColumn === 0)
                return _get(this.pageData, 'acf.pillars_hydra_content')
            else if (this.activeColumn === 1)
                return _get(this.pageData, 'acf.pillars_apollo_content')
            else if (this.activeColumn === 2)
                return _get(this.pageData, 'acf.pillars_launchpoint_content')
            return 0
        },
        activeColumnName() {
            return ['hydra-active', 'apollo-active', 'lp-active'][
                this.activeColumn
            ]
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$btn-border-color: #103a68;
$btn-border-teal: #99efff;
$text-color: #e0dbff;

.products-pillars-graphic {
    padding-right: $desktop-padding;
    padding-left: $desktop-padding;
    padding-bottom: 600px;
    padding-top: 140px;
    position: relative;
    overflow: hidden;
    color: $white;

    .contained {
        align-items: flex-start;
        display: flex;
    }
    .contained .graphic,
    .contained .information {
        width: 50%;
    }

    .graphic {
        padding-right: 100px;
        min-height: 90vh;
    }
    .titles {
        h5 {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 500;
            margin: 0;
            color: $red;
            font-size: 18px;
        }
        h3 {
            line-height: 1;
            font-size: 60px;
            margin: 20px 0 40px;
        }
    }
    .information {
        padding-left: $desktop-padding;
        // min-height: 950px;

        .entry {
            color: $text-color;
            line-height: 1.5;
            font-size: 20px;

            sup {
                font-size: 8px;
            }
        }
        .entry strong {
            color: $white;
        }
    }

    .product-pillar-feature {
        margin-bottom: 30px;
        display: flex;

        svg {
            position: relative;
            top: 5px;
        }
        .feature-description {
            margin-left: 16px;
            flex-shrink: 2;
        }
        .title {
            font-weight: 500;
            font-size: 18px;
            color: $white;
        }
        .content {
            font-size: 14px;

            & > *:first-child {
                margin-top: 0;
            }
            & > *:last-child {
                margin-bottom: 0;
            }
        }
    }

    // buttons
    .pillars-controls {
        grid-template-columns: 1fr 1fr;
        display: flex;

        .btn-pillar {
            font-family: $font-display;
            position: relative;
            font-weight: 500;
            font-size: 18px;
            padding: 40px 0;
            margin: 0 4px;
            color: $white;
            flex: 1;

            .fillchange {
                transition: fill 250ms ease;
            }

            .mask {
                transition: background-color 150ms ease, border-color 250ms ease;
                @include fill;
                border-top-right-radius: 10px;
                border-top-left-radius: 10px;
                background-color: rgba($btn-border-color, 0.15);
                border: 1px solid $btn-border-color;
                border-bottom: none;
                -webkit-mask-image: linear-gradient(
                    180deg,
                    rgba(0, 0, 0, 1) 10%,
                    rgba(0, 0, 0, 0) 100%
                );
                mask-image: linear-gradient(
                    180deg,
                    rgba(0, 0, 0, 1) 10%,
                    rgba(0, 0, 0, 0) 100%
                );
            }
            .not-mobile &:not(.active):hover .mask,
            .not-mobile &:not(.active):focus .mask {
                background-color: rgba($btn-border-color, 0.3);
            }

            &:first-child {
                margin-left: 0;
            }
            &:last-child {
                margin-right: 0;
            }
            span,
            svg {
                position: relative;
                vertical-align: top;
            }
            span {
                margin-left: 10px;
                position: relative;
                top: 2px;
            }
            &.hydra span {
                top: 6px;
            }

            // active state
            &.hydra.active {
                .mask {
                    background-color: rgba($red, 0.35);
                    border-color: $red;
                }
                .fillchange {
                    fill: $red;
                }
            }
            &.apollo.active {
                .mask {
                    background-color: rgba($blue, 0.35);
                    border-color: $blue;
                }
                .fillchange {
                    fill: $blue;
                }
            }
            &.launchpoint.active {
                .mask {
                    background-color: rgba($btn-border-teal, 0.15);
                    border-color: $btn-border-teal;
                }
                .ship {
                    fill: #0ff8e4;
                }
                .exhaust {
                    fill: #108393;
                }
            }
        }
    }

    .gradient {
        @include fill;
        background: linear-gradient(
            0deg,
            rgba(27, 18, 90, 1) 50%,
            rgba(13, 3, 43, 1) 100%
        );
        -webkit-clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
        clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
    }
}

// mobile breakpoints
@media #{ $lt-phone } {
    .products-pillars-graphic {
        padding-right: $mobile-padding;
        padding-left: $mobile-padding;
        padding-bottom: 120px;
        padding-top: 70px;

        .dotted {
            display: none;
        }

        .titles {
            text-align: center;

            h5 {
                font-size: 18px;
            }
            h3 {
                font-size: 28px;
                margin: 30px 0;
            }
        }

        .contained {
            display: block;

            .graphic {
                padding-right: 0;
                margin: auto;
                width: 60%;
                min-height: initial;
            }
            .information {
                padding: 0;
                width: 100%;
            }
        }

        .pillars-controls {
            margin-top: 30px;

            .btn-pillar {
                padding-bottom: 20px;
                padding-top: 20px;
                font-size: 20px;
                margin: 0 7px;

                svg {
                    width: 20px;
                }
                span {
                    margin-left: 3px;
                }
            }
        }

        .gradient {
            -webkit-clip-path: polygon(
                0 0,
                100% 0,
                100% calc(100% - 30px),
                0 100%
            );
            clip-path: polygon(0 0, 100% 0, 100% calc(100% - 30px), 0 100%);
        }
    }
}
</style>
