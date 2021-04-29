<template>
    <section class="careers-openings">
        <div id="grnhse_app"></div>
        <!-- intro and filter -->
        <!-- <div class="selection-wrap">
            <h3 class="title">Current Openings</h3>
            <select v-model="selectedIndex">
                <option v-for="(cat, i) in categories" :key="i" :value="i">
                    {{ cat }}
                </option>
            </select>
        </div> -->

        <!-- openings -->
        <!-- <div class="opening-wrap">
            <h4 class="opening">{{ currentCategory }}</h4>
            <ul class="all-openings">
                <li v-for="(item, i) in cmpItems" :key="i" class="item">
                    <div class="text-wrap">
                        <span class="title">{{ item.title }}</span>
                        <span class="info">{{ item.info }}</span>
                    </div>
                    <a :href="item.link_url" target="_blank" class="view-link">
                        View
                    </a>
                </li>
            </ul>
        </div> -->
    </section>
</template>

<script>
import { groupBy } from 'lodash'

export default {
    props: {
        items: Array
    },
    data() {
        return {
            selectedIndex: 0
        }
    },
    computed: {
        sorted() {
            return groupBy(this.items, 'category')
        },
        categories() {
            return Object.keys(this.sorted)
        },
        currentCategory() {
            return this.categories[this.selectedIndex]
        },
        cmpItems() {
            return this.items.filter(
                item => item.category === this.currentCategory
            )
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.careers-openings {
    margin-top: 65px;

    .selection-wrap {
        background: linear-gradient(to right, #390577, #1c48bf);
        color: $white;
        text-align: center;
        padding: 50px 20px;

        h3 {
            margin: 0;
            font-size: 48px;
        }
        select {
            margin-top: 35px;
            padding: 20px 15px;
            font-size: 16px;
        }
    }
    .opening {
        color: #016bff;
        text-align: center;
        font-size: 36px;
        font-weight: 300;
    }
    .all-openings {
        list-style: none;
        padding: 0 30px;
        margin: 0 auto 20px;
        max-width: 1000px;

        .text-wrap {
            display: flex;
            flex-direction: column;
        }
        .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            color: #0f2749;
            padding: 30px 0;

            &:first-child {
                padding-top: 0;
            }
            & + .item {
                border-top: 1px solid #b8c4da;
            }
            .title {
                font-size: 20px;
            }
            .view-link {
                @include shortcode-button($blue, $blue, $white);
                padding-top: 10px !important;
                padding-bottom: 10px !important;
                text-transform: uppercase;
                font-weight: 400;
                transition: opacity 0.3s;

                &:hover,
                &:focus {
                    opacity: 0.7;
                }
            }
        }
    }
}
</style>
