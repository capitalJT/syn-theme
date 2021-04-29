<template>
    <button
        @click="setActive"
        @focus="setActive"
        :class="classes"
        :data-index="item.index"
    >
        <responsive-image class="image" :src="imageSrc" :aspect="100">
            <div class="overlay" />
        </responsive-image>
        <div class="meta">
            <div class="team-title">
                <div v-for="(nameRow, i) in nameRows" class="name">
                    <span>{{ nameRow }}</span>
                    <span v-if="i === nameRows.length - 1" class="title">{{
                        teamMemberTitle
                    }}</span>
                </div>
            </div>
            <div class="team-bio">{{ teamMemberBio }}</div>
        </div>
    </button>
</template>

<script>
export default {
    props: {
        item: {
            type: Object,
            required: true
        }
    },
    computed: {
        classes() {
            return [
                'company-page-team-block',
                {
                    'is-active':
                        this.item.index === this.$store.state.activeTeamBlock
                }
            ]
        },
        nameRows() {
            return String(this.item.name).split(' ')
        },
        teamMemberTitle() {
            return this.item.title
        },
        teamMemberBio() {
            return this.item.bio
        },
        imageSrc() {
            return _get(this.item, 'image.sizes.large')
        }
    },
    methods: {
        setActive() {
            this.$store.commit('SET_ACTIVE_TEAM_BLOCK', this.item.index)
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

$steel_blue: #37414b;
$text_color: #acb5c7;

.company-page-team-block {
    background-color: saturate($steel_blue, 10%);
    position: relative;

    .image .media {
        // filter: grayscale(100%);
        mix-blend-mode: luminosity;
    }
    .overlay {
        transition: opacity 250ms;
        background-color: $navy;
        @include fill;
        opacity: 0.15;
    }

    // information
    .meta {
        transition: opacity 50ms;
        transform: translateZ(0);
        position: absolute;
        text-align: left;
        color: $text_color;
        padding: 20px;
        opacity: 0;
        bottom: 0;
        right: 0;
        left: 0;
    }
    .team-title {
        margin-bottom: 20px;
        color: $white;
    }
    .team-title .name {
        font-family: $font-display;
        text-transform: uppercase;
        font-weight: 400;
        display: block;
        font-size: 0;

        & + .name {
            margin-top: -1px;
        }
        span {
            border: 1px solid $white;
            display: inline-block;
            padding: 8px 12px;
            font-size: 14px;
        }
    }
    .team-title .name .title {
        display: inline-block;
        background-color: $white;
        color: $navy;
    }

    // active states
    .not-mobile &:hover .overlay,
    .not-mobile &:focus .overlay {
        opacity: 0.45;
    }
    &.is-active .overlay,
    .not-mobile &.is-active .overlay {
        opacity: 0.8;
    }
    &.is-active .meta {
        animation-fill-mode: forwards;
        animation: fadeup 550ms;
        animation-delay: 350ms;
        transition-delay: 350ms;
        opacity: 1;
    }
}

// mobile breakpoints
@media #{ $lt-phone } {
    .company-page-team-block {
        width: 100% !important;

        .meta {
            display: none;
        }
        .overlay {
            display: none;
        }
    }
}

@keyframes fadeup {
    0% {
        transform: translateY(10%);
        opacity: 0;
    }
    100% {
        transform: none;
        opacity: 1;
    }
}
</style>
