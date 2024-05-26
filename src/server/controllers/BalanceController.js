import prisma from '@/config/prisma';

class BalanceController {
  makePayment = async (req, res) => {
    const user = await prisma.user.findFirst({
      where: {
        id: req.user,
      },
    });

    const updatedUser = await prisma.user.update({
      where: {
        id: req.user,
      },
      data: {
        currentBalance: user.currentBalance - req.body.amount,
        totalBalance: user.totalBalance - req.body.amount,
      },
    });

    return res.status(200).json(updatedUser);
  };

  resetBalance = async (req, res) => {
    const user = await prisma.user.update({
      where: {
        id: req.user,
      },
      data: {
        currentBalance: parseFloat(req.body.amount),
      },
    });

    return res.status(200).json(user);
  };
}

export default BalanceController;
