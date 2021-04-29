<template>
    <section class="partner-program-partner-grid">
        <!-- Intro -->
        <h3 class="intro">{{ introduction }}</h3>

        <!-- Logo grid -->
        <ul class="logo-grid">
            <li v-for="(logo, i) in logos" :key="i" class="single-logo">
                <component :is="logo.url ? 'a' : 'div'" :href="logo.url">
                    <img :src="logo.image.url" :alt="logo.image.alt" />
                </component>
            </li>
        </ul>
    </section>
</template>

<script>
export default {
    props: {
        introduction: { type: String, default: '' },
        logos: { type: Array, default: () => [] }
    }
}
</script>

<style lang="scss">
.partner-program-partner-grid {
    padding: 0 30px;
    max-width: 1140px;
    margin: 180px auto 170px;

    // hide on channel-partners-technology page
    .page-id-7339 & {
        display: none;
    }

    .intro {
        font-size: 60px;
        text-align: center;

        @media (max-width: 750px) {
            font-size: 36px;
        }
    }
    .logo-grid {
        margin: 0;
        padding: 0;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-gap: 25px;
        list-style: none;

        @media (max-width: 900px) {
            grid-template-columns: repeat(2, 1fr);
        }
        @media (max-width: 750px) {
            grid-gap: 10px;
        }

        .single-logo {
            max-width: 260px;
            height: 145px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 12px;
            border: 1px solid #dfe5f0;
            align-self: center;
            justify-self: center;

            img {
                width: 66%;
                height: auto;
                margin: auto;
                display: block;
            }
        }
    }
}
</style>
