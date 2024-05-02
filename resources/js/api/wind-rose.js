import request from '@site/api/request'

export function windRoseData(data) {
    return request('/api/wind-rose', data)
}
