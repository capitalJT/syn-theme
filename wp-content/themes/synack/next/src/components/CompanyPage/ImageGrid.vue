<template>
    <div
        class="company-page-image-grid"
        v-in-view="{ onEnterBelow: startTimer }"
        @click="killTimer"
    >
        <company-page-team-row class="top-three" :items="topThreeItems" />
        <company-page-team-row
            class="remaining"
            :items="remainingItems"
            :width-template="[31.5, 23, 40]"
        />
    </div>
</template>

<script>
import _chunk from 'lodash/chunk'

export default {
    props: {
        items: {
            type: Array,
            default: () => []
        }
    },
    data() {
        return {
            timerKilled: false,
            timer: null
        }
    },
    mounted() {
        // kick timer if component is already
        // in view on mount
        setTimeout(() => {
            if (!this.timer && this.$el.classList.contains('in-view')) {
                this.startTimer()
            }
        }, 200)
    },
    computed: {
        itemsWithIndexes() {
            return this.items.map((item, i) => {
                return {
                    ...item,
                    index: i
                }
            })
        },
        rowCount(){
            if ( this.$store.getters.isMobile ) return 2
            return 3
        },
        topThreeItems() {
            return this.itemsWithIndexes.slice(0, this.rowCount)
        },
        remainingItems() {
            return this.itemsWithIndexes.slice(this.rowCount)
        }
    },
    methods: {
        startTimer() {
            if (this.timer || this.timerKilled) return
            const nextTeamMember = () => {
                const activeIdx = this.$store.state.activeTeamBlock
                let nextIndex = 0
                if (activeIdx > -1) {
                    nextIndex = (activeIdx + 1) % this.items.length
                }
                this.$store.commit('SET_ACTIVE_TEAM_BLOCK', nextIndex)
            }
            this.timer = setInterval(nextTeamMember, 3000)
            setTimeout(nextTeamMember, 1000)
        },
        killTimer() {
            this.timerKilled = true
            clearInterval(this.timer)
            this.timer = null
        }
    }
}
</script>

<style lang="scss">
@import 'src/styles/vars';

.company-page-image-grid {
    position: relative;
}

// mobile breakpoints
@media #{ $lt-phone } {
    .company-page-image-grid {

    }
}
</style>
