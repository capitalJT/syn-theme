<template>
    <section class="company-page-benefits contained">
        <!-- Intro -->
        <h3 class="headline">{{ icon_grid_headline }}</h3>
        <wp-content class="intro" :html="icon_grid_intro" />

        <!-- Icons -->
        <ul class="icon-grid">
            <li class="icon-single" v-for="(icon, i) in icon_grid" :key="i">
                <!-- Image -->
                <img
                    class="image"
                    :src="icon.image.url"
                    :alt="icon.image.alt"
                    :width="icon.image.width"
                    :height="icon.image.height"
                />

                <!-- Text -->
                <p class="text">{{ icon.text }}</p>
            </li>
        </ul>
    </section>
</template>

<script>
export default {
    props: {
        icon_grid_headline: { type: String, default: '' },
        icon_grid_intro: { type: String, default: '' },
        icon_grid: { type: Array, default: () => [] }
    }
}
</script>

<style lang="scss">
.company-page-benefits.contained {
    padding: 0 30px;
    margin-top: 130px;

    // Headline and intro
    .headline {
        font-size: 60px;
        text-align: center;
        margin: 0;
    }
    .intro {
        font-size: 20px;
        text-align: center;
        color: #8694af;
        margin-top: 45px;
        max-width: 800px;
        margin-right: auto;
        margin-left: auto;
    }

    // Icon grid
    .icon-grid {
        margin: 0;
        padding: 0;
        list-style: none;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-gap: 25px;
        margin-top: 65px;

        @media (max-width: 900px) {
            grid-template-columns: repeat(2, 1fr);
        }

        .icon-single {
            background: linear-gradient(
                to bottom,
                rgba(237, 244, 255, 1),
                rgba(255, 255, 255, 1)
            );
            border-radius: 12px;
            position: relative;
            text-align: center;
            padding: 40px 30px 30px;

            &:before {
                content: '';
                position: absolute;
                top: -1px;
                left: -1px;
                width: calc(100% + 2px);
                height: calc(100% + 2px);
                background: red;
                z-index: -1;
                border-radius: 12px;
                background: linear-gradient(
                    to bottom,
                    transparent,
                    rgba(15, 249, 228, 0.26)
                );
            }

            .image {
                width: 100%;
                max-width: 125px;
                height: auto;
            }
        }
    }
}
</style>
