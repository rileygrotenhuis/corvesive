import NewDayController from '@/server/controllers/NewDayController';
import RoutingUtility from '@/server/util/RoutingUtility';
import UserModel from '@/server/models/UserModel';

const controller = new NewDayController();
const routingUtility = new RoutingUtility();
const userModel = new UserModel();

const routeMappings = {
  GET: routingUtility.restrictRequestMethod,
  POST: controller.newDay,
  PUT: routingUtility.restrictRequestMethod,
  DELETE: routingUtility.restrictRequestMethod,
};

const handler = async (req, res) => {
  const authHeader = req.headers.authorization;
  if (authHeader) {
    const token = authHeader.startsWith('Bearer ')
      ? authHeader.substring(7)
      : '';
    const user = await userModel.checkUserAuthentication(token);

    req.user = token;

    if (user) {
      return await routeMappings[req.method](req, res);
    }
  }

  return res.status(401).json({ error: 'Unauthorized' });
};

export default handler;
