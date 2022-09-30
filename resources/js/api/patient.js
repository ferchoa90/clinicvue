import request from '@/utils/request';
import Resource from '@/api/resource';

export function fetchList(query) {
  return request({
    url: '/patient',
    method: 'get',
    params: query,
  });
}
class PatientResource extends Resource {
  constructor() {
    super('patients');
  }

  permissions(id) {
    return request({
      url: '/' + this.uri + '/' + id + '/permissions',
      method: 'get',
    });
  }
}

export { PatientResource as default };
