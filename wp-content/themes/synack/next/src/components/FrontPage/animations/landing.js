import Blast from '../../Shared/blast-vanilla'
import { styler, spring, stagger, chain, tween } from 'popmotion'

// hide all of the elements to be animated
export const beforeEnter = el => {
    const toHide = [
        el.querySelector('.link-carousel'),
        el.querySelector('.content-wrap .wp-content h3'),
        ...el.querySelectorAll('.content-wrap .wp-content p')
    ]

    toHide
        .filter(x => x)
        .forEach(e => {
            e.style.opacity = 0
        })
}

// swipe-reveal for each letter in the main title
const fadeInTitle = el => {
    return new Promise(res => {
        const mainTitleSelector = '.globe .content-wrap .wp-content h3'

        // blast main title
        new Blast(mainTitleSelector, {
            delimiter: 'letter'
        })
        // get each letter
        const letters = [...el.querySelectorAll(`${mainTitleSelector} .blast`)]
        // styler for each letter
        const stylers = letters.map(styler)
        // hide each letter
        stylers.forEach(s => s.set('clip-path', 'inset(0% 100% 0% 0%)'))
        // show the full h3
        el.querySelector(mainTitleSelector).style.opacity = 1

        // build fade-in
        const fadeIn = tween({
            from: { 'clip-path': 'inset(0% 100% 0% 0%)' },
            to: { 'clip-path': 'inset(0% 0% 0% 0%)' },
            duration: 100
        })
        // fade-in for each letter
        const tweens = new Array(letters.length).fill(fadeIn)

        stagger(tweens, 20).start({
            update: values => {
                values.forEach((v = {}, i) => {
                    stylers[i].set(v)
                })
            },
            complete: () => {
                stylers.forEach(s => s.set('clip-path', 'none'))
                res()
            }
        })
    })
}

// slide-fade for each element in the body
const fadeInBody = el => {
    return new Promise(res => {
        const els = [...el.querySelectorAll('.content-wrap .wp-content p')]
        // prep the fade-in tween
        const fadeIn = spring({
            from: { opacity: 0, x: -10 },
            to: { opacity: 1, x: 0 },
            damping: 10,
            stiffness: 50
        })

        // each element gets its own fade-in
        const sequence = new Array(els.length).fill(fadeIn)
        // and its own styler
        const stylers = els.map(styler)

        // start the animation
        stagger(sequence, 150).start({
            update: values => {
                // set each value
                // (see https://popmotion.io/api/stagger/)
                values.forEach((v = {}, i) => {
                    stylers[i].set(v)
                })
            },
            complete: res
        })
    })
}

// simple fade-in for the link carousel
const fadeInLinkCarousel = el => {
    return new Promise(res => {
        const fadeIn = tween({
            from: { opacity: 0 },
            to: { opacity: 1 },
            duration: 400
        })

        const s = styler(el.querySelector('.link-carousel'))
        fadeIn.start({
            update: s.set,
            complete: res
        })
    })
}

const wait = duration => {
    return new Promise(res => {
        setTimeout(res, duration)
    })
}

export const enter = async (el, done) => {
    // fade in each letter
    await fadeInTitle(el)

    // fade in other body elements
    fadeInBody(el)

    // wait a beat
    await wait(1000)

    // regular fade-in for news ticker
    await fadeInLinkCarousel(el)

    done()
}
