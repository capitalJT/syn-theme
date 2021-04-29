import * as THREE from 'three'

export default async url => {
    return new Promise((res, rej) => {
        const loader = new THREE.TextureLoader()
        loader.load(url, res, null, rej)
    })
}
