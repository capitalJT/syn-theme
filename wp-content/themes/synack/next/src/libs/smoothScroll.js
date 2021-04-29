import { listen, schedule, everyFrame, filter } from 'popmotion'
import { smooth } from '@popmotion/popcorn'

export default smoothing => {
    return {
        data() {
            return {
                scheduler: null,
                ssTop: 0
            }
        },
        mounted() {
            this.scheduler = schedule(everyFrame(), listen(window, 'scroll'))
                .pipe(
                    e => {
                        return pageYOffset
                    },
                    smooth(smoothing)
                )
                .start(sTop => (this.ssTop = Math.round(sTop)))
        },
        beforeDestroy() {
            if (this.scheduler) this.scheduler.stop()
        }
    }
}
