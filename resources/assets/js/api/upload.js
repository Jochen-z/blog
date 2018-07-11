import http from '../utils/http'


export function uploadImage(image) {
    return http({
        url: 'api/upload/image',
        method: 'post',
        data: image
    })
}