import http from '../utils/http';


export function getList(query) {
    return http({
        url: 'api/tags',
        method: 'get',
        params: query
    })
}

export function createCategory(category) {
    return http({
        url: 'api/tags',
        method: 'post',
        data: { name: category.name}
    })
}

export function updateCategory(id, name) {
    return http({
        url: 'api/tags/' + id,
        method: 'post',
        data: {
            _method: 'PUT',
            name: name
        }
    })
}

export function deleteCategory(id) {
    return http({
        url: 'api/tags/' + id,
        method: 'post',
        data: { _method: 'DELETE' }
    })
}