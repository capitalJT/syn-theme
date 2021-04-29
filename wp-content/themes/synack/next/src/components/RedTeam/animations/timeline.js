import { keyframes, styler, timeline } from 'popmotion'

export default function(percentages) {
    // this is the timeline we'll pass into timeline()
    const tl = []

    // get the slides ("64% make it...", "48% pass...") & silhouette figures
    const slides = [...this.$el.querySelectorAll('.content .slide')]
    const figures = [...this.$el.querySelectorAll('.silhouette-field path')]

    // prep to save stylers for the slides and figures
    const slideStylers = []
    const figureStylers = []
    const mouseStyler = styler(document.querySelector('.mouse-icon-wrap'))

    // other misc vars
    const figureCount = figures.length

    // split figures into groups - one group will get blurred each new slide
    // this array contains 1 array of indices for each group
    // so it'll look like: [[0, 1, 2, 3], [4, 5, 6]] (but randomized)
    const figureGroups = []

    // populate figureGroups using a percentage of total figures
    percentages.forEach(percentage => {
        // array of 0..n, where n is the index of the last silhouette
        let pool = [...Array(figureCount).keys()]
        // flatten indices of already used figures
        const flatGroups = [].concat.apply([], figureGroups)
        // filter out already used indices
        pool = pool.filter(n => !flatGroups.includes(n))

        // shuffle the pool (https://stackoverflow.com/a/38571132/3856675)
        pool = pool.sort(() => 0.5 - Math.random())

        // get the target group length
        const groupCount = Math.ceil(
            figureCount * (1 - percentage) - flatGroups.length
        )

        // save the indices into a new group
        figureGroups.push(pool.slice(0, groupCount))
    })

    // add empty figure group for last slide
    figureGroups.push([])
    const lastIndex = slides.length - 1

    // add 'selected' class to figures whose indices are not in any figureGroup
    // first, flatten all indices selected...
    const flatGroups = [].concat.apply([], figureGroups)
    // ...then build an array of indices left behind...
    const selectedIndices = [...Array(figureCount).keys()].filter(
        i => !flatGroups.includes(i)
    )
    // ...save an array of the actual elements...
    const selectedElements = selectedIndices.map(i => figures[i])
    // ...and add the 'selected' class to those elements
    selectedElements.forEach(el => el.classList.add('selected'))

    this.sections.map((section, i) => {
        // if we're not on the first slide, start invisible
        if (i !== 0) {
            tl.push({
                track: `slide${i}`,
                from: { x: 30, opacity: 0 },
                to: { x: 0, opacity: 1 }
            })
        }

        // if we're on the last slide...
        if (i === this.sections.length - 1) {
            // ...wrap the current item in an array...
            tl[tl.length - 1] = [tl[tl.length - 1]]
            // ...and add the mouse fadeout to that array
            // (keeping these in an array makes them play at the same time)
            tl[tl.length - 1].push({
                track: 'mouse',
                from: { opacity: 1 },
                to: { opacity: 0 }
            })
        }

        // this is where the slide is visible and centered
        tl.push({
            track: `slide${i}`,
            from: { x: 0, opacity: 1 },
            to: { x: 0, opacity: 1 }
        })

        // if we're not on the last index, add a fade-out
        if (i != lastIndex) {
            tl.push({
                track: `slide${i}`,
                from: { x: 0, opacity: 1 },
                to: { x: -30, opacity: 0 }
            })
        }
        slideStylers.push(styler(slides[i]))

        // add a fade-out of the latest figureGroup
        tl.push({
            track: `figure${i}`,
            from: { opacity: 1 },
            to: { opacity: 0.1 }
        })
        const figureIndices = figureGroups[i]

        // build figure stylers
        figureStylers.push(
            figureIndices.map(index => figures[index]).map(styler)
        )
    })

    // line up the figure stylers with the slides correctly
    figureStylers.splice(0, 1)
    figureStylers.push([], [])

    // start and pause the timline animation
    const output = timeline(tl).start(v => {
        // update the slides
        Object.keys(v)
            .filter(key => key.includes('slide'))
            .forEach((key, i) => {
                slideStylers[i].set(v[key])
            })

        // update the silhouettes
        Object.keys(v)
            .filter(key => key.includes('figure'))
            .forEach((key, i) => {
                figureStylers[i].forEach(s => s.set(v[key]))
            })

        // update the mouse icon
        mouseStyler.set(v.mouse)
    })
    output.pause()

    // return the built timeline
    return output
}
