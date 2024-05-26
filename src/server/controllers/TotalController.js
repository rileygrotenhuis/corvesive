import prisma from '@/config/prisma';

class TotalController {
  updateTotalBalance = async (req, res) => {
    const user = await prisma.user.update({
      where: {
        id: req.user,
      },
      data: {
        totalBalance: parseFloat(req.body.amount),
      },
    });

    return res.status(200).json(user);
  };
}

export default TotalController;
