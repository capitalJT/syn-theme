<template>
    <div class="shared-search-bar">
        <svg-icon-magnifying-glass class="magnifying-glass" />
        <input
            class="input"
            type="text"
            aria-label="Search"
            :placeholder="placeholder"
            v-model="search"
            @keydown.enter="submit"
        />

        <select v-model="category" class="select">
            <option disabled value="">{{ defaultOption }}</option>
            <option
                v-for="(option, i) in cmpOptions"
                :key="i"
                :value="option"
                v-html="option"
            />
        </select>
        <svg-arrow-down class="arrow-down" />
    </div>
</template>

<script>
import Vue from 'vue'

export default {
    props: {
        placeholder: {
            type: String,
            default: 'Search resources'
        },
        defaultOption: {
            type: String,
            default: 'All sources'
        },
        options: {
            type: Array,
            default: () => []
        },
        queryVar: {
            type: String,
            default: 'category_name'
        }
    },
    data() {
        return {
            search: '',
            category: ''
        }
    },
    computed: {
        cmpOptions() {
            return ['All', ...this.options]
        }
    },
    watch: {
        search(newVal) {
            this.$store.commit('SET_SEARCH_TERM', newVal)
        },
        category(newVal) {
            this.$store.commit('SET_SEARCH_CATEGORY', newVal)
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';
$border-color: #3a475a;
$faded-text-color: #535f75;

.shared-search-bar {
    position: relative;
    max-width: 800px;
    width: 80%;
    margin: 0 auto 60px;
    display: flex;
    justify-content: space-between;

    .magnifying-glass {
        position: absolute;
        top: 0;
        bottom: 0;
        margin: auto;
    }
    .input {
        width: 60%;
        -webkit-appearance: none;
        background: transparent;
        outline: none;
        border: none;
        border-bottom: 1px solid $border-color;
        padding: 20px 10px 20px 30px;
        color: $white;
        font-size: 20px;
        border-radius: 0;

        ::-webkit-input-placeholder {
            color: $faded-text-color;
        }
    }
    .select {
        width: 30%;
        -webkit-appearance: none;
        background: transparent;
        outline: none;
        border: none;
        border-bottom: 1px solid $border-color;
        padding: 20px 0;
        color: $white;
        font-size: 20px;
        border-radius: 0;
        cursor: pointer;
    }
    .arrow-down {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        margin: auto;
    }
    .search-link {
        display: none;
    }

    // Mobile
    @media #{$lt-phone} {
        width: 100%;
        flex-wrap: wrap;

        .magnifying-glass {
            top: 23px;
            bottom: initial;
        }
        .input {
            width: 100%;
        }
        .select {
            width: 100%;
            padding-left: 30px;
        }
        .arrow-down {
            top: initial;
            right: initial;
            bottom: 25px;
            left: 2px;
        }
    }
}
</style>
