import http from '../utils/http';

export function getVisitorList(query) {
    return http({
        url: 'api/operation/logs',
        method: 'get',
        params: query
    })
}