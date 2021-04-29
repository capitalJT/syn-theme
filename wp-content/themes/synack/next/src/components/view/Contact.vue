<template>
    <main class="view-contact">
        <!-- landing -->
        <landing-section :title="title" :content="content" />

        <!-- form + map -->
        <section class="primary">
            <div class="form" ref="contact-form">
                <div class="right-align">
                    <transition name="fade" mode="out-in">
                        <div key="form-wrap" v-if="!submitted">
                            <h3>Get Started</h3>
                            <form id="mktoForm_1205"></form>
                        </div>
                        <div key="confirmation" v-else>
                            <h3>Thanks, we've received your message.</h3>
                        </div>
                    </transition>
                </div>
            </div>
            <contact-mapbox
                v-if="$store.getters.breakpoint == 'desktop'"
                :locations="locations"
            />
        </section>

        <!-- Emails -->
        <section class="emails">
            <div class="contained">
                <div class="contact-block" v-for="email in emails">
                    <div class="purpose">{{ email.title }}</div>
                    <a v-bind:href="'mailto:' +  email.email ">{{ email.email }}</a>
                </div>
            </div>
        </section>

        <contact-mapbox
            class="mobile-mapbox"
            v-if="$store.getters.breakpoint == 'mobile'"
            :locations="locations"
        />
    </main>
</template>

<script>
// set by marketo
const contactFormId = 1205

export default {
    data() {
        return {
            pageData: pageData,
            submitted: false
        }
    },
    mounted() {
        if (typeof MktoForms2 !== 'undefined') {
            MktoForms2.loadForm(
                '//app-ab15.marketo.com',
                '738-OEX-476',
                1205,
                () => {
                    this.$nextTick(() => {
                        this.$root.$emit('resize')

                        const form = this.$el.querySelector('form')

                        if (form) {
                            form.addEventListener('submit', this.submitMarketo)
                        }
                    })
                }
            )
            MktoForms2.whenReady(function(form) {
                form.onSuccess((vals, thanksURL) => {
                    return false
                })
            })
        }
    },
    methods: {
        async submitMarketo(evt) {
            // get form
            var myForm = MktoForms2.getForm(contactFormId)

            // submit if valid
            if (myForm.validate()) {
                myForm.submit()
                this.submitted = true
            }

            return false
        }
    },
    computed: {
        title() {
            return _get(this.pageData, 'title')
        },
        content() {
            return _get(this.pageData, 'content')
        },
        locations() {
            return _get(this.pageData, 'acf.locations', [])
        },
        emails() {
            return _get(this.pageData, 'acf.emails', [])
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$border_color: #d6ddea;
$formtext_color: #8695ae;

body.page-template-template-contact #app {
    background-color: $navy;
    min-height: 100vh;
}

.view-contact {
    // landing
    .landing-section {
        -webkit-clip-path: polygon(100% 0, 110% 80%, 60% 100%, 0% 100%, 0 0);
        clip-path: polygon(100% 0, 110% 80%, 60% 100%, 0% 100%, 0 0);
        padding-bottom: 130px;
        z-index: 5;
    }
    .landing-section .title {
        font-size: 15vmin;

        @media only screen and (min-height: 700px) {
            font-size: 105px;
        }
    }
    .landing-section .info {
        max-width: 975px;
        margin: auto;

        .wp-content > *:first-child {
            margin-top: 0;
        }
    }

    // primary section
    .primary {
        position: relative;
        margin-top: -8%;
        padding-top: 8%;
        display: flex;

        .right-align {
            margin-left: auto;
            max-width: 460px;
        }
        .form {
            box-sizing: border-box;
            padding: 100px;
            width: 50%;

            // Override marketo styles
            .mktoForm .mktoFieldWrap {
                float: none;
            }
            .mktoFormRow {
                display: flex;

                & > * {
                    margin-left: 10px;
                    margin-right: 10px;
                    flex: 1;
                }
                & > *:first-child {
                    margin-left: 0;
                }
                & > *:last-child {
                    margin-right: 0;
                }
            }
            .mktoFormRow input,
            .mktoFormRow select,
            .mktoFormRow textarea {
                box-sizing: border-box;
                width: 100% !important;
                border: none;
                border-bottom: 1px solid $border_color;
                font-family: $font-body;
                border-radius: 0 !important;
                padding-left: 0;
                font-size: 20px;
                text-indent: 0;
                color: $navy;

                &::placeholder {
                    color: $formtext_color;
                }
                &.mktoInvalid {
                    &:not(:focus) {
                        border-bottom: 1px solid $red;
                    }
                }
            }
            .mktoFormRow select {
                background-image: url('images/form-arrow-down.svg');
                background-position: 98% 50%;
                background-repeat: no-repeat;
                color: $formtext_color;
                position: relative;
                cursor: pointer;
            }
            .mktoButtonRow {
                margin-right: 0 !important;
            }
            .mktoButtonRow button {
                transition: border 250ms;
                border-color: $border_color !important;
                padding: 18px 20px 20px !important;
                color: $formtext_color !important;
                border-width: 2px !important;
                border-radius: 50px;

                .not-mobile &:hover,
                .not-mobile &:focus {
                    border-color: $formtext_color !important;
                    background-color: transparent !important;
                }
                &::after {
                    transition: transform 250ms;
                    background-image: url('images/form-arrow-right.svg');
                    content: '';
                    position: relative;
                    display: inline-block;
                    margin-left: 10px;
                    height: 15px;
                    width: 15px;
                    top: 2px;
                }
                .not-mobile &:hover::after,
                .not-mobile &:focus::after {
                    transform: translateX(3px);
                }
            }

            .mktoOffset,
            .mktoLabel,
            .mktoGutter,
            .mktoClear,
            .mktoErrorArrowWrap {
                display: none;
            }

            .mktoError {
                top: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                left: 0 !important;
            }
            .mktoErrorMsg {
                // background: transparent;
                // border: none;
                // box-shadow: none;
                // text-shadow: none;
                // color: $red;
                // font-family: $font-body;
                // font-size: 20px;
                // padding-left: 0;
                // white-space: nowrap;
                display: none;

                // .mktoErrorDetail {
                //     display: inline;
                // }
            }
        }
        .form h3 {
            font-size: 60px;
            color: $navy;
            margin: 0;
            margin-bottom: 30px;
        }
        .mapbox-container {
            background-color: #f1f1f1;
            position: absolute;
            bottom: 0;
            left: 50%;
            right: 0;
            top: 0;
        }
    }

    // emails
    section.emails {
        padding: 70px $desktop-padding;
        background-color: $blue;
        color: $white;

        a {
            text-decoration: none;
            font-size: 16px;
            color: $white;
        }
        .contained {
            grid-template-columns: 1fr 1fr auto;
            grid-column-gap: 25px;
            grid-row-gap: 40px;
            display: grid;
        }
        .contact-block .purpose {
            font-family: $font-display;
            text-transform: uppercase;
            color: rgba($white, 0.55);
            letter-spacing: 2px;
            font-weight: 500;
            font-size: 14px;
        }
    }
}

// mobile breakpoints
@media #{ $lt-phone } {
    .view-contact {
        overflow: hidden;

        .landing-section {
            -webkit-clip-path: polygon(
                100% 0,
                110% 97%,
                55% 100%,
                -10% 96%,
                0 0
            );
            clip-path: polygon(100% 0, 110% 97%, 55% 100%, -10% 96%, 0 0);
            padding-bottom: 70px;

            .title {
                font-size: 60px;
            }
        }

        .primary {
            flex-direction: column;

            .mapbox-container {
                position: relative;
                bottom: initial;
                right: initial;
                left: initial;
                top: initial;
                height: 450px;
            }
            .right-align {
                max-width: initial;
            }
            .form {
                padding-right: $mobile-padding;
                padding-left: $mobile-padding;
                padding-bottom: 60px;
                padding-top: 60px;
                width: 100%;

                .mktoFormRow input,
                .mktoFormRow select,
                .mktoFormRow textarea {
                    font-size: 18px;
                }
                .mktoFormRow {
                    flex-direction: column;
                }
                .mktoFormRow > * {
                    margin-left: 0;
                }
                .mktoFormRow select {
                    background-size: 12px;
                }
                .mktoButtonRow {
                    width: 100% !important;
                }
            }
            .form h3 {
                text-align: center;
                font-size: 32px;
            }
        }

        .mobile-mapbox {
            height: 80vh;
        }

        section.emails {
            padding-bottom: 50px;
            padding-top: 50px;
        }
        section.emails .contained {
            grid-template-columns: 1fr;
        }
        .contact-block {
            text-align: center;
        }
    }
}
</style>
