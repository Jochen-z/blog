import http from '../utils/http';


export function getList(query) {
    return http({
        url: 'api/categories',
        method: 'get',
        params: query
    })
}

export function createCategory(name) {
    return http({
        url: 'api/categories',
        method: 'post',
        data: { name: name}
    })
}

export function updateCategory(id, name) {
    return http({
        url: 'api/categories/' . id,
        method: 'post',
        data: {
            _method: 'PUT',
            name: name
        }
    })
}

export function deleteCategory(id) {
    return http({
        url: 'api/categories/' . id,
        method: 'post',
        data: { _method: 'DELETE' }
    })
}