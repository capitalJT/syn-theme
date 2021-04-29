export default img => {
    return new Promise((resolve, reject) => {
        // assume URL provided
        let src = img

        // ensure we have a URL and an image constructor
        if (!src || !Image) return reject()

        // make image object and set callbacks
        const imageEl = new Image()
        imageEl.onload = () => resolve(imageEl)
        imageEl.onerror = reject
        return (imageEl.src = src)
    })
}
