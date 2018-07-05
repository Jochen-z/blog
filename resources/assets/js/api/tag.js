import http from '../utils/http';


export function getTagList(query) {
    return http({
        url: 'api/tags',
        method: 'get',
        params: query
    })
}

export function createTag(tag) {
    return http({
        url: 'api/tags',
        method: 'post',
        data: { name: tag.name}
    })
}

export function updateTag(id, name) {
    return http({
        url: 'api/tags/' + id,
        method: 'post',
        data: {
            _method: 'PUT',
            name: name
        }
    })
}

export function deleteTag(id) {
    return http({
        url: 'api/tags/' + id,
        method: 'post',
        data: { _method: 'DELETE' }
    })
}