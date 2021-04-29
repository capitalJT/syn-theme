<template>
    <div
        :class="[
            'journey-patch-verification',
            { 'follow-up': cmpIsFollowUp },
            { accepted: willAccept }
        ]"
        :key="cmpPatch.vuln.index"
    >
        <div class="grid-wrap">
            <!-- <svg-icon-patch class="icon" /> -->
            <img
                src="/wp-content/themes/synack/next/static/images/patch-icon.png"
                alt="A teal CPU core."
                width="70"
                height="70"
                class="icon"
            />
            <h3 class="title" v-html="cmpTitleContent" />
            <span class="author" v-html="cmpSubtitleContent" />
            <div class="divider" />
            <wp-content :html="cmpContent" />

            <!-- accept patch -->
            <button
                v-if="!cmpIsFollowUp"
                class="accept"
                @click="willAccept = true"
                key="accept"
            >
                Yes
            </button>

            <!-- reject patch -->
            <button
                v-if="!cmpIsFollowUp"
                class="reject"
                @click="willAccept = false"
                key="reject"
            >
                No
            </button>

            <!-- score change -->
            <!-- <button
                v-if="cmpIsFollowUp"
                :class="['score', { positive: willAccept }]"
                key="score-change"
            >
                ARS {{ willAccept ? '+' : '-' }}{{ cmpPatch.vuln.point_value }}
            </button> -->
            <button
                @click="finishVerification"
                v-if="cmpIsFollowUp"
                class="continue"
                key="continue"
            >
                Continue
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        target: null
    },
    data() {
        return {
            willAccept: null
        }
    },
    computed: {
        cmpPatch() {
            return _get(this, '$store.state.journey.patchQueue[0]', {})
        },
        cmpAuthor() {
            return _get(this.cmpPatch, 'author', '')
        },
        cmpContent() {
            let output = ''

            if (this.cmpIsFollowUp) {
                output = `<p>Thank you for verifying the patch as ${
                    this.willAccept ? 'successful' : 'unsuccessful'
                }. The Attacker Resistance Score has been adjusted.</p>`
            } else {
                output = `<h3>${this.cmpPatch.vuln.name}</h3>`
                output += _get(pageData, 'options.email_content', '')
                output = output.replace(
                    '[vuln]',
                    `#${this.cmpPatch.vuln.index}`
                )
            }
            return output
        },
        cmpRecipient() {
            return _get(pageData, 'options.recipient_name', 'Synack Researcher')
        },
        cmpIsFollowUp() {
            return this.willAccept !== null
        },
        cmpTitleContent() {
            return this.cmpIsFollowUp
                ? `Patch Verification: ${
                      this.willAccept ? 'Successful' : 'Unsuccessful'
                  }`
                : `To: ${this.cmpRecipient}`
        },
        cmpSubtitleContent() {
            return this.cmpIsFollowUp
                ? `Submitted by: SRT Member just now`
                : 'Subj: Patch Verification request'
        }
    },
    methods: {
        finishVerification() {
            if (this.willAccept) {
                this.$store.commit('ADD_PATCH')
                this.$store.commit('RESET_CURRENT_PATCH')
                this.$store.commit('ADD_SYNACK_ITEM', {
                    content: 'Patch accepted. ARS recalculated.',
                    className: 'positive'
                })
            } else {
                this.$store.commit('RESET_CURRENT_PATCH')
            }

            this.$emit('patch-done')
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';
$body-color: #8695ae;
$reject: #ff3655;
$accept-score: #46d895;
$reject-score: #c7021f;

.journey-patch-verification {
    position: absolute;
    filter: drop-shadow(0 8px 10px rgba(#061023, 0.2));
    // this is half of 60vw, which is the height of the Journey section
    // (these top + left positions are mimicking
    // the top: 50%, left: 50%, transform: translate(-50%, -50%) centering trick)
    top: 30vw;
    left: 50vw;
    transform: translate(-50%, -50%);
    pointer-events: all;

    .indicator {
        position: absolute;
        top: 30px;
        left: 0;
        transform: translateX(calc(-100% + 5px));
        z-index: 5;
    }

    .grid-wrap {
        background: $white;
        padding: 20px 0;
        max-width: 400px;
        position: relative;

        display: grid;
        grid-template-columns:
            [left-gutter] 20px [icon] auto [left-column] 1fr [right-column] calc(
                50% - 20px
            )
            [right-gutter] 20px;
        grid-template-rows: [title] auto [author] auto [content] auto [buttons] auto;
        clip-path: polygon(
            20px 0,
            100% 0,
            100% calc(100% - 20px),
            calc(100% - 20px) 100%,
            0 100%,
            0 20px
        );
    }

    .icon {
        grid-column: icon;
        grid-row: title / content;
        padding-bottom: 15px;
        margin: auto 15px auto 0;
        width: 35px;
        height: 35px;
    }
    .title {
        margin-top: 0;
        margin-bottom: 10px;
        grid-column: left-column / right-gutter;
        font-size: 13px;
        letter-spacing: 2px;
        text-transform: uppercase;
        font-weight: 400;
    }
    .author {
        grid-column: left-column / right-gutter;
        color: $body-color;
        font-size: 14px;
        margin-bottom: 15px;
    }
    .divider {
        grid-column: left-gutter / -1;
        height: 1px;
        background: #e4e5e9;
    }
    .wp-content {
        grid-column: icon / right-gutter;
        color: $body-color;

        h2,
        h3 {
            margin: 15px 0 0;
            font-size: 16px;
            font-weight: 400;
        }
        p {
            margin-top: 10px;
            line-height: 1.5;
            font-size: 14px;
        }
    }
    button {
        border-radius: 22px;
        font-size: 16px;
        padding: 12px 0;
    }
    .accept,
    .score {
        grid-column: icon / right-column;
        background: $blue;
        color: $white;
        margin-right: 5px;
    }
    .reject {
        color: $reject;
        border: 2px solid $reject;
        margin-left: 5px;
    }
    .score {
        cursor: default;
    }
    .continue {
        color: $blue;
        border: 2px solid $blue;
        grid-column: icon / right-gutter;
    }
    // &.follow-up.accepted {
    //     .score {
    //         background: $accept-score;
    //     }
    // }
    // &.follow-up:not(.accepted) {
    //     .grid-wrap {
    //         grid-auto-flow: dense;
    //     }
    //     .score {
    //         background: $reject-score;
    //         grid-column: right-column / right-gutter;
    //         margin-left: 5px;
    //     }
    //     .continue {
    //         grid-column: icon / right-column;
    //         margin-left: 0;
    //     }
    // }
}
</style>
