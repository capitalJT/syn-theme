import Rellax from 'rellax'
import Vue from 'vue'

let instances = []

export default {
    async bind(el, { value }) {
        await Vue.nextTick()

        // -2 is the Rellax default
        const defaultSpeed = value.hasOwnProperty('speed') ? value.speed : -2
        // fall back to default center property
        const defaultCenter = value.hasOwnProperty('center')
            ? value.center
            : true

        // these are the objects indicating Rellax elements & options
        let els = []

        if (Array.isArray(value)) {
            // if our passed els is an array, use that
            els = value.els
        } else if (value && typeof value == 'object') {
            // otherwise, if it's an object, add that object to the array
            els.push({
                selector: value.selector,
                speed: defaultSpeed,
                center: defaultCenter
            })
        } else {
            // otherwise, assume it's a string and build using default vals
            els.push({
                selector: value,
                speed: defaultSpeed,
                center: defaultCenter
            })
        }

        instances = els.map(e => {
            return new Rellax(e.selector, {
                speed: e.speed,
                center: e.center
            })
        })
    },
    unbind() {
        instances
            // only use valid instances (ie, it's not falsey and it contains a property called `destroy`)
            .filter(instance => instance && instance.destroy)
            // destroy existing Rellax instances
            .forEach(instance => {
                instance.destroy()
            })
    }
}
