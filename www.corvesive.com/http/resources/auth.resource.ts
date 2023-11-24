import type { IUserResource } from './account.resource';

export interface IRegistrationOrLoginResource {
  user: IUserResource;
  token: string;
  errors: Array<any>;
}
