import type { IHttpResource } from '~/http/resources/http.resource';
import HttpFactory from './factory';
import type { IRecurringMetricsResource } from '~/http/resources/recurring.resource';

class RecurringService extends HttpFactory {
  async getRecurringMetrics(): Promise<
    IHttpResource<IRecurringMetricsResource>
  > {
    return await this.call('GET', '/recurring/metrics');
  }
}

export default RecurringService;
