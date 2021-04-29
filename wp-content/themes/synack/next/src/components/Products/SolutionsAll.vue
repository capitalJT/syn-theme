<template>
    <div class="products-solutions-all" key="all">
        <div class="columns">
            <div class="header-row">
                <div v-for="step in alteredSteps" class="header-column">
                    <div class="circle" :style="getCircleStyle(step)" />
                    <div class="step-label">{{ step.name }}</div>
                    <div class="step-description">
                        {{ getStepDescription(step) }}
                    </div>
                </div>
            </div>
            <products-solutions-all-rows :steps="alteredSteps" />
        </div>
        <div class="synack-platform">
            <div class="platform-row">
                <div class="col">
                    <div class="circle" :style="getCircleStyle(platformStep)" />
                    <div class="platform-meta">
                        <div class="step-label">Synack Platform</div>
                        <div class="step-description">
                            Always-On Security Augmentation
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="entry" v-html="platformContent" />
                </div>
            </div>
        </div>
        <products-tooltip />
    </div>
</template>

<script>
import _kebabCase from 'lodash/kebabCase'

export default {
    data() {
        return {
            pageData
        }
    },
    props: {
        steps: {
            type: Array,
            required: true
        }
    },
    computed: {
        alteredSteps() {
            return this.steps.slice(1)
        },
        platformStep() {
            return this.steps[0]
        },
        platformContent() {
            return _get(this.pageData, 'acf.step_platform_features', '')
        }
    },
    methods: {
        getCircleStyle(step) {
            const slug = _kebabCase(step.name)
            const iconUrl = `/wp-content/themes/synack/next/static/images/solutions-icon/${slug}.png`
            return {
                'background-image': `url(${iconUrl})`
            }
        },
        getStepDescription(step) {
            if (step.name === 'Disclose')
                return 'Vulnerability Disclosure Program'
            if (step.name === 'Discover')
                return 'Crowdsourced Vulnerability Discovery'
            if (step.name === 'Certify')
                return 'Crowdsourced Penetration Testing'
            if (step.name === 'Synack365')
                return 'Crowdsourced Penetration Testing 365'
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$border-color: #e8ebf0;

.products-solutions-all {
    padding-bottom: 60px;
    margin-top: 65px;

    .columns {
        box-shadow: 0 4px 8px 0 rgba(0, 25, 62, 0.08);
        border: 1px solid $border-color;
        background-color: $white;
        border-radius: 15px;
        position: relative;
        z-index: 5;
    }
    .header-row {
        position: relative;
        display: flex;
    }
    .header-column {
        border-right: 1px solid $border-color;
        box-sizing: border-box;
        padding: 20px 50px;
        text-align: center;
        width: 25%;

        &:last-child {
            border-right: none;
        }
    }
    .step-label {
        font-weight: 500;
        margin: 14px 0;
        color: $navy;
    }
    .step-description {
        font-size: 16px;
        color: #535f75;
    }
    .header-column .circle {
        @include contain;
        margin: auto;
        height: 48px;
        width: 48px;
        margin-bottom: 15px;
    }

    .synack-platform {
        padding-right: 30px;
        padding-left: 30px;

        .platform-row {
            box-shadow: 0 4px 8px 0 rgba(0, 25, 62, 0.08);
            border: 1px solid $border-color;
            background-color: $white;
            align-items: stretch;
            border-radius: 15px;
            display: flex;
            border-top-right-radius: 0;
            border-top-left-radius: 0;
            border-top: 0;
        }
        .col:first-child {
            border-right: 1px solid $border-color;
            align-items: center;
            display: flex;
        }
        .col:last-child {
            font-size: 14px;
            color: #8696ad;

            strong {
                color: #535f75;
            }
        }
        .col {
            padding: 55px 60px;
            flex: 1;
        }
        .circle {
            margin-right: 20px;
            @include contain;
            height: 48px;
            width: 48px;
        }
        .platform-meta {
            flex: 1;
        }
        .step-label {
            font-weight: 500;
            font-size: 20px;
            margin: 0;
        }
    }
}

// mobile breakpoints
@media #{ $lt-phone } {
    .products-solutions-all {
        -webkit-overflow-scrolling: touch;
        white-space: nowrap;
        overflow-x: auto;

        .columns {
            margin-left: $mobile-padding;
            display: inline-block;
            white-space: initial;
            vertical-align: top;
            width: 1100px;
        }
        .synack-platform {
            padding-right: $mobile-padding;
            padding-left: $mobile-padding;
            display: inline-block;
            white-space: initial;
            vertical-align: top;
            width: 275px;

            .platform-row {
                box-shadow: 0 4px 8px 0 rgba(0, 25, 62, 0.08);
                border: 1px solid $border-color;
                flex-direction: column;
                border-radius: 15px;
            }
            .col:first-child {
                padding: 20px 50px;
                text-align: center;
                display: initial;
                border: none;
                border-bottom: 1px solid $border-color;
            }
            .col:last-child {
                text-align: center;
                padding: 50px 20px;
                line-height: 1.7;
            }
            .col {
                padding-bottom: 20px;
                padding-top: 20px;
                padding-right: $mobile-padding;
                padding-left: $mobile-padding;
            }
            .circle {
                margin: auto;
                margin-bottom: 15px;
            }
        }
    }
}
</style>
