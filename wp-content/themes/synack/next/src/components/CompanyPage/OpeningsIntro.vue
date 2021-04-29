<template>
    <section class="company-page-openings-intro">
        <div class="contained">
            <h3 class="headline">{{ openings_headline }}</h3>
            <p class="content">{{ openings_intro }}</p>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        openings_headline: { type: String, default: '' },
        openings_intro: { type: String, default: '' }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.company-page-openings-intro {
    padding: 55px 30px 60px;
    background: linear-gradient(to right, #390577, #1c48bf);
    color: $white;
    text-align: center;
    margin-top: 100px;

    .headline {
        font-size: 60px;
        margin: 0;
    }
    .content {
        font-size: 20px;
        font-weight: 700;
        line-height: 1.5;
        margin-bottom: 0;
        max-width: 800px;
        margin-right: auto;
        margin-left: auto;
    }
}
</style>
