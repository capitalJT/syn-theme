import { timeline, styler, tween } from 'popmotion'

export default function() {
    // scroll to view
    const windowStyler = styler(window)
    tween({
        from: windowStyler.get('scrollTop'),
        to: document.querySelector('.journey-section').offsetTop,
        duration: 1000
    }).start(windowStyler.set('scrollTop'))

    // intro animation
    const badge = styler(
        this.$el.querySelector('.landing-content .header-badge')
    )
    const content = styler(
        this.$el.querySelector('.landing-content .wp-content')
    )
    const button = styler(
        this.$el.querySelector('.landing-content .journey-accented-button')
    )
    const background = styler(this.$el.querySelector('.dark-background'))
    // const map = styler(this.$el.querySelector('.map-wrap'))

    timeline([
        // [
        {
            track: 'background',
            from: { opacity: 0 },
            to: { opacity: 1 },
            duration: 600
        },
        // this wasn't working for some reason, so the map
        // transition is handled in Journey/Svg/MapWrapper.vue's CSS
        // {
        //     track: 'map',
        //     from: { scale: 0.4, y: 100 },
        //     to: { scale: 1, y: 0 },
        //     duration: 600
        // }
        // ],
        [
            {
                track: 'badge',
                from: { opacity: 1, y: 0 },
                to: { opacity: 0, y: -80 }
            },
            {
                track: 'content',
                from: { opacity: 1, y: 0 },
                to: { opacity: 0, y: -80 }
            },
            {
                track: 'button',
                from: { opacity: 1, y: 0 },
                to: { opacity: 0, y: -80 }
            },
            50
        ]
    ]).start({
        update: v => {
            badge.set(v.badge)
            content.set(v.content)
            button.set(v.button)
            background.set(v.background)
            // map.set(v.map)
        },
        complete: () => {}
    })

    this.$store.commit('START_JOURNEY')
}
