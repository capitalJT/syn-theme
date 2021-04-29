<template>
    <company-page-awards :title="awards_title" :items="awards" />
</template>

<script>
export default {
    props: {
        awards: Array,
        awards_title: String
    }
}
</script>
