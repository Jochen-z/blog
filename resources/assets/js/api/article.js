import http from '../utils/http';


export function getArticle(id) {
    return http({
        url: 'api/articles/' + id,
        method: 'get'
    })
}

export function getArticleList(query) {
    return http({
        url: 'api/articles',
        method: 'get',
        params: query
    })
}

export function createArticle(article) {
    return http({
        url: 'api/articles',
        method: 'post',
        data: article
    })
}

export function updateArticle(id, article) {
    return http({
        url: 'api/articles/' + id,
        method: 'post',
        data: {
            _method: 'PUT',
            title: article.title,
            excerpt: article.excerpt,
            content: article.content,
            category_id: article.category_id,
            status: article.status,
            tag: article.tag
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