import http from '../utils/http';


export function getAbout(id) {
    return http({
        url: 'api/abouts/' + id,
        method: 'get'
    })
}

export function updateAbout(id, content) {
    return http({
        url: 'api/abouts/' + id,
        method: 'post',
        data: {
            _method: 'PUT',
            content: content
        }
    })
}