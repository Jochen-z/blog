import http from '../utils/http';

export function getVisitorList(query) {
    return http({
        url: 'api/visitors',
        method: 'get',
        params: query
    })
}