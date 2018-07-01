import http from '../utils/http';


export function getList(query) {
    return http({
        url: 'api/articles',
        method: 'get',
        params: query
    })
}

export function createArticle(category) {
    return http({
        url: 'api/articles',
        method: 'post',
        data: {
            name: category.name
        }
    })
}

export function updateArticle(id, name) {
    return http({
        url: 'api/articles/' + id,
        method: 'post',
        data: {
            _method: 'PUT',
            name: name
        }
    })
}

export function deleteArticle(id) {
    return http({
        url: 'api/articles/' + id,
        method: 'post',
        data: { _method: 'DELETE' }
    })
}