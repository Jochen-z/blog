import http from '../utils/http';

export function getDashboardData() {
    return http({
        url: 'api/dashboard',
        method: 'get'
    })
}

export function getStatisticalTraffic(query) {
    return http({
        url: 'api/dashboard/traffic',
        method: 'get',
        params: query
    })
}