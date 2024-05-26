class RoutingUtility {
  restrictRequestMethod = (req, res) => {
    return res.status(405).json({ error: 'Method Not Allowed' });
  };
}

export default RoutingUtility;
