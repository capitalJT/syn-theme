import throttle from 'lodash/throttle'
import Vue from 'vue'

let height = 0
let top = 0
let bottom = 0
let width = 0
let left = 0
let right = 0
let eventFunction = null

function setRect(el) {
    if (!el.getBoundingClientRect) {
        return
    }
    const rect = el.getBoundingClientRect()
    bottom = rect.bottom
    top = rect.top
    left = rect.left
    right = rect.right
}

function setHeight(el) {
    height = el.clientHeight || 0
}

function setWidth(el) {
    width = el.clientWidth || 0
}

function removeListeners() {}

function setClass(el, opts, runEvents = true) {
    // list of class names this directive might attach to the el
    const possibleVerticalClasses = [opts.aboveClass, opts.belowClass]
    const possibleHorizontalClasses = [opts.leftClass, opts.rightClass]

    // class names attached to the el by this directive
    const currentClassVertical =
        [...el.classList].find(className =>
            possibleVerticalClasses.includes(className)
        ) || ''
    const currentClassHorizontal =
        [...el.classList].find(className =>
            possibleHorizontalClasses.includes(className)
        ) || ''

    // new classes we'll be adding to the el
    let newClassVertical = currentClassVertical
    let newClassHorizontal = currentClassHorizontal

    // event types to register
    let eventType = []

    // we'll need to check both dimensions to see if we're in view
    let inViewVertical = false
    let inViewHorizontal = false

    // Vertical in-view status
    let topBound = opts.paddingTop === null ? opts.padding : opts.paddingTop
    // if we're less than 1, assume we're using a percentage of the window height
    if (topBound < 1) {
        topBound *= window.innerHeight
    }
    let bottomBound =
        opts.paddingBottom === null ? opts.padding : opts.paddingBottom
    if (bottomBound < 1) {
        bottomBound = (1 - bottomBound) * window.innerHeight
    }
    if (height && top + height <= topBound) {
        newClassVertical = opts.aboveClass
        eventType.push('leave-view', 'above')
    } else if (top >= bottomBound) {
        newClassVertical = opts.belowClass
        eventType.push('leave-view', 'below')
    } else {
        newClassVertical = ''
        inViewVertical = true
        eventType.push('enter-view')

        if (currentClassVertical == opts.aboveClass) {
            eventType.push('above')
        } else {
            eventType.push('below')
        }
    }

    // Horizontal in-view status
    let leftBound = opts.paddingLeft === null ? opts.padding : opts.paddingLeft
    // like above, if we're less than 1, assume we're using a percentage of the window height
    if (leftBound < 1) {
        leftBound *= window.innerWidth
    }
    let rightBound =
        opts.paddingRight === null ? opts.padding : opts.paddingRight
    if (rightBound < 1) {
        rightBound = (1 - rightBound) * window.innerWidth
    }
    if (width && left + width <= leftBound) {
        newClassVertical = opts.leftClass
        eventType.push('leave-view', 'left')
    } else if (left >= rightBound) {
        newClassVertical = opts.rightClass
        eventType.push('leave-view', 'right')
    } else {
        newClassHorizontal = ''
        inViewHorizontal = true
        eventType.push('enter-view')

        if (currentClassHorizontal == opts.leftClass) {
            eventType.push('left')
        } else {
            eventType.push('right')
        }
    }

    // Add vertical class if in view
    if (currentClassVertical != newClassVertical) {
        if (currentClassVertical) {
            el.classList.remove(currentClassVertical)
        }
        if (newClassVertical) {
            el.classList.add(newClassVertical)
        }

        // Fire events
        if (runEvents) {
            // enter events
            if (eventType.indexOf('enter-view') != -1) {
                if (opts.onEnter) {
                    opts.onEnter(el)
                }
                if (eventType.indexOf('above') != -1 && opts.onEnterAbove) {
                    opts.onEnterAbove(el)
                }
                if (eventType.indexOf('below') != -1 && opts.onEnterBelow) {
                    opts.onEnterBelow(el)
                }
            }

            // leave events
            if (eventType.indexOf('leave-view') != -1) {
                if (opts.onLeave) {
                    opts.onLeave(el)
                }
                if (eventType.indexOf('above') != -1 && opts.onLeaveAbove) {
                    opts.onLeaveAbove(el)
                }
                if (eventType.indexOf('below') != -1 && opts.onLeaveBelow) {
                    opts.onLeaveBelow(el)
                }
            }
        }
    }

    if (currentClassHorizontal != newClassHorizontal) {
        if (currentClassHorizontal) {
            el.classList.remove(currentClassHorizontal)
        }
        if (newClassHorizontal) {
            el.classList.add(newClassHorizontal)
        }

        // Fire events
        if (runEvents) {
            // enter events
            if (eventType.indexOf('enter-view') != -1) {
                if (opts.onEnter) {
                    opts.onEnter(el)
                }
                if (eventType.indexOf('left') != -1 && opts.onEnterLeft) {
                    opts.onEnterLeft(el)
                }
                if (eventType.indexOf('right') != -1 && opts.onEnterRight) {
                    opts.onEnterRight(el)
                }
            }

            // leave events
            if (eventType.indexOf('leave-view') != -1) {
                if (opts.onLeave) {
                    opts.onLeave(el)
                }
                if (eventType.indexOf('left') != -1 && opts.onLeaveLeft) {
                    opts.onLeaveLeft(el)
                }
                if (eventType.indexOf('right') != -1 && opts.onLeaveRight) {
                    opts.onLeaveRight(el)
                }
            }
        }
    }

    if (inViewVertical && inViewHorizontal) {
        el.classList.add(opts.inViewClass)
        el.classList.add(opts.onceClass)
    } else {
        el.classList.remove(opts.inViewClass)
    }

    if (el.classList.contains(opts.inViewClass) && opts.once) {
        // remove listener if we're in-view
        window.removeEventListener('scroll', eventFunction)
        window.removeEventListener('mousewheel', eventFunction)
        window.removeEventListener('resize', eventFunction)
    }
}

export default {
    bind: async function(el, binding) {
        const bindingValue = binding.value || {}
        const opts = {
            aboveClass: bindingValue.above || 'above-view',
            inViewClass: bindingValue.inView || 'in-view',
            belowClass: bindingValue.below || 'below-view',
            leftClass: bindingValue.left || 'left-of-view',
            rightClass: bindingValue.right || 'right-of-view',
            throttle: bindingValue.hasOwnProperty('throttle')
                ? bindingValue.throttle
                : 30,

            // enter events
            onEnter: bindingValue.onEnter || null,
            onEnterAbove: bindingValue.onEnterAbove || null,
            onEnterBelow: bindingValue.onEnterBelow || null,
            onEnterLeft: bindingValue.onEnterLeft || null,
            onEnterRight: bindingValue.onEnterRight || null,

            // leave events
            onLeave: bindingValue.onLeave || null,
            onLeaveAbove: bindingValue.onLeaveAbove || null,
            onLeaveBelow: bindingValue.onLeaveBelow || null,
            onLeaveLeft: bindingValue.onLeaveLeft || null,
            onLeaveRight: bindingValue.onLeaveRight || null,

            // padding (activation zones)
            // default to no padding
            padding: bindingValue.hasOwnProperty('padding')
                ? bindingValue.padding
                : 0,
            // a null value indicates we shouldn't override the default
            paddingTop: bindingValue.hasOwnProperty('paddingTop')
                ? bindingValue.paddingTop
                : null,
            paddingRight: bindingValue.hasOwnProperty('paddingRight')
                ? bindingValue.paddingRight
                : null,
            paddingBottom: bindingValue.hasOwnProperty('paddingBottom')
                ? bindingValue.paddingBottom
                : null,
            paddingLeft: bindingValue.hasOwnProperty('paddingLeft')
                ? bindingValue.paddingLeft
                : null,

            once: binding.modifiers.once != undefined,
            onceClass: bindingValue.hasOwnProperty('onceClass')
                ? bindingValue.onceClass
                : 'fired-once'
        }

        // save the function so we can remove it later if needed
        eventFunction = throttle(() => {
            setHeight(el, opts)
            setRect(el, opts)
            setClass(el, opts)
        }, opts.throttle)

        window.addEventListener('scroll', eventFunction)
        window.addEventListener('mousewheel', eventFunction)
        window.addEventListener('resize', eventFunction)

        // wait so we render the element
        await Vue.nextTick()

        // initial class
        setHeight(el, opts)
        setWidth(el, opts)
        setRect(el, opts)

        // run events if we're in the viewport and the 'appear' modifier is set
        const runEvents =
            binding.modifiers.appear != undefined &&
            top + height > 0 &&
            top < window.innerHeight &&
            left + width > 0 &&
            left < window.innerWidth
        setClass(el, opts, runEvents)
    },
    unbind: function() {
        // remove all listeners on unbind
        window.removeEventListener('scroll', eventFunction)
        window.removeEventListener('mousewheel', eventFunction)
        window.removeEventListener('resize', eventFunction)
    }
}
